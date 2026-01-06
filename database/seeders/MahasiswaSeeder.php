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

        // Data mahasiswa dengan NIM unik dan terstruktur - Total 26 mahasiswa
        $mahasiswas = [
            // Angkatan 2025 - Teknik Informatika
            ['nim' => 'TI2025001', 'nama' => 'Andi Pratama', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kelas_name' => 'A'],
            ['nim' => 'TI2025002', 'nama' => 'Budi Santoso', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kelas_name' => 'A'],
            ['nim' => 'TI2025003', 'nama' => 'Citra Dewi', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kelas_name' => 'A'],
            ['nim' => 'TI2025004', 'nama' => 'Dedi Harahap', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kelas_name' => 'B'],
            ['nim' => 'TI2025005', 'nama' => 'Eka Putri', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kelas_name' => 'B'],
            ['nim' => 'TI2025006', 'nama' => 'Faisal Rahman', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kelas_name' => 'B'],
            ['nim' => 'TI2025007', 'nama' => 'Gita Sari', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kelas_name' => 'C'],
            ['nim' => 'TI2025008', 'nama' => 'Hendra Wijaya', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kelas_name' => 'C'],
            
            // Angkatan 2024 - Teknik Informatika
            ['nim' => 'TI2024001', 'nama' => 'Intan Kusuma', 'prodi' => 'Teknik Informatika', 'angkatan' => 2024, 'kelas_name' => 'A'],
            ['nim' => 'TI2024002', 'nama' => 'Joko Supriyanto', 'prodi' => 'Teknik Informatika', 'angkatan' => 2024, 'kelas_name' => 'A'],
            ['nim' => 'TI2024003', 'nama' => 'Kasino Wijaya', 'prodi' => 'Teknik Informatika', 'angkatan' => 2024, 'kelas_name' => 'B'],
            ['nim' => 'TI2024004', 'nama' => 'Laila Nurdin', 'prodi' => 'Teknik Informatika', 'angkatan' => 2024, 'kelas_name' => 'B'],
            
            // Angkatan 2024 - Teknologi Rekayasa Multimedia
            ['nim' => 'TRMM2024001', 'nama' => 'Miko Handoko', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2024, 'kelas_name' => 'A'],
            ['nim' => 'TRMM2024002', 'nama' => 'Nina Salsabila', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2024, 'kelas_name' => 'A'],
            ['nim' => 'TRMM2024003', 'nama' => 'Oscar Mandala', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2024, 'kelas_name' => 'B'],
            
            // Angkatan 2023 - Teknologi Rekayasa Komputer Jaringan
            ['nim' => 'TRKJ2023001', 'nama' => 'Padmi Wijaya', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2023, 'kelas_name' => 'A'],
            ['nim' => 'TRKJ2023002', 'nama' => 'Qori Pratama', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2023, 'kelas_name' => 'A'],
            ['nim' => 'TRKJ2023003', 'nama' => 'Rini Kusuma', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2023, 'kelas_name' => 'B'],
            ['nim' => 'TRKJ2023004', 'nama' => 'Sandi Hermawan', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2023, 'kelas_name' => 'B'],
            
            // Tambahan untuk reach 26
            ['nim' => 'TI2023001', 'nama' => 'Tina Susanti', 'prodi' => 'Teknik Informatika', 'angkatan' => 2023, 'kelas_name' => 'A'],
            ['nim' => 'TI2023002', 'nama' => 'Udin Suganda', 'prodi' => 'Teknik Informatika', 'angkatan' => 2023, 'kelas_name' => 'A'],
            ['nim' => 'TI2023003', 'nama' => 'Vina Kusuma', 'prodi' => 'Teknik Informatika', 'angkatan' => 2023, 'kelas_name' => 'B'],
            ['nim' => 'TRKJ2023005', 'nama' => 'Wahyu Santoso', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2023, 'kelas_name' => 'A'],
            ['nim' => 'TRKJ2023006', 'nama' => 'Xenya Kusuma', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2023, 'kelas_name' => 'B'],
            ['nim' => 'TI2022001', 'nama' => 'Yuni Hayati', 'prodi' => 'Teknik Informatika', 'angkatan' => 2022, 'kelas_name' => 'A'],
            ['nim' => 'TI2022002', 'nama' => 'Zaki Rahman', 'prodi' => 'Teknik Informatika', 'angkatan' => 2022, 'kelas_name' => 'B'],
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
        $this->command->info("   • Teknik Informatika: 13 mahasiswa");
        $this->command->info("   • Teknologi Rekayasa Multimedia: 3 mahasiswa");
        $this->command->info("   • Teknologi Rekayasa Komputer Jaringan: 10 mahasiswa");
    }
}