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
        // Manual entry mahasiswa - 3 kelas per prodi
        $mahasiswas = [
            // Teknik Informatika - Kelas A
            ['nim' => '110001', 'nama' => 'Andi Pratama', 'prodi' => 'Teknik Informatika', 'kelas' => 'A'],
            ['nim' => '110002', 'nama' => 'Budi Santoso', 'prodi' => 'Teknik Informatika', 'kelas' => 'A'],
            ['nim' => '110003', 'nama' => 'Citra Dewi', 'prodi' => 'Teknik Informatika', 'kelas' => 'A'],
            ['nim' => '110004', 'nama' => 'Dedi Harahap', 'prodi' => 'Teknik Informatika', 'kelas' => 'A'],
            
            // Teknik Informatika - Kelas B
            ['nim' => '110005', 'nama' => 'Eka Putri', 'prodi' => 'Teknik Informatika', 'kelas' => 'B'],
            ['nim' => '110006', 'nama' => 'Faisal Rahman', 'prodi' => 'Teknik Informatika', 'kelas' => 'B'],
            ['nim' => '110007', 'nama' => 'Gita Sari', 'prodi' => 'Teknik Informatika', 'kelas' => 'B'],
            ['nim' => '110008', 'nama' => 'Hendra Wijaya', 'prodi' => 'Teknik Informatika', 'kelas' => 'B'],
            
            // Teknik Informatika - Kelas C
            ['nim' => '110009', 'nama' => 'Intan Kusuma', 'prodi' => 'Teknik Informatika', 'kelas' => 'C'],
            ['nim' => '110010', 'nama' => 'Joko Supriyanto', 'prodi' => 'Teknik Informatika', 'kelas' => 'C'],
            ['nim' => '110011', 'nama' => 'Kasino Nurdin', 'prodi' => 'Teknik Informatika', 'kelas' => 'C'],
            ['nim' => '110012', 'nama' => 'Laila Handoko', 'prodi' => 'Teknik Informatika', 'kelas' => 'C'],
            
            // Teknologi Rekayasa Multimedia - Kelas A
            ['nim' => '120001', 'nama' => 'Miko Salsabila', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'A'],
            ['nim' => '120002', 'nama' => 'Nina Mandala', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'A'],
            ['nim' => '120003', 'nama' => 'Oscar Hermawan', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'A'],
            ['nim' => '120004', 'nama' => 'Padmi Susanti', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'A'],
            
            // Teknologi Rekayasa Multimedia - Kelas B
            ['nim' => '120005', 'nama' => 'Qori Suganda', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'B'],
            ['nim' => '120006', 'nama' => 'Rini Hayati', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'B'],
            ['nim' => '120007', 'nama' => 'Sandi Abdullah', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'B'],
            ['nim' => '120008', 'nama' => 'Tina Saputra', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'B'],
            
            // Teknologi Rekayasa Multimedia - Kelas C
            ['nim' => '120009', 'nama' => 'Udin Permana', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'C'],
            ['nim' => '120010', 'nama' => 'Vina Wulandari', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'C'],
            ['nim' => '120011', 'nama' => 'Wahyu Setiawan', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'C'],
            ['nim' => '120012', 'nama' => 'Xenya Lestari', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kelas' => 'C'],
            
            // Teknologi Rekayasa Komputer Jaringan - Kelas A
            ['nim' => '130001', 'nama' => 'Yuni Hidayat', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'A'],
            ['nim' => '130002', 'nama' => 'Zaki Anggraeni', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'A'],
            ['nim' => '130003', 'nama' => 'Ahmad Firmansyah', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'A'],
            ['nim' => '130004', 'nama' => 'Bella Maharani', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'A'],
            
            // Teknologi Rekayasa Komputer Jaringan - Kelas B
            ['nim' => '130005', 'nama' => 'Candra Ramadhan', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'B'],
            ['nim' => '130006', 'nama' => 'Dian Nurhaliza', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'B'],
            ['nim' => '130007', 'nama' => 'Evan Pratama', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'B'],
            ['nim' => '130008', 'nama' => 'Fitri Santoso', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'B'],
            
            // Teknologi Rekayasa Komputer Jaringan - Kelas C
            ['nim' => '130009', 'nama' => 'Gilang Dewi', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'C'],
            ['nim' => '130010', 'nama' => 'Hani Harahap', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'C'],
            ['nim' => '130011', 'nama' => 'Irfan Putri', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'C'],
            ['nim' => '130012', 'nama' => 'Julia Rahman', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kelas' => 'C'],
        ];

        foreach ($mahasiswas as $data) {
            // Email format: nama.lengkap@student.ac.id
            $emailName = strtolower(str_replace(' ', '.', $data['nama']));
            $email = $emailName . '@student.ac.id';

            // Buat user
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $data['nama'],
                    'password' => Hash::make($data['nim']), // Password = NIM
                    'role' => 'mahasiswa',
                ]
            );

            // Cari kelas berdasarkan nama_kelas dan prodi (tanpa angkatan)
            $kelas = Kelas::where('nama_kelas', $data['kelas'])
                ->where('prodi', $data['prodi'])
                ->first();

            // Buat mahasiswa
            Mahasiswa::firstOrCreate(
                ['nim' => $data['nim']],
                [
                    'user_id' => $user->id,
                    'prodi' => $data['prodi'],
                    'kelas_id' => $kelas->id ?? null,
                ]
            );
        }

        // Mahasiswa khusus: maila (untuk testing - KRS kosong)
        $mailaEmail = 'maila@student.ac.id';
        $mailaUser = User::firstOrCreate(
            ['email' => $mailaEmail],
            [
                'name' => 'maila',
                'password' => Hash::make('202020'),
                'role' => 'mahasiswa',
            ]
        );

        $mailaKelas = Kelas::where('nama_kelas', 'C')
            ->where('prodi', 'Teknik Informatika')
            ->first();

        Mahasiswa::firstOrCreate(
            ['nim' => '202020'],
            [
                'user_id' => $mailaUser->id,
                'prodi' => 'Teknik Informatika',
                'kelas_id' => $mailaKelas->id ?? null,
            ]
        );

        $this->command->info("✅ Total " . (count($mahasiswas) + 1) . " mahasiswa berhasil dibuat!");
        $this->command->info("👤 Mahasiswa khusus: maila (NIM: 202020, TI C) - KRS kosong");
        
        // Hitung per prodi
        $tiCount = count(array_filter($mahasiswas, fn($m) => $m['prodi'] === 'Teknik Informatika'));
        $trmmCount = count(array_filter($mahasiswas, fn($m) => $m['prodi'] === 'Teknologi Rekayasa Multimedia'));
        $trkjCount = count(array_filter($mahasiswas, fn($m) => $m['prodi'] === 'Teknologi Rekayasa Komputer Jaringan'));
        
        $this->command->info("📊 Rincian:");
        $this->command->info("   • Teknik Informatika: {$tiCount} mahasiswa (3 kelas)");
        $this->command->info("   • Teknologi Rekayasa Multimedia: {$trmmCount} mahasiswa (3 kelas)");
        $this->command->info("   • Teknologi Rekayasa Komputer Jaringan: {$trkjCount} mahasiswa (3 kelas)");
    }
}