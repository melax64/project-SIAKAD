# TEST LOGIN ADMIN - SIAKAD

## 📋 Data Login Admin:

Email: admin@siakad.com
Password: 123456
Role: admin

## 🔗 URL Login:
http://localhost:8000/login/admin

## 🎯 Expected Flow:
1. Masukkan email & password
2. Klik Login
3. Akan redirect ke: http://localhost:8000/admin/dashboard
4. Tampil halaman dashboard dengan:
   - Sidebar menu (Dashboard, Data Mahasiswa, Data Dosen)
   - Main content dengan heading "Dashboard Admin"
   - 2 card button: "Tambah Mahasiswa" dan "Tambah Dosen"

## 📱 Login Routes:
- Admin: /login/admin
- Dosen: /login/dosen
- Mahasiswa: /login/mahasiswa

## 🔐 Credentials:
- Admin: admin@siakad.com / 123456
- Dosen: dosen1@siakad.com / 123456
- Mahasiswa: (bisa dibuat via admin dashboard)

## ✅ Status:
- Route admin.dashboard: ✓
- Middleware role:admin: ✓
- View admin.dashboard: ✓
- Layout admin: ✓
- AdminSeeder: ✓
- Database: ✓ (sudah di-migrate fresh --seed)
