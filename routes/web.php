<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;

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


// 3. ROUTE UMUM (Redirect Dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('mahasiswa.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// 4. GROUP ROUTE ADMIN
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    
    // --- DASHBOARD ---
    Route::get('/dashboard', function () {
        // Kita hanya siapkan 3 menu utama
        $menuItems = [
            [
                'label' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'layout-dashboard',
                'id' => 'dashboard'
            ],
            [
                'label' => 'Mahasiswa',
                'route' => 'admin.mahasiswa',
                'icon' => 'users',
                'id' => 'mahasiswa'
            ],
            [
                'label' => 'Dosen',
                'route' => 'admin.dosen',
                'icon' => 'graduation-cap',
                'id' => 'dosen'
            ],
        ];

        return view('admin.dashboard', [
            'menuItems' => $menuItems,
            'activePage' => 'dashboard'
        ]);
    })->name('admin.dashboard');

    // ==========================================================
    // RUTE PENYELAMAT (Agar error Route Not Defined hilang)
    // ==========================================================
    
    // ==========================================================
    // RUTE DATA UTAMA (Link Sidebar akan mengarah ke sini)
    // ==========================================================
    
    // 1. Link Data Mahasiswa -> Menampilkan Tabel
    Route::get('/mahasiswa', [UserController::class, 'indexMahasiswa'])->name('admin.mahasiswa');

    // 2. Link Data Dosen -> Menampilkan Tabel
    Route::get('/dosen', [UserController::class, 'indexDosen'])->name('admin.dosen');

    // ... (Biarkan rute create/store dan dummy matakuliah tetap ada) ...
    
    // 3. Dummy Matakuliah (Biar gak error)
    Route::get('/matakuliah-dummy', function() {
        return "Coming Soon";
    })->name('admin.matakuliah'); 

    // 4. Dummy JADWAL 
    Route::get('/jadwal-dummy', function() {
        return "Coming Soon";
    })->name('admin.jadwal'); 
    
    // 5. Dummy KRS 
    Route::get('/krs-dummy', function() {
        return "Coming Soon";
    })->name('admin.krs'); 

    Route::get('/pengumuman-dummy', function() {
        return "Coming Soon";
    })->name('admin.pengumuman');

    Route ::get('/settings-dummy', function() {
        return "Coming Soon";
    })->name('admin.settings');
    // ==========================================================


    // --- LOGIC INPUT DATA ---
    Route::get('/mahasiswa/create', [UserController::class, 'createMahasiswa'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa', [UserController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');

    Route::get('/dosen/create', [UserController::class, 'createDosen'])->name('admin.dosen.create');
    Route::post('/dosen', [UserController::class, 'storeDosen'])->name('admin.dosen.store');
});


// 5. GROUP ROUTE MAHASISWA
Route::prefix('mahasiswa')->middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard', function () {
        return view('mahasiswa.dashboard', [
            'mahasiswa' => Auth::user(),
            'activePage' => 'dashboard'
        ]);
    })->name('mahasiswa.dashboard');

    Route::get('/krs', fn() => 'Halaman KRS')->name('mahasiswa.krs');
    Route::get('/jadwal', fn() => 'Halaman Jadwal')->name('mahasiswa.jadwal');
    Route::get('/nilai', fn() => 'Halaman Nilai')->name('mahasiswa.nilai');
    Route::get('/pengumuman', fn() => 'Halaman Pengumuman')->name('mahasiswa.pengumuman');
    Route::get('/profil-akademik', fn() => 'Halaman Profil Akademik')->name('mahasiswa.profil.akademik');
});

require __DIR__ . '/auth.php';