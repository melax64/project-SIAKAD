<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\MahasiswaMataKuliah;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    // Show Nilai Mahasiswa
    public function showNilai()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Get all nilai for this mahasiswa
        $nilaiList = Nilai::where('mahasiswa_id', $mahasiswa->id)
            ->with(['dosen.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate average nilai
        $averageNilai = 0;
        if ($nilaiList->isNotEmpty()) {
            $totalNilai = 0;
            foreach ($nilaiList as $nilai) {
                $nilaiAkhir = ($nilai->kehadiran ?? 0) * 0.1 +
                    ($nilai->tugas ?? 0) * 0.2 +
                    ($nilai->uts ?? 0) * 0.3 +
                    ($nilai->uas ?? 0) * 0.4;
                $totalNilai += $nilaiAkhir;
            }
            $averageNilai = $totalNilai / $nilaiList->count();
        }

        return view('mahasiswa.nilai', [
            'nilaiList' => $nilaiList,
            'averageNilai' => $averageNilai,
            'totalSks' => $nilaiList->count() * 3,
            'activePage' => 'nilai',
        ]);
    }

    // Show Profile Mahasiswa
    public function showProfil()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        return view('mahasiswa.profil', [
            'mahasiswa' => $mahasiswa,
            'user' => $user,
            'activePage' => 'profil',
        ]);
    }

    // Show Edit Profile Form
    public function editProfil()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        return view('mahasiswa.profil-edit', [
            'mahasiswa' => $mahasiswa,
            'user' => $user,
            'activePage' => 'profil',
        ]);
    }

    // Update Profile
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Update user data
        User::where('id', $user->id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('mahasiswa.profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    // Show KRS (Kartu Rencana Studi) - Isi KRS
    public function showKRS()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Ambil semua mata kuliah yang tersedia
        $mataKuliahs = MataKuliah::orderBy('nama_matakuliah')->get();

        // Ambil mata kuliah yang sudah dipilih mahasiswa semester ini
        $currentSemester = '2024/2025 Genap'; // Bisa disesuaikan dengan semester saat ini
        $selectedKRS = MahasiswaMataKuliah::where('mahasiswa_id', $mahasiswa->id)
            ->where('semester', $currentSemester)
            ->where('status', 'aktif')
            ->with('mataKuliah')
            ->get();

        $selectedIds = $selectedKRS->pluck('mata_kuliah_id')->toArray();

        // Hitung total SKS yang dipilih
        $totalSKS = $selectedKRS->sum(function ($item) {
            return $item->mataKuliah->sks;
        });

        return view('mahasiswa.isi-krs', [
            'mahasiswa' => $mahasiswa,
            'mataKuliahs' => $mataKuliahs,
            'selectedKRS' => $selectedKRS,
            'selectedIds' => $selectedIds,
            'totalSKS' => $totalSKS,
            'currentSemester' => $currentSemester,
            'activePage' => 'isi-krs',
        ]);
    }

    // Submit KRS (Simpan pilihan mata kuliah)
    public function submitKRS(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        $validated = $request->validate([
            'courses' => 'required|json',
        ]);

        $courseIds = json_decode($validated['courses'], true);

        if (!is_array($courseIds) || count($courseIds) === 0) {
            return redirect()->back()
                ->with('error', 'Pilih minimal satu mata kuliah!');
        }

        // Validasi SKS tidak melebihi batas
        $selectedCourses = MataKuliah::whereIn('id', $courseIds)->get();
        $totalSKS = $selectedCourses->sum('sks');

        if ($totalSKS > 24) {
            return redirect()->back()
                ->with('error', 'Total SKS melebihi batas maksimal (24 SKS). Total Anda: ' . $totalSKS . ' SKS');
        }

        try {
            DB::transaction(function () use ($mahasiswa, $courseIds) {
                $currentSemester = '2024/2025 Genap';

                // Hapus KRS yang lama
                MahasiswaMataKuliah::where('mahasiswa_id', $mahasiswa->id)
                    ->where('semester', $currentSemester)
                    ->where('status', 'aktif')
                    ->delete();

                // Tambahkan KRS yang baru
                foreach ($courseIds as $courseId) {
                    MahasiswaMataKuliah::create([
                        'mahasiswa_id' => $mahasiswa->id,
                        'mata_kuliah_id' => $courseId,
                        'status' => 'aktif',
                        'semester' => $currentSemester,
                    ]);
                }
            });

            return redirect()->back()
                ->with('success', 'KRS berhasil disimpan! Total SKS: ' . $totalSKS . ' SKS');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Print KRS (untuk PDF atau cetak)
    public function printKRS()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Ambil KRS yang aktif
        $currentSemester = '2024/2025 Genap';
        $krsItems = MahasiswaMataKuliah::where('mahasiswa_id', $mahasiswa->id)
            ->where('semester', $currentSemester)
            ->where('status', 'aktif')
            ->with('mataKuliah')
            ->get();

        // Hitung total SKS
        $totalSKS = $krsItems->sum(function ($item) {
            return $item->mataKuliah->sks;
        });

        return view('mahasiswa.krs-print', [
            'mahasiswa' => $mahasiswa,
            'krsItems' => $krsItems,
            'totalSKS' => $totalSKS,
            'currentSemester' => $currentSemester,
            'activePage' => 'cetak-krs',
        ]);
    }
}
