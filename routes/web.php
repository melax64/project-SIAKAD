<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login/admin', [LoginController::class, 'showAdminLogin'])->name('login.admin');
Route::get('/login/dosen', [LoginController::class, 'showDosenLogin'])->name('login.dosen');
Route::get('/login/mahasiswa', [LoginController::class, 'showMahasiswaLogin'])->name('login.mahasiswa');

// Login Admin
Route::get('/login/admin', [LoginController::class, 'showAdminLogin'])->name('login.admin');
Route::post('/login/admin', [LoginController::class, 'adminLogin']);

// DASHBOARD ADMIN
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

});

// Login Dosen
Route::get('/login/dosen', [LoginController::class, 'showDosenLogin'])->name('login.dosen');
Route::post('/login/dosen', [LoginController::class, 'dosenLogin']);

// Login Mahasiswa
Route::get('/login/mahasiswa', [LoginController::class, 'showMahasiswaLogin'])->name('login.mahasiswa');
Route::post('/login/mahasiswa', [LoginController::class, 'mahasiswaLogin'])->name('login.mahasiswa.post');

// ======================
// DASHBOARD MAHASISWA
// ======================
Route::middleware(['auth'])->group(function () {

    Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard', [
    'mahasiswa' => Auth::user(),
    'activePage' => 'dashboard'
]);
  
    })->name('mahasiswa.dashboard');

    // Menu lain di sidebar
    Route::get('/mahasiswa/krs', fn() => 'Halaman KRS')->name('mahasiswa.krs');
    Route::get('/mahasiswa/jadwal', fn() => 'Halaman Jadwal')->name('mahasiswa.jadwal');
    Route::get('/mahasiswa/nilai', fn() => 'Halaman Nilai')->name('mahasiswa.nilai');
    Route::get('/mahasiswa/pengumuman', fn() => 'Halaman Pengumuman')->name('mahasiswa.pengumuman');
    Route::get('/mahasiswa/profil', fn() => 'Halaman Profil')->name('mahasiswa.profil');

});
// ROUTES AUTH DEFAULT (jangan dihapus)
require __DIR__.'/auth.php';

