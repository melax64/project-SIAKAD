<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // --- BAGIAN MAHASISWA ---

    public function createMahasiswa()
    {
        return view('admin.mahasiswa.create', ['activePage' => 'data-mahasiswa']); // Arahkan ke view form
    }

    public function storeMahasiswa(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nim' => 'required|string|unique:mahasiswas,nim',
            'prodi' => 'required|string',
            'angkatan' => 'required|numeric|min:2000|max:' . date('Y'),
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Gunakan Transaction agar jika salah satu gagal, semua dibatalkan
        DB::transaction(function () use ($validated) {

            // 2. Buat Akun User (Untuk Login)
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                // Password default adalah NIM (bisa diganti logicnya)
                'password' => Hash::make($validated['nim']),
                'role' => 'mahasiswa', // Pastikan kolom role ada di tabel users
            ]);

            // 3. Buat Data Profil Mahasiswa
            $kelas = Kelas::find($validated['kelas_id']);
            
            Mahasiswa::create([
                'user_id' => $user->id, // Relasi ke tabel user
                'nim' => $validated['nim'],
                'prodi' => $validated['prodi'],
                'angkatan' => $validated['angkatan'],
                'kelas_id' => $validated['kelas_id'],
            ]);
        });

        return redirect()->route('admin.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    // --- BAGIAN DOSEN ---

    public function createDosen()
    {
        $mataKuliahs = \App\Models\MataKuliah::orderBy('kode_matakuliah')->get();
        return view('admin.dosen.create', compact('mataKuliahs'), ['activePage' => 'data-dosen']);
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nip' => 'required|string|unique:dosens,nip',
            'jabatan' => 'required|string',
            'mata_kuliah_ids' => 'nullable|array',
            'mata_kuliah_ids.*' => 'exists:mata_kuliahs,id',
        ]);

        DB::transaction(function () use ($request) {

            // Buat User Dosen
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->nip), // Password default NIP
                'role' => 'dosen',
            ]);

            // Buat Profil Dosen
            $dosen = Dosen::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
            ]);

            // Simpan Mata Kuliah yang dipilih dosen
            if ($request->has('mata_kuliah_ids') && is_array($request->mata_kuliah_ids)) {
                foreach ($request->mata_kuliah_ids as $mataKuliahId) {
                    $mataKuliah = \App\Models\MataKuliah::find($mataKuliahId);
                    if ($mataKuliah) {
                        \App\Models\DosenMataKuliah::create([
                            'dosen_id' => $dosen->id,
                            'mata_kuliah_id' => $mataKuliah->id,
                            'mata_kuliah' => $mataKuliah->nama_matakuliah,
                            'tipe_kelas' => 'teori',
                            'sks' => $mataKuliah->sks,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.dashboard')->with('success', 'Dosen berhasil ditambahkan!');
    }

    // --- FUNGSI MENAMPILKAN DATA (INDEX) ---

    public function indexMahasiswa(Request $request)
    {
        // Query mahasiswa dengan filter
        $query = \App\Models\Mahasiswa::with(['user', 'kelas']);

        // Filter by prodi
        if ($request->filled('prodi')) {
            $query->where('prodi', $request->prodi);
        }

        // Filter by angkatan
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        // Filter by kelas
        if ($request->filled('kelas')) {
            $query->where('kelas_id', $request->kelas);
        }

        $mahasiswas = $query->orderBy('prodi')->orderBy('angkatan')->get();

        // Get unique values for filter dropdowns
        $allProdi = \App\Models\Mahasiswa::select('prodi')->distinct()->pluck('prodi');
        $allAngkatan = \App\Models\Mahasiswa::select('angkatan')->distinct()->orderByDesc('angkatan')->pluck('angkatan');
        $allKelas = \App\Models\Kelas::orderBy('nama_kelas')->get();

        // Kirim data ke view index
        return view('admin.mahasiswa.index', compact('mahasiswas', 'allProdi', 'allAngkatan', 'allKelas'), ['activePage' => 'data-mahasiswa']);
    }

    public function indexDosen()
    {
        // Ambil semua data dosen gabung dengan data user-nya dan mata kuliah yang diampu
        $dosens = \App\Models\Dosen::with('user', 'mataKuliah.mataKuliah')->get();

        return view('admin.dosen.index', compact('dosens'), ['activePage' => 'data-dosen']);
    }

    // --- DELETE MAHASISWA ---
    public function destroyMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        DB::transaction(function () use ($mahasiswa) {
            // Hapus user terkait
            User::where('id', $mahasiswa->user_id)->delete();
            // Hapus data mahasiswa (cascade akan otomatis terkena)
            $mahasiswa->delete();
        });

        return redirect()->route('admin.mahasiswa')
            ->with('success', 'Mahasiswa berhasil dihapus!');
    }

    // --- EDIT DOSEN ---
    public function editDosen($id)
    {
        $dosen = Dosen::with(['user', 'mataKuliahs'])->findOrFail($id);
        $mataKuliahs = \App\Models\MataKuliah::all();
        
        // Get IDs of mata kuliah yang sudah dipilih
        $selectedMataKuliahIds = $dosen->mataKuliahs->pluck('id')->toArray();
        
        return view('admin.dosen.edit', compact('dosen', 'mataKuliahs', 'selectedMataKuliahIds'));
    }

    public function updateDosen(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|unique:dosens,nip,' . $dosen->id,
            'email' => 'required|email|unique:users,email,' . $dosen->user_id,
            'jabatan' => 'required|string',
            'mata_kuliah_ids' => 'nullable|array',
            'mata_kuliah_ids.*' => 'exists:mata_kuliahs,id'
        ]);

        DB::transaction(function () use ($request, $dosen) {
            // Update user
            $user = User::findOrFail($dosen->user_id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Update dosen
            $dosen->update([
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
            ]);

            // Update mata kuliah yang diampu
            // Hapus semua mata kuliah lama
            \App\Models\DosenMataKuliah::where('dosen_id', $dosen->id)->delete();
            
            // Tambahkan mata kuliah baru
            if ($request->has('mata_kuliah_ids')) {
                foreach ($request->mata_kuliah_ids as $mataKuliahId) {
                    $mataKuliah = \App\Models\MataKuliah::find($mataKuliahId);
                    \App\Models\DosenMataKuliah::create([
                        'dosen_id' => $dosen->id,
                        'mata_kuliah_id' => $mataKuliahId,
                        'mata_kuliah' => $mataKuliah->nama_matakuliah,
                        'tipe_kelas' => 'teori',
                        'sks' => $mataKuliah->sks,
                    ]);
                }
            }
        });

        return redirect()->route('admin.dosen')
            ->with('success', 'Data dosen berhasil diupdate!');
    }

    // --- DELETE DOSEN ---
    public function destroyDosen($id)
    {
        $dosen = Dosen::findOrFail($id);

        DB::transaction(function () use ($dosen) {
            // Hapus mata kuliah yang diampu
            \App\Models\DosenMataKuliah::where('dosen_id', $dosen->id)->delete();
            // Hapus user terkait
            User::where('id', $dosen->user_id)->delete();
            // Hapus data dosen (cascade akan otomatis terkena)
            $dosen->delete();
        });

        return redirect()->route('admin.dosen')
            ->with('success', 'Dosen berhasil dihapus!');
    }
}
