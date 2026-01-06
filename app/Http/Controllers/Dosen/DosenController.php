<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    // Profil Dosen
    public function showProfil()
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        return view('dosen.profil', [
            'dosen' => $dosen,
            'activePage' => 'profil',
        ]);
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'jabatan' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update user data
        User::where('id', $user->id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => !empty($validated['password']) ? Hash::make($validated['password']) : $user->password,
        ]);

        // Update dosen data
        if ($dosen && !empty($validated['jabatan'])) {
            $dosen->update(['jabatan' => $validated['jabatan']]);
        }

        return redirect()->route('dosen.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    // Input Nilai
    public function showNilai()
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        $nilaiList = Nilai::where('dosen_id', $dosen->id)
            ->with(['mahasiswa.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dosen.nilai', [
            'nilaiList' => $nilaiList,
            'activePage' => 'input-nilai',
        ]);
    }

    public function storeNilai(Request $request)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        // Validasi
        $validated = $request->validate([
            'nim' => 'required|string|exists:mahasiswas,nim',
            'kehadiran' => 'nullable|numeric|min:0|max:100',
            'tugas' => 'nullable|numeric|min:0|max:100',
            'uts' => 'nullable|numeric|min:0|max:100',
            'uas' => 'nullable|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        // Cari mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $validated['nim'])->first();

        if (!$mahasiswa) {
            return back()->withErrors(['nim' => 'Mahasiswa dengan NIM tersebut tidak ditemukan.']);
        }

        // Check apakah nilai sudah ada
        $nilaiExists = Nilai::where('dosen_id', $dosen->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->first();

        if ($nilaiExists) {
            // Update nilai yang sudah ada
            $nilaiExists->update([
                'kehadiran' => $validated['kehadiran'] ?? $nilaiExists->kehadiran,
                'tugas' => $validated['tugas'] ?? $nilaiExists->tugas,
                'uts' => $validated['uts'] ?? $nilaiExists->uts,
                'uas' => $validated['uas'] ?? $nilaiExists->uas,
                'catatan' => $validated['catatan'] ?? $nilaiExists->catatan,
            ]);

            $message = 'Nilai mahasiswa berhasil diperbarui!';
        } else {
            // Buat nilai baru
            Nilai::create([
                'dosen_id' => $dosen->id,
                'mahasiswa_id' => $mahasiswa->id,
                'kehadiran' => $validated['kehadiran'],
                'tugas' => $validated['tugas'],
                'uts' => $validated['uts'],
                'uas' => $validated['uas'],
                'catatan' => $validated['catatan'],
            ]);

            $message = 'Nilai mahasiswa berhasil disimpan!';
        }

        return back()->with('success', $message);
    }

    public function editNilai($id)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        $nilai = Nilai::where('id', $id)
            ->where('dosen_id', $dosen->id)
            ->with(['mahasiswa.user'])
            ->firstOrFail();

        $nilaiList = Nilai::where('dosen_id', $dosen->id)
            ->with(['mahasiswa.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dosen.nilai-edit', [
            'nilai' => $nilai,
            'nilaiList' => $nilaiList
        ]);
    }

    public function updateNilai(Request $request, $id)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        $nilai = Nilai::where('id', $id)
            ->where('dosen_id', $dosen->id)
            ->firstOrFail();

        // Validasi
        $validated = $request->validate([
            'kehadiran' => 'nullable|numeric|min:0|max:100',
            'tugas' => 'nullable|numeric|min:0|max:100',
            'uts' => 'nullable|numeric|min:0|max:100',
            'uas' => 'nullable|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        // Update nilai
        $nilai->update([
            'kehadiran' => $validated['kehadiran'] ?? $nilai->kehadiran,
            'tugas' => $validated['tugas'] ?? $nilai->tugas,
            'uts' => $validated['uts'] ?? $nilai->uts,
            'uas' => $validated['uas'] ?? $nilai->uas,
            'catatan' => $validated['catatan'] ?? $nilai->catatan,
        ]);

        return redirect()->route('dosen.nilai')->with('success', 'Nilai berhasil diperbarui!');
    }

    public function deleteNilai($id)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        $nilai = Nilai::where('id', $id)
            ->where('dosen_id', $dosen->id)
            ->firstOrFail();

        $nilai->delete();

        return back()->with('success', 'Nilai berhasil dihapus!');
    }

    // API untuk mendapatkan mata kuliah dosen
    public function getMataKuliah()
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ], 404);
        }

        $mataKuliah = \App\Models\DosenMataKuliah::where('dosen_id', $dosen->id)->get();

        return response()->json([
            'success' => true,
            'mataKuliah' => $mataKuliah
        ]);
    }

    // Menampilkan halaman input nilai
    public function showInputNilai()
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->with('mataKuliah.mataKuliah')->first();

        return view('dosen.nilai-input', [
            'dosen' => $dosen,
            'activePage' => 'input-nilai',
        ]);
    }

    // Get mahasiswa berdasarkan mata kuliah
    public function getMahasiswaByMataKuliah($dosenMataKuliahId, Request $request)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        // Cari mata kuliah dari DosenMataKuliah berdasarkan ID
        $dosenMataKuliah = \App\Models\DosenMataKuliah::where('id', $dosenMataKuliahId)
            ->where('dosen_id', $dosen->id)
            ->first();

        if (!$dosenMataKuliah) {
            return response()->json([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ], 404);
        }

        // Optional kelas and prodi filter via query parameters
        $kelas = $request->query('kelas');
        $prodiCode = $request->query('prodi');

        // Pertama, dapatkan ID mata kuliah dari nama
        $mataKuliahObj = \App\Models\MataKuliah::where('nama_matakuliah', $dosenMataKuliah->mata_kuliah)->first();
        
        if (!$mataKuliahObj) {
            return response()->json([
                'success' => false,
                'message' => 'Data mata kuliah tidak ditemukan'
            ], 404);
        }

        // Dapatkan mahasiswa yang terdaftar di mata kuliah ini
        $query = Mahasiswa::with(['user', 'kelas'])
            ->whereHas('mataKuliahs', function ($q) use ($mataKuliahObj) {
                $q->where('mata_kuliah_id', $mataKuliahObj->id);
            });

        if ($kelas) {
            $query->where('kelas', $kelas);
        }

        // Map of prodi full name => code
        $kodeMap = [
            'Teknik Informatika' => 'TI',
            'Teknologi Rekayasa Multimedia' => 'TRMM',
            'Teknologi Rekayasa Komputer Jaringan' => 'TRKJ',
        ];

        $prodiName = null;
        if ($prodiCode) {
            $prodiName = array_search($prodiCode, $kodeMap, true);
            if ($prodiName) {
                $query->where('prodi', $prodiName);
            }
        }

        // Jika tidak ada filter, batasi hasil untuk performa (tune as needed)
        $mahasiswas = $query->orderBy('prodi')->orderBy('angkatan')->get();

        // Transform data untuk menambahkan nama kelas dan nilai yang sudah ada
        $mahasiswas = $mahasiswas->map(function ($mhs) use ($dosen, $dosenMataKuliah) {
            // Cari nilai yang sudah ada untuk mahasiswa ini
            $nilai = Nilai::where('mahasiswa_id', $mhs->id)
                ->where('dosen_id', $dosen->id)
                ->where('mata_kuliah', $dosenMataKuliah->mata_kuliah)
                ->first();

            return [
                'id' => $mhs->id,
                'nim' => $mhs->nim,
                'prodi' => $mhs->prodi,
                'angkatan' => $mhs->angkatan,
                'kelas' => $mhs->kelas ? $mhs->kelas->nama_kelas : '-',
                'nilai_angka' => $nilai ? $nilai->nilai_angka : null,
                'nilai_huruf' => $nilai ? $nilai->nilai_huruf : null,
                'user' => [
                    'name' => $mhs->user->name ?? '-',
                    'email' => $mhs->user->email ?? '-',
                ]
            ];
        });

        return response()->json([
            'success' => true,
            'mahasiswa' => $mahasiswas,
        ]);
    }

    // Submit nilai
    public function submitNilai(Request $request)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        $nilai = $request->input('nilai', []);

        if (empty($nilai)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada nilai yang disubmit'
            ], 400);
        }

        try {
            foreach ($nilai as $item) {
                // Get mata kuliah name from dosen_mata_kuliah ID
                $dosenMataKuliah = \App\Models\DosenMataKuliah::find($item['mata_kuliah']);
                
                if (!$dosenMataKuliah) {
                    continue; // Skip if not found
                }

                // Hitung nilai akhir dari nilai_angka
                // Asumsi nilai_angka adalah nilai akhir (bisa disesuaikan)
                $nilaiModel = Nilai::updateOrCreate(
                    [
                        'mahasiswa_id' => $item['mahasiswa_id'],
                        'dosen_id' => $dosen->id,
                        'mata_kuliah' => $dosenMataKuliah->mata_kuliah, // Use mata_kuliah name
                    ],
                    [
                        'nilai_angka' => $item['nilai_angka'],
                        'nilai_huruf' => $item['nilai_huruf'],
                        'uas' => $item['nilai_angka'], // Simpan nilai ke UAS juga (bisa disesuaikan)
                    ]
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'Nilai berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Daftar Kelas
    public function showKelas(Request $request)
    {
        $query = Mahasiswa::query();

        // Filter berdasarkan prodi
        if ($request->filled('prodi')) {
            $query->where('prodi', $request->prodi);
        }

        // Filter berdasarkan angkatan
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->whereHas('kelas', function ($q) use ($request) {
                $q->where('nama_kelas', 'like', $request->kelas . '%');
            });
        }

        $mahasiswas = $query->with(['user', 'kelas'])->get();

        return view('dosen.kelas', [
            'mahasiswas' => $mahasiswas,
            'activePage' => 'daftar-kelas',
        ]);
    }

    // Helper function: Convert nilai angka ke huruf
    private function convertToGrade($nilai)
    {
        if ($nilai >= 85) {
            return 'A';
        } elseif ($nilai >= 80) {
            return 'A-';
        } elseif ($nilai >= 75) {
            return 'B+';
        } elseif ($nilai >= 70) {
            return 'B';
        } elseif ($nilai >= 65) {
            return 'B-';
        } elseif ($nilai >= 60) {
            return 'C+';
        } elseif ($nilai >= 55) {
            return 'C';
        } elseif ($nilai >= 50) {
            return 'C-';
        } elseif ($nilai >= 40) {
            return 'D';
        } else {
            return 'E';
        }
    }
}
