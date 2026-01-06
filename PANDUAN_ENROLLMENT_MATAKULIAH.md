# 📚 Panduan: Cara Mahasiswa Ambil Mata Kuliah (Isi KRS)

## ✨ Fitur yang Telah Diimplementasikan

### 1. **Database & Model**
- ✅ Tabel `mahasiswa_mata_kuliahs` untuk menyimpan enrollment
- ✅ Model `MahasiswaMataKuliah` untuk manage relasi
- ✅ Relationship di model `Mahasiswa` dan `MataKuliah`

### 2. **Controller & Logic**
- ✅ Method `showKRS()` - Tampilkan form isi KRS
- ✅ Method `submitKRS()` - Submit/simpan pilihan mata kuliah
- ✅ Validasi SKS maksimal 24 per semester
- ✅ Prevent duplicate enrollment (unique constraint)

### 3. **View & UI**
- ✅ `isi-krs.blade.php` - Interface pilih mata kuliah
- ✅ Real-time SKS counter dengan Alpine.js
- ✅ Responsive design dengan Tailwind CSS

### 4. **Routes**
```
GET  /mahasiswa/krs              → showKRS()       (lihat form)
POST /mahasiswa/krs/submit       → submitKRS()    (simpan KRS)
GET  /mahasiswa/krs/print        → printKRS()     (cetak KRS)
```

---

## 🎯 Cara Kerja Sistem

### **Step 1: Mahasiswa Masuk ke Menu "Isi KRS"**
```
URL: /mahasiswa/krs
```
- System load semua mata kuliah dari tabel `mata_kuliahs`
- System load KRS yang sudah disimpan (jika ada)

### **Step 2: Pilih Mata Kuliah**
- Mahasiswa checkbox mata kuliah yang ingin diambil
- Real-time tracking total SKS
- Alert jika melebihi 24 SKS (tidak bisa submit)

### **Step 3: Simpan KRS**
```php
POST /mahasiswa/krs/submit
Data: {
    "courses": [1, 2, 3, 4]  // Array ID mata kuliah
}
```

Process:
1. Validasi total SKS ≤ 24 SKS
2. Hapus KRS lama untuk semester ini
3. Insert KRS baru ke tabel `mahasiswa_mata_kuliahs`
4. Redirect dengan success message

### **Step 4: Lihat/Cetak KRS**
```
GET /mahasiswa/krs/print
```
- Cetak KRS untuk keperluan akademik

---

## 💾 Database Structure

### Tabel: `mahasiswa_mata_kuliahs`
```sql
CREATE TABLE mahasiswa_mata_kuliahs (
    id              BIGINT PRIMARY KEY
    mahasiswa_id    BIGINT (FK → mahasiswas)
    mata_kuliah_id  BIGINT (FK → mata_kuliahs)
    status          ENUM('aktif', 'batal', 'selesai') DEFAULT 'aktif'
    semester        VARCHAR(255) -- '2024/2025 Genap'
    created_at      TIMESTAMP
    updated_at      TIMESTAMP
    
    UNIQUE(mahasiswa_id, mata_kuliah_id, semester)
)
```

---

## 📖 Code Examples

### **1. Ambil KRS Mahasiswa (dengan mata kuliah)**
```php
$mahasiswa = Mahasiswa::find(1);
$krsItems = $mahasiswa->mataKuliahs()->get();

foreach ($krsItems as $krs) {
    echo $krs->mataKuliah->nama_matakuliah . ' - ' . 
         $krs->mataKuliah->sks . ' SKS';
}
```

### **2. Hitung Total SKS**
```php
$totalSKS = $mahasiswa->mataKuliahs()
    ->whereStatus('aktif')
    ->with('mataKuliah')
    ->get()
    ->sum(fn($krs) => $krs->mataKuliah->sks);
```

