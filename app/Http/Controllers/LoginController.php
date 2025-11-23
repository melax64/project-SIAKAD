<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showAdminLogin()
    {
        return view('auth.login-admin');
    }

    public function showMahasiswaLogin()
    {
        return view('auth.login-mahasiswa'); // ganti sesuai path view-mu
    }

    public function showDosenLogin()
    {
        return view('auth.login-dosen'); // ganti sesuai path view-mu
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Login admin pakai default user dulu
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }
}