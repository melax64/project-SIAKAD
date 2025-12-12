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
            'dosen' => $dosen
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
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Update dosen data
        if ($dosen && !empty($validated['jabatan'])) {
            $dosen->jabatan = $validated['jabatan'];
            $dosen->save();
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
            'nilaiList' => $nilaiList
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
}
