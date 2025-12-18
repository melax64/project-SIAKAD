<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'totalSks' => $nilaiList->count() * 3 // Assuming 3 SKS per subject (you can adjust)
        ]);
    }

    // Show Profile Mahasiswa
    public function showProfil()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        return view('mahasiswa.profil', [
            'mahasiswa' => $mahasiswa,
            'user' => $user
        ]);
    }

    // Show Edit Profile Form
    public function editProfil()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        return view('mahasiswa.profil-edit', [
            'mahasiswa' => $mahasiswa,
            'user' => $user
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
}
