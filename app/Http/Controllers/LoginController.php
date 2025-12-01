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
        public function dosenLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun ini bukan akun dosen.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

   public function mahasiswaLogin(Request $request)
{
    // Validasi email wajib diisi
    $request->validate([
        'email' => 'required|email'
    ]);

    // Cari user berdasarkan email
    $user = \App\Models\User::where('email', $request->email)->first();

    // Jika belum ada user → buat otomatis
    if (!$user) {
        $user = \App\Models\User::create([
            'name' => 'Mahasiswa ' . rand(1000, 9999),
            'email' => $request->email,
            'password' => bcrypt($request->password ?? '123456'),
            'role' => 'mahasiswa',
        ]);
    }

    // Login user tanpa cek password
    Auth::login($user);

    // Redirect ke dashboard mahasiswa
    return redirect()->route('mahasiswa.dashboard');
}


}