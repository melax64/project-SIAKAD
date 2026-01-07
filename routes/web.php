<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MataKuliahController;
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
        // Count dari database
        $mahasiswaCount = \App\Models\Mahasiswa::count();
        $dosenCount = \App\Models\Dosen::count();
        $mataKuliahCount = \App\Models\MataKuliah::count();

        return view('admin.dashboard', [
            'mahasiswaCount' => $mahasiswaCount,
            'dosenCount' => $dosenCount,
            'mataKuliahCount' => $mataKuliahCount,
            'activePage' => 'dashboard',
        ]);
    })->name('admin.dashboard');

    // Link Sidebar Admin
    Route::get('/mahasiswa', [UserController::class, 'indexMahasiswa'])->name('admin.mahasiswa');
    Route::get('/dosen', [UserController::class, 'indexDosen'])->name('admin.dosen');

    // Create & Store
    Route::get('/mahasiswa/create', [UserController::class, 'createMahasiswa'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa', [UserController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');
    Route::delete('/mahasiswa/{id}', [UserController::class, 'destroyMahasiswa'])->name('admin.mahasiswa.destroy');

    Route::get('/dosen/create', [UserController::class, 'createDosen'])->name('admin.dosen.create');
    Route::post('/dosen', [UserController::class, 'storeDosen'])->name('admin.dosen.store');
    Route::get('/dosen/{id}/edit', [UserController::class, 'editDosen'])->name('admin.dosen.edit');
    Route::put('/dosen/{id}', [UserController::class, 'updateDosen'])->name('admin.dosen.update');
    Route::delete('/dosen/{id}', [UserController::class, 'destroyDosen'])->name('admin.dosen.destroy');

    // Mata Kuliah CRUD
    Route::resource('matakuliah', MataKuliahController::class, [
        'except' => ['show'],
        'names' => [
            'index' => 'admin.matakuliah.index',
            'create' => 'admin.matakuliah.create',
            'store' => 'admin.matakuliah.store',
            'edit' => 'admin.matakuliah.edit',
            'update' => 'admin.matakuliah.update',
            'destroy' => 'admin.matakuliah.destroy',
        ]
    ]);

    // Dummy Routes (Penyelamat)
    Route::get('/matakuliah-dummy', fn() => 'Coming Soon')->name('admin.matakuliah');
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
        $user = Auth::user();
        $dosen = \App\Models\Dosen::where('user_id', $user->id)->first();

        // Count kelas dan mahasiswa
        $mataKuliahCount = $dosen->mataKuliah()->count();
        $nilaiCount = \App\Models\Nilai::where('dosen_id', $dosen->id)->count();

        return view('dosen.dashboard', [
            'user' => $user,
            'dosen' => $dosen,
            'mataKuliahCount' => $mataKuliahCount,
            'nilaiCount' => $nilaiCount,
            'activePage' => 'dashboard',
        ]);
    })->name('dosen.dashboard');

    // Routes untuk Input Nilai (Tugas, UTS, UAS)
    Route::get('/nilai/tugas', [DosenController::class, 'showInputNilaiTugas'])->name('dosen.nilai.tugas');
    Route::get('/nilai/uts', [DosenController::class, 'showInputNilaiUts'])->name('dosen.nilai.uts');
    Route::get('/nilai/uas', [DosenController::class, 'showInputNilaiUas'])->name('dosen.nilai.uas');
    Route::get('/nilai', [DosenController::class, 'showInputNilai'])->name('dosen.nilai');
    Route::get('/bimbingan', fn() => 'Halaman Bimbingan')->name('dosen.bimbingan');
    Route::get('/kelas', [DosenController::class, 'showKelas'])->name('dosen.kelas');
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

    // API untuk mendapatkan mata kuliah dosen
    Route::get('/api/mata-kuliah', [DosenController::class, 'getMataKuliah'])->name('dosen.api.mata-kuliah');

    // API untuk Input Nilai
    Route::get('/api/mahasiswa-by-kelas/{kelas}', [DosenController::class, 'getMahasiswaByKelas'])->name('dosen.api.mahasiswa-by-kelas');
    Route::get('/api/mahasiswa-by-matakuliah/{mataKuliah}', [DosenController::class, 'getMahasiswaByMataKuliah'])->name('dosen.api.mahasiswa-by-matakuliah');
    Route::post('/api/submit-nilai', [DosenController::class, 'submitNilai'])->name('dosen.api.submit-nilai');
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

    Route::get('/krs', [MahasiswaController::class, 'showKRS'])->name('mahasiswa.krs');
    Route::post('/krs/submit', [MahasiswaController::class, 'submitKRS'])->name('mahasiswa.krs.submit');
    Route::get('/krs/print', [MahasiswaController::class, 'printKRS'])->name('mahasiswa.krs.print');
    Route::get('/nilai', [MahasiswaController::class, 'showNilai'])->name('mahasiswa.nilai');
    Route::get('/profil', [MahasiswaController::class, 'showProfil'])->name('mahasiswa.profil');
    Route::get('/profil/edit', [MahasiswaController::class, 'editProfil'])->name('mahasiswa.profil.edit');
    Route::put('/profil', [MahasiswaController::class, 'updateProfil'])->name('mahasiswa.profil.update');
});

// =========================================================================
// 7. PUBLIC API ROUTES
// =========================================================================
Route::get('/api/kelas', function (Request $request) {
    $prodi = $request->query('prodi');
    $angkatan = $request->query('angkatan');

    $query = \App\Models\Kelas::query();

    if ($prodi) {
        $query->where('prodi', $prodi);
    }

    if ($angkatan) {
        $query->where('angkatan', $angkatan);
    }

    $kelas = $query->orderBy('nama_kelas')->get();

    return response()->json([
        'success' => true,
        'kelas' => $kelas
    ]);
});

require __DIR__ . '/auth.php';
