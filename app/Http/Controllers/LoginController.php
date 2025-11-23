<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function adminLogin() {
        return view('auth.login-admin');
    }

    public function dosenLogin() {
        return view('auth.login-dosen');
    }

    public function mahasiswaLogin() {
        return view('auth.login-mahasiswa');
    }
}