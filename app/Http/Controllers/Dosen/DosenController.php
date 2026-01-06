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

    // ===== HALAMAN INPUT NILAI TABEL (BARU) =====
    public function showNilaiTable()
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        // Get mata kuliah yang diajar dosen
        $mataKuliahList = \App\Models\DosenMataKuliah::where('dosen_id', $dosen->id)
            ->select('mata_kuliah', 'tipe_kelas', 'sks')
            ->distinct()
            ->get();

        return view('dosen.nilai-table', [
            'mataKuliahList' => $mataKuliahList,
            'activePage' => 'input-nilai',
        ]);
    }

    // API untuk get mahasiswa berdasarkan mata kuliah
    public function getMahasiswaByMataKuliah($mataKuliah)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        // Cek apakah dosen mengajar mata kuliah ini
        $dosenMataKuliah = \App\Models\DosenMataKuliah::where('dosen_id', $dosen->id)
            ->where('mata_kuliah', $mataKuliah)
            ->first();

        if (!$dosenMataKuliah) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak mengajar mata kuliah ini'
            ], 403);
        }

        // Get mahasiswa yang terdaftar di mata kuliah ini
        // Asumsikan ada tabel enrollment atau sejenisnya
        // Untuk sekarang, kita tampilkan semua mahasiswa dengan nilai yang sudah ada
        $nilaiList = Nilai::where('dosen_id', $dosen->id)
            ->where('mata_kuliah', $mataKuliah)
            ->with(['mahasiswa.user'])
            ->get();

        // Format data untuk response
        $data = $nilaiList->map(function ($nilai) {
            return [
                'id' => $nilai->id,
                'mahasiswa_id' => $nilai->mahasiswa_id,
                'nama' => $nilai->mahasiswa->user->name,
                'nim' => $nilai->mahasiswa->nim,
                'kelas' => $nilai->mahasiswa->prodi ?? '-',
                'nilai_angka' => $nilai->nilai_akhir ?? 0,
                'nilai_huruf' => $this->convertToGrade($nilai->nilai_akhir ?? 0),
            ];
        });

        return response()->json([
            'success' => true,
            'mahasiswa' => $data
        ]);
    }

    // Store nilai dari tabel (AJAX/FORM)
    public function storeNilaiTable(Request $request)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        $validated = $request->validate([
            'mata_kuliah' => 'required|string',
            'nilai_data' => 'required|array',
            'nilai_data.*.mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nilai_data.*.nilai_angka' => 'required|numeric|min:0|max:100',
        ]);

        $mata_kuliah = $validated['mata_kuliah'];

        // Cek apakah dosen mengajar mata kuliah ini
        $dosenMataKuliah = \App\Models\DosenMataKuliah::where('dosen_id', $dosen->id)
            ->where('mata_kuliah', $mata_kuliah)
            ->first();

        if (!$dosenMataKuliah) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak mengajar mata kuliah ini'
            ], 403);
        }

        // Simpan/update nilai untuk setiap mahasiswa
        foreach ($validated['nilai_data'] as $item) {
            $nilai = Nilai::where('dosen_id', $dosen->id)
                ->where('mahasiswa_id', $item['mahasiswa_id'])
                ->where('mata_kuliah', $mata_kuliah)
                ->first();

            if ($nilai) {
                // Update
                $nilai->update([
                    'nilai_akhir' => $item['nilai_angka'],
                    'nilai_huruf' => $this->convertToGrade($item['nilai_angka']),
                ]);
            } else {
                // Create
                Nilai::create([
                    'dosen_id' => $dosen->id,
                    'mahasiswa_id' => $item['mahasiswa_id'],
                    'mata_kuliah' => $mata_kuliah,
                    'nilai_akhir' => $item['nilai_angka'],
                    'nilai_huruf' => $this->convertToGrade($item['nilai_angka']),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Nilai berhasil disimpan!'
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
