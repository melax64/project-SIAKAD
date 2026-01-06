# Dokumentasi Sistem Kelas

## Overview
Sistem Kelas telah ditambahkan ke SIAKAD untuk memungkinkan dosen menginput nilai dan memfilter per kelas atau per mata kuliah dengan lebih terstruktur.

## Database Schema

### Tabel `kelas`
```
- id (Primary Key)
- nama_kelas (string): Nama kelas seperti A1, A2, B1, B2
- prodi (string): Program Studi (Informatika, Sistem Informasi, dll)
- angkatan (year): Tahun angkatan mahasiswa
- kapasitas (integer): Kapasitas kelas (default: 40)
- timestamps (created_at, updated_at)
- Unique constraint: (nama_kelas, prodi, angkatan)
```

### Perubahan Tabel `mahasiswas`
- Kolom lama `kelas` (string) telah diganti dengan `kelas_id` (foreign key)
- `kelas_id` mereferensikan ke tabel `kelas`

## Models

### Kelas Model
Lokasi: `app/Models/Kelas.php`

**Relationships:**
- `mahasiswas()`: Relasi one-to-many dengan Mahasiswa
- `nilais()`: Relasi many-through dengan Nilai (melalui Mahasiswa)

**Accessor:**
- `getFullNameAttribute()`: Mengembalikan nama lengkap kelas (e.g., "A1 - Informatika 2022")

### Mahasiswa Model (Updated)
Lokasi: `app/Models/Mahasiswa.php`

**Relationships:**
- `user()`: Relasi ke User
- `kelas()`: Relasi ke Kelas
- `nilais()`: Relasi ke Nilai

### Nilai Model (Updated)
Lokasi: `app/Models/Nilai.php`

**Relationships:**
- `dosen()`: Relasi ke Dosen
- `mahasiswa()`: Relasi ke Mahasiswa
- `kelas()`: Relasi ke Kelas (melalui Mahasiswa)

## Controllers

### NilaiController
Lokasi: `app/Http/Controllers/NilaiController.php`

**Methods:**

#### 1. `index(Request $request)`
Menampilkan daftar nilai dengan filter
- Filter by `kelas_id`
- Filter by `mata_kuliah`
- Dosen hanya bisa melihat nilai dari mata kuliah yang mereka ajar
- Pagination: 15 record per halaman

**Parameters:**
```
GET /nilai
?kelas_id=1
?mata_kuliah=Pemrograman Web
```

#### 2. `inputForm(Request $request)`
Menampilkan form untuk input nilai per kelas
- Filter mahasiswa berdasarkan kelas
- Menampilkan informasi dosen yang login

**Parameters:**
```
GET /nilai/input
?kelas_id=1
?mata_kuliah=Pemrograman Web
```

#### 3. `store(Request $request)`
Menyimpan nilai untuk satu mahasiswa
- Otomatis menghitung nilai akhir dengan bobot:
  - Kehadiran: 10%
  - Tugas: 20%
  - UTS: 30%
  - UAS: 40%
- Otomatis menentukan nilai huruf (A, A-, B+, B, B-, C+, C, C-, D, E)

**Request Body:**
```json
{
  "mahasiswa_id": 1,
  "mata_kuliah": "Pemrograman Web",
  "kehadiran": 85,
  "tugas": 90,
  "uts": 80,
  "uas": 75,
  "catatan": "Bagus"
}
```

#### 4. `laporanKelas(Request $request)`
Menampilkan laporan nilai per kelas
- Filter by kelas dan mata kuliah
- Diurutkan berdasarkan mata kuliah dan nilai akhir (descending)

**Parameters:**
```
GET /nilai/laporan-kelas
?kelas_id=1
?mata_kuliah=Pemrograman Web
```

## Seeders

### KelasSeeder
Lokasi: `database/seeders/KelasSeeder.php`

Membuat data kelas untuk:
- **Informatika**: Angkatan 2022, 2023, 2024 (masing-masing 4 kelas: A1, A2, B1, B2)
- **Sistem Informasi**: Angkatan 2022, 2023, 2024 (masing-masing 3 kelas: A1, A2, B1)

Total: 21 kelas

### MahasiswaSeeder (Updated)
Lokasi: `database/seeders/MahasiswaSeeder.php`

- Data mahasiswa sekarang terhubung ke kelas melalui `kelas_id`
- Otomatis mencari kelas berdasarkan nama_kelas, prodi, dan angkatan

## Migrations

### `2026_01_06_create_kelas_table.php`
Membuat tabel `kelas` dengan struktur lengkap

### `2026_01_06_add_kelas_id_to_mahasiswas_table.php`
Menambahkan kolom `kelas_id` ke tabel `mahasiswas` sebagai foreign key

## Routes

Tambahkan routes berikut ke `routes/web.php`:

```php
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/input', [NilaiController::class, 'inputForm'])->name('nilai.input');
    Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');
    Route::get('/nilai/laporan-kelas', [NilaiController::class, 'laporanKelas'])->name('nilai.laporan-kelas');
});
```

## Cara Menggunakan

### 1. Jalankan Migrations
```bash
php artisan migrate
```

### 2. Jalankan Seeders
```bash
php artisan db:seed --class=KelasSeeder
php artisan db:seed --class=MahasiswaSeeder
```

### 3. Akses Fitur
- Dosen login ke sistem
- Navigasi ke `/nilai`
- Pilih filter kelas dan/atau mata kuliah
- Klik "Input Nilai" untuk menginput nilai mahasiswa
- Atau lihat laporan di `/nilai/laporan-kelas`

## Contoh Query

### Mendapatkan nilai per kelas:
```php
$nilais = Nilai::with(['mahasiswa.kelas'])
    ->whereHas('mahasiswa', function ($q) {
        $q->where('kelas_id', 1);
    })
    ->get();
```

### Mendapatkan mahasiswa per kelas:
```php
$mahasiswas = Mahasiswa::where('kelas_id', 1)->get();
```

### Mendapatkan semua nilai di satu kelas:
```php
$kelas = Kelas::find(1);
$nilais = $kelas->nilais()->get();
```

## Notes

- `kelas_id` pada mahasiswa bersifat nullable untuk backward compatibility
- Nilai huruf otomatis dihitung berdasarkan nilai akhir
- Setiap kelas unik berdasarkan kombinasi nama_kelas, prodi, dan angkatan
- Sistem mendukung multiple program studi dengan kelas yang sama di angkatan berbeda
