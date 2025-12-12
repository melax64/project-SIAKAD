🎯 STEP-BY-STEP TESTING DASHBOARD ADMIN

┌─────────────────────────────────────────────────────────────────────┐
│ STEP 1: Pastikan Server Running                                     │
└─────────────────────────────────────────────────────────────────────┘

Buka terminal, jalankan:
$ cd d:\MATERI PERKULIAHAN\SEM 3 WORKSHOP WEB LANJUT\project-SIAKAD
$ php artisan serve

Expected: "Application running on http://127.0.0.1:8000"

┌─────────────────────────────────────────────────────────────────────┐
│ STEP 2: Buka Login Admin                                            │
└─────────────────────────────────────────────────────────────────────┘

Buka browser:
URL: http://127.0.0.1:8000/login/admin

Expected:
✓ Halaman login muncul
✓ Ada form dengan field: Email & Password
✓ Ada button: Login

┌─────────────────────────────────────────────────────────────────────┐
│ STEP 3: Masukkan Credentials Admin                                  │
└─────────────────────────────────────────────────────────────────────┘

Email: admin@siakad.com
Password: 123456

✓ Klik tombol Login

┌─────────────────────────────────────────────────────────────────────┐
│ STEP 4: Verifikasi Dashboard Admin Muncul                           │
└─────────────────────────────────────────────────────────────────────┘

URL akan berubah menjadi: http://127.0.0.1:8000/admin/dashboard

Expected tampilan:
┌────────────────────────────────────────────────┐
│ 📊 Dashboard Admin                             │
│ Selamat datang di Sistem Informasi Akademik   │
│                                                │
│ [SIDEBAR]              [MAIN CONTENT]          │
│ - Dashboard ✓          ┌──────────────────┐   │
│ - Data Mahasiswa       │ Kelola Data      │   │
│ - Data Dosen           │ Pengguna         │   │
│                        │                  │   │
│                        │ [+ Mahasiswa]    │   │
│                        │ [+ Dosen]        │   │
│                        └──────────────────┘   │
└────────────────────────────────────────────────┘

Checklist:
☐ URL: /admin/dashboard
☐ Heading: "Dashboard Admin"
☐ Sidebar visible dengan 3 menu items
☐ Main content area visible
☐ Ada 2 button: "Tambah Mahasiswa" dan "Tambah Dosen"
☐ Button bisa di-click

┌─────────────────────────────────────────────────────────────────────┐
│ STEP 5: Test Navigasi Sidebar                                       │
└─────────────────────────────────────────────────────────────────────┘

Klik "Data Mahasiswa" di sidebar
Expected:
✓ URL berubah ke: /admin/mahasiswa
✓ Halaman daftar mahasiswa ditampilkan
✓ Ada button "Tambah Mahasiswa"

Klik "Data Dosen" di sidebar
Expected:
✓ URL berubah ke: /admin/dosen
✓ Halaman daftar dosen ditampilkan
✓ Ada button "Tambah Dosen"

Klik "Dashboard" di sidebar
Expected:
✓ URL berubah kembali ke: /admin/dashboard
✓ Kembali ke dashboard utama

┌─────────────────────────────────────────────────────────────────────┐
│ STEP 6: Test Tambah Mahasiswa                                       │
└─────────────────────────────────────────────────────────────────────┘

Klik button "Tambah Mahasiswa"
Expected:
✓ URL: /admin/mahasiswa/create
✓ Form muncul dengan field:
  - Name (text input)
  - Email (email input)
  - NIM (text input)
  - Prodi (text input)

Isi form:
  Name: Budi Santoso
  Email: budi@student.pnl.ac.id
  NIM: 2024573010001
  Prodi: Teknik Informatika

Klik "Create" / "Save"
Expected:
✓ Data tersimpan
✓ Redirect ke dashboard
✓ Success message muncul
✓ Mahasiswa baru terlihat di list

┌─────────────────────────────────────────────────────────────────────┐
│ STEP 7: Verifikasi Login Sebagai Mahasiswa Baru                     │
└─────────────────────────────────────────────────────────────────────┘

Logout dari admin (klik menu profile → logout)
Buka: /login/mahasiswa

Login dengan:
Email: budi@student.pnl.ac.id
Password: (gunakan NIM: 2024573010001)

Expected:
✓ Login berhasil
✓ Redirect ke: /mahasiswa/dashboard
✓ Dashboard mahasiswa muncul

┌─────────────────────────────────────────────────────────────────────┐
│ TROUBLESHOOTING                                                     │
└─────────────────────────────────────────────────────────────────────┘

Problem: "Login tidak berhasil"
Solution: 
- Pastikan email & password benar
- Clear cache: php artisan cache:clear
- Clear cookies di browser

Problem: "Access Denied (403)"
Solution:
- Pastikan Anda sudah login
- Pastikan role sesuai dengan dashboard yang diakses
- Reload page

Problem: "View tidak ditemukan"
Solution:
- Refresh browser
- Check file di resources/views/admin/dashboard.blade.php ada
- Run: php artisan view:cache

Problem: "Database error"
Solution:
- Run: php artisan migrate:fresh --seed
- Check .env database credentials

┌─────────────────────────────────────────────────────────────────────┐
│ ✅ SEMUA BERHASIL? LANJUT KE FITUR BERIKUTNYA!                      │
└─────────────────────────────────────────────────────────────────────┘
