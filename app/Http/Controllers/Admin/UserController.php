<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // --- BAGIAN MAHASISWA ---

    public function createMahasiswa()
    {
        return view('admin.mahasiswa.create'); // Arahkan ke view form
    }

    public function storeMahasiswa(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nim' => 'required|string|unique:mahasiswas,nim',
            'prodi' => 'required|string',
            'angkatan' => 'required|numeric|min:2000|max:' . date('Y'),
        ]);

        // Gunakan Transaction agar jika salah satu gagal, semua dibatalkan
        DB::transaction(function () use ($request) {

            // 2. Buat Akun User (Untuk Login)
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                // Password default adalah NIM (bisa diganti logicnya)
                'password' => Hash::make($request->nim),
                'role' => 'mahasiswa', // Pastikan kolom role ada di tabel users
            ]);

            // 3. Buat Data Profil Mahasiswa
            Mahasiswa::create([
                'user_id' => $user->id, // Relasi ke tabel user
                'nim' => $request->nim,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
            ]);
        });

        return redirect()->route('admin.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    // --- BAGIAN DOSEN ---

    public function createDosen()
    {
        return view('admin.dosen.create');
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nip' => 'required|string|unique:dosens,nip',
            'jabatan' => 'required|string',
            'mata_kuliah' => 'nullable|array',
            'mata_kuliah.*' => 'nullable|string',
            'tipe_kelas' => 'nullable|array',
            'tipe_kelas.*' => 'nullable|in:teori,praktikum',
            'sks' => 'nullable|array',
            'sks.*' => 'nullable|numeric|min:1|max:6',
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

            // Simpan Mata Kuliah yang dipegang dosen
            if ($request->has('mata_kuliah') && is_array($request->mata_kuliah)) {
                foreach ($request->mata_kuliah as $key => $mataKuliah) {
                    if (!empty($mataKuliah)) {
                        \App\Models\DosenMataKuliah::create([
                            'dosen_id' => $dosen->id,
                            'mata_kuliah' => $mataKuliah,
                            'tipe_kelas' => $request->tipe_kelas[$key] ?? 'teori',
                            'sks' => $request->sks[$key] ?? 3,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.dashboard')->with('success', 'Dosen berhasil ditambahkan!');
    }

    // --- FUNGSI MENAMPILKAN DATA (INDEX) ---

    public function indexMahasiswa()
    {
        // Ambil semua data mahasiswa gabung dengan data user-nya (nama & email)
        $mahasiswas = \App\Models\Mahasiswa::with('user')->get();

        // Kirim data ke view index
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function indexDosen()
    {
        // Ambil semua data dosen gabung dengan data user-nya
        $dosens = \App\Models\Dosen::with('user')->get();

        return view('admin.dosen.index', compact('dosens'));
    }
}
