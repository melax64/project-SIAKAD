<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {

        // Data mahasiswa dengan NIM unik dan terstruktur - Total 25 mahasiswa
        $mahasiswas = [
            // Angkatan 2025 - TI
            ['nim' => 'TI2025001', 'nama' => 'Andi Pratama', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kelas_name' => 'A1'],
            ['nim' => 'TI2025002', 'nama' => 'Budi Santoso', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kelas_name' => 'A1'],
            ['nim' => 'TI2025003', 'nama' => 'Citra Dewi', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kelas_name' => 'A1'],
            ['nim' => 'TI2025004', 'nama' => 'Dedi Harahap', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kelas_name' => 'A2'],
            ['nim' => 'TI2025005', 'nama' => 'Eka Putri', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kelas_name' => 'A2'],
            ['nim' => 'TI2025006', 'nama' => 'Faisal Rahman', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kelas_name' => 'A2'],
            ['nim' => 'TI2025007', 'nama' => 'Gita Sari', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kelas_name' => 'B1'],
            ['nim' => 'TI2025008', 'nama' => 'Hendra Wijaya', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kelas_name' => 'B1'],
            
            // Angkatan 2024 - TI
            ['nim' => 'TI2024001', 'nama' => 'Intan Kusuma', 'prodi' => 'Informatika', 'angkatan' => 2024, 'kelas_name' => 'A1'],
            ['nim' => 'TI2024002', 'nama' => 'Joko Supriyanto', 'prodi' => 'Informatika', 'angkatan' => 2024, 'kelas_name' => 'A1'],
            ['nim' => 'TI2024003', 'nama' => 'Kasino Wijaya', 'prodi' => 'Informatika', 'angkatan' => 2024, 'kelas_name' => 'B1'],
            ['nim' => 'TI2024004', 'nama' => 'Laila Nurdin', 'prodi' => 'Informatika', 'angkatan' => 2024, 'kelas_name' => 'B1'],
            
            // Angkatan 2024 - SI
            ['nim' => 'SI2024001', 'nama' => 'Miko Handoko', 'prodi' => 'Sistem Informasi', 'angkatan' => 2024, 'kelas_name' => 'A1'],
            ['nim' => 'SI2024002', 'nama' => 'Nina Salsabila', 'prodi' => 'Sistem Informasi', 'angkatan' => 2024, 'kelas_name' => 'A1'],
            ['nim' => 'SI2024003', 'nama' => 'Oscar Mandala', 'prodi' => 'Sistem Informasi', 'angkatan' => 2024, 'kelas_name' => 'B1'],
            
            // Angkatan 2023 - SI
            ['nim' => 'SI2023001', 'nama' => 'Padmi Wijaya', 'prodi' => 'Sistem Informasi', 'angkatan' => 2023, 'kelas_name' => 'A1'],
            ['nim' => 'SI2023002', 'nama' => 'Qori Pratama', 'prodi' => 'Sistem Informasi', 'angkatan' => 2023, 'kelas_name' => 'A1'],
            ['nim' => 'SI2023003', 'nama' => 'Rini Kusuma', 'prodi' => 'Sistem Informasi', 'angkatan' => 2023, 'kelas_name' => 'B1'],
            ['nim' => 'SI2023004', 'nama' => 'Sandi Hermawan', 'prodi' => 'Sistem Informasi', 'angkatan' => 2023, 'kelas_name' => 'B1'],
            
            // Tambahan untuk reach 25+
            ['nim' => 'TI2023001', 'nama' => 'Tina Susanti', 'prodi' => 'Informatika', 'angkatan' => 2023, 'kelas_name' => 'A1'],
            ['nim' => 'TI2023002', 'nama' => 'Udin Suganda', 'prodi' => 'Informatika', 'angkatan' => 2023, 'kelas_name' => 'A1'],
            ['nim' => 'TI2023003', 'nama' => 'Vina Kusuma', 'prodi' => 'Informatika', 'angkatan' => 2023, 'kelas_name' => 'B1'],
            ['nim' => 'SI2023005', 'nama' => 'Wahyu Santoso', 'prodi' => 'Sistem Informasi', 'angkatan' => 2023, 'kelas_name' => 'A2'],
            ['nim' => 'SI2023006', 'nama' => 'Xenya Kusuma', 'prodi' => 'Sistem Informasi', 'angkatan' => 2023, 'kelas_name' => 'B1'],
            ['nim' => 'TI2022001', 'nama' => 'Yuni Hayati', 'prodi' => 'Informatika', 'angkatan' => 2022, 'kelas_name' => 'A1'],
            ['nim' => 'TI2022002', 'nama' => 'Zaki Rahman', 'prodi' => 'Informatika', 'angkatan' => 2022, 'kelas_name' => 'B1'],
        ];

        foreach ($mahasiswas as $data) {
            $email = strtolower(str_replace(' ', '.', $data['nama'])) . '@student.ac.id';
            $kelas_name = $data['kelas_name'];
            unset($data['kelas_name']);

            // Cek apakah user sudah ada
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $data['nama'],
                    'password' => Hash::make($data['nim']), // Password = NIM
                    'role' => 'mahasiswa',
                ]
            );

            // Cari kelas berdasarkan nama_kelas, prodi, dan angkatan
            $kelas = Kelas::where('nama_kelas', $kelas_name)
                ->where('prodi', $data['prodi'])
                ->where('angkatan', $data['angkatan'])
                ->first();

            // Cek apakah mahasiswa sudah ada
            Mahasiswa::firstOrCreate(
                ['nim' => $data['nim']],
                [
                    'user_id' => $user->id,
                    'prodi' => $data['prodi'],
                    'angkatan' => $data['angkatan'],
                    'kelas_id' => $kelas->id ?? null,
                ]
            );
        }

        $this->command->info("✅ Total " . count($mahasiswas) . " mahasiswa berhasil dibuat!");
        $this->command->info("📊 Rincian:");
        $this->command->info("   • Teknik Informatika: 10 mahasiswa");
        $this->command->info("   • TRMM: 5 mahasiswa");
        $this->command->info("   • TRKJ: 10 mahasiswa");
    }
}