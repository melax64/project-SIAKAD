<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN DEPAN
Route::get('/', [LandingController::class, 'index'])->name('landing');

// 2. ROUTE LOGIN
Route::get('/login/admin', [LoginController::class, 'showAdminLogin'])->name('login.admin');
Route::post('/login/admin', [LoginController::class, 'adminLogin']);

Route::get('/login/dosen', [LoginController::class, 'showDosenLogin'])->name('login.dosen');
Route::post('/login/dosen', [LoginController::class, 'dosenLogin']);

Route::get('/login/mahasiswa', [LoginController::class, 'showMahasiswaLogin'])->name('login.mahasiswa');
Route::post('/login/mahasiswa', [LoginController::class, 'mahasiswaLogin'])->name('login.mahasiswa.post');


// 3. ROUTE UMUM (Redirect Dashboard saat login pertama kali)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;
        if ($role === 'admin') return redirect()->route('admin.dashboard');
        if ($role === 'dosen') return redirect()->route('dosen.dashboard'); // <--- Tambahan Dosen
        return redirect()->route('mahasiswa.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =========================================================================
// 4. GROUP ROUTE ADMIN (Mulai dari sini)
// =========================================================================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        $menuItems = [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'layout-dashboard', 'id' => 'dashboard'],
            ['label' => 'Mahasiswa', 'route' => 'admin.mahasiswa', 'icon' => 'users', 'id' => 'mahasiswa'],
            ['label' => 'Dosen', 'route' => 'admin.dosen', 'icon' => 'graduation-cap', 'id' => 'dosen'],
        ];
        return view('admin.dashboard', ['menuItems' => $menuItems, 'activePage' => 'dashboard']);
    })->name('admin.dashboard');

    // Link Sidebar Admin
    Route::get('/mahasiswa', [UserController::class, 'indexMahasiswa'])->name('admin.mahasiswa');
    Route::get('/dosen', [UserController::class, 'indexDosen'])->name('admin.dosen');

    // Create & Store
    Route::get('/mahasiswa/create', [UserController::class, 'createMahasiswa'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa', [UserController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');
    Route::get('/dosen/create', [UserController::class, 'createDosen'])->name('admin.dosen.create');
    Route::post('/dosen', [UserController::class, 'storeDosen'])->name('admin.dosen.store');

    // Dummy Routes (Penyelamat)
    Route::get('/matakuliah-dummy', fn() => 'Coming Soon')->name('admin.matakuliah');
    Route::get('/jadwal-dummy', fn() => 'Coming Soon')->name('admin.jadwal');
    Route::get('/krs-dummy', fn() => 'Coming Soon')->name('admin.krs');
    Route::get('/nilai-dummy', fn() => 'Coming Soon')->name('admin.nilai');
});
// <--- PENTING: TUTUP KURUNG ADMIN HARUS DI SINI! (Jangan sampai Dosen masuk ke dalam Admin)


// =========================================================================
// 5. GROUP ROUTE DOSEN (Harus Terpisah dari Admin)
// =========================================================================
Route::prefix('dosen')->middleware(['auth', 'role:dosen'])->group(function () {

    // Dashboard Dosen
    Route::get('/dashboard', function () {
        $menuItems = [
            ['label' => 'Dashboard', 'route' => 'dosen.dashboard', 'icon' => 'layout-dashboard', 'id' => 'dashboard'],
            ['label' => 'Jadwal Mengajar', 'route' => 'dosen.jadwal', 'icon' => 'calendar', 'id' => 'jadwal'],
            ['label' => 'Input Nilai', 'route' => 'dosen.nilai', 'icon' => 'file-text', 'id' => 'nilai'],
        ];

        // Pastikan view ini ada!
        return view('dosen.dashboard', [
            'user' => Auth::user(),
            'menuItems' => $menuItems,
            'activePage' => 'dashboard',
            'userName' => Auth::user()->name,
            'userRole' => 'Dosen',
        ]);
    })->name('dosen.dashboard');

    // Dummy Routes Dosen
    Route::get('/jadwal', fn() => 'Halaman Jadwal')->name('dosen.jadwal');
    Route::get('/nilai', [DosenController::class, 'showNilai'])->name('dosen.nilai');
    Route::post('/nilai', [DosenController::class, 'storeNilai'])->name('dosen.nilai.store');
    Route::get('/nilai/{id}/edit', [DosenController::class, 'editNilai'])->name('dosen.nilai.edit');
    Route::put('/nilai/{id}', [DosenController::class, 'updateNilai'])->name('dosen.nilai.update');
    Route::delete('/nilai/{id}', [DosenController::class, 'deleteNilai'])->name('dosen.nilai.delete');
    Route::get('/bimbingan', fn() => 'Halaman Bimbingan')->name('dosen.bimbingan');
    Route::get('/kelas', fn() => 'Halaman Daftar Kelas')->name('dosen.kelas');
    Route::get('/profil', [DosenController::class, 'showProfil'])->name('dosen.profil');
    Route::put('/profil', [DosenController::class, 'updateProfil'])->name('dosen.profil.update');

    // API untuk search mahasiswa (AJAX)
    Route::get('/api/search-mahasiswa/{nim}', function ($nim) {
        $mahasiswa = \App\Models\Mahasiswa::where('nim', $nim)->with('user')->first();

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa dengan NIM ' . $nim . ' tidak ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'mahasiswa' => $mahasiswa
        ]);
    })->name('dosen.api.search-mahasiswa');
});


// =========================================================================
// 6. GROUP ROUTE MAHASISWA
// =========================================================================
Route::prefix('mahasiswa')->middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();

        return view('mahasiswa.dashboard', [
            'mahasiswa' => $mahasiswa,
            'activePage' => 'dashboard',
        ]);
    })->name('mahasiswa.dashboard');

    Route::get('/krs', fn() => 'Halaman KRS')->name('mahasiswa.krs');
    Route::get('/jadwal', fn() => 'Halaman Jadwal')->name('mahasiswa.jadwal');
    Route::get('/nilai', [MahasiswaController::class, 'showNilai'])->name('mahasiswa.nilai');
    Route::get('/profil', [MahasiswaController::class, 'showProfil'])->name('mahasiswa.profil');
    Route::get('/profil/edit', [MahasiswaController::class, 'editProfil'])->name('mahasiswa.profil.edit');
    Route::put('/profil', [MahasiswaController::class, 'updateProfil'])->name('mahasiswa.profil.update');
});

require __DIR__ . '/auth.php';
