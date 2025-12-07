<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ==========================================================
    // BAGIAN TAMPILAN (VIEW)
    // ==========================================================
    public function showAdminLogin()
    {
        return view('auth.login-admin');
    }

    public function showMahasiswaLogin()
    {
        return view('auth.login-mahasiswa');
    }

    public function showDosenLogin()
    {
        return view('auth.login-dosen');
    }

    // ==========================================================
    // BAGIAN LOGIC LOGIN
    // ==========================================================

    // 1. LOGIN ADMIN
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Wajib untuk keamanan session

            // Cek apakah role-nya benar Admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika login berhasil tapi role bukan admin, tendang keluar
            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda tidak memiliki akses Admin.']);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }
    

    // 2. LOGIN DOSEN
    public function dosenLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'dosen') {
                return redirect()->route('dosen.dashboard'); // Pastikan route ini ada
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda bukan Dosen.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    // 3. LOGIN MAHASISWA (SUDAH DIPERBAIKI)
    public function mahasiswaLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek User di Database (Harus cocok email & password)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda bukan Mahasiswa.']);
        }

        // Jika data tidak ditemukan atau password salah
        return back()->withErrors([
            'email' => 'Email atau password salah (Pastikan sudah terdaftar di Admin).',
        ]);
    }
}