### **3. Get Mata Kuliah yang Diambil di Semester Tertentu**
```php
$semester = '2024/2025 Genap';
$mataKuliahs = $mahasiswa->mataKuliahs()
    ->where('semester', $semester)
    ->where('status', 'aktif')
    ->with('mataKuliah')
    ->get();
```

---

## 🔧 Customization

### **Ubah Maksimal SKS**
File: `app/Http/Controllers/Mahasiswa/MahasiswaController.php`
```php
// Line: submitKRS()
if ($totalSKS > 24) {  // ← Ubah 24 sesuai kebutuhan
    return redirect()->back()
        ->with('error', 'SKS melebihi batas...');
}
```

### **Ubah Semester**
```php
// Dari hardcoded menjadi dynamic (optional)
$currentSemester = getSemesterAktif(); // buatan sendiri
```

### **Tambah Status KRS**
Edit enum di migration jika perlu status lain:
```php
$table->enum('status', ['aktif', 'batal', 'selesai', 'pending'])->default('aktif');
```

---

## 🚀 Testing

### **Test 1: Submit KRS**
```bash
# Login sebagai mahasiswa
# Buka: /mahasiswa/krs
# Pilih 3 mata kuliah (total 9 SKS)
# Klik "Simpan KRS"
# Cek database: SELECT * FROM mahasiswa_mata_kuliahs WHERE mahasiswa_id = 1
```

### **Test 2: SKS Validation**
```bash
# Coba pilih mata kuliah dengan total > 24 SKS
# Button "Simpan KRS" harus disabled
# Error message muncul
```

### **Test 3: Update KRS**
```bash
# Submit KRS dengan mata kuliah A, B, C
# Submit lagi dengan mata kuliah A, B, D
# Cek database: C harus terhapus, D harus ditambah
```

---

## ✅ Checklist Implementasi

- [x] Create migration `mahasiswa_mata_kuliahs`
- [x] Create model `MahasiswaMataKuliah`
- [x] Update relationship di `Mahasiswa` model
- [x] Update relationship di `MataKuliah` model
- [x] Add `showKRS()` method
- [x] Add `submitKRS()` method
- [x] Add `printKRS()` method
- [x] Update routes (`web.php`)
- [x] Update view (`isi-krs.blade.php`)
- [x] Add CSRF token validation
- [x] Add SKS validation
- [x] Add success/error messages

---

## 🐛 Troubleshooting

### **Error: "Route not found"**
→ Jalankan: `php artisan route:cache --clear`

### **Error: "SQLSTATE foreign key"**
→ Pastikan tabel `mata_kuliahs` dan `mahasiswas` sudah ada

### **SKS tidak ter-update**
→ Cek: data `courses` di form harus valid JSON array

### **KRS tidak tersimpan**
→ Debug: `dd($courseIds);` di controller untuk lihat data

---

## 📝 Notes

1. **Semester**: Saat ini hardcoded `'2024/2025 Genap'`, bisa disesuaikan
2. **Dosen Assignment**: Belum auto-assign dosen, bisa ditambah di future
3. **Schedule Conflict**: Belum ada validasi jadwal bertabrakan
4. **Prereq Validation**: Belum ada validasi syarat kelulusan mata kuliah

---

## 🔗 Related Files

```
app/
├── Models/
│   ├── MahasiswaMataKuliah.php  ← NEW
│   ├── Mahasiswa.php             ← UPDATED (relasi)
│   └── MataKuliah.php            ← UPDATED (relasi)
├── Http/Controllers/
│   └── Mahasiswa/
│       └── MahasiswaController.php ← UPDATED (3 methods)

database/
├── migrations/
│   └── 2025_01_06_create_mahasiswa_mata_kuliahs_table.php ← NEW
└── seeders/
    └── MahasiswaSeeder.php        (no changes)

resources/views/
└── mahasiswa/
    └── isi-krs.blade.php          ← UPDATED

routes/
└── web.php                        ← UPDATED (1 route added)
```

---

**Sistem enrollment mata kuliah sudah siap digunakan! 🎉**
