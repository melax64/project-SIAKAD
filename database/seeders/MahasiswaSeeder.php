<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Konfigurasi
        $prodis = [
            ['nama' => 'Teknik Informatika', 'kode' => 'TI'],
            ['nama' => 'Teknologi Rekayasa Multimedia', 'kode' => 'TRMM'],
            ['nama' => 'Teknologi Rekayasa Komputer Jaringan', 'kode' => 'TRKJ'],
        ];

        $angkatans = [2025, 2024, 2023, 2022];
        $kelas = ['A', 'B', 'C'];
        $mahasiswaPerKelas = 10;

        $counterGlobal = 1; // Counter untuk mahasiswa

        foreach ($prodis as $prodi) {
            foreach ($angkatans as $angkatan) {
                foreach ($kelas as $kelasChar) {
                    // Generate 10 mahasiswa untuk kelas ini
                    for ($i = 1; $i <= $mahasiswaPerKelas; $i++) {
                        // Buat NIM: [KODE_PRODI][ANGKATAN][KELAS][NO_URUT]
                        // Contoh: TI202401 (TI 2024 Kelas A No.1)
                        $nim = sprintf('%s%d%s%02d', $prodi['kode'], $angkatan, $kelasChar, $i);

                        // Buat nama dengan format yang terstruktur
                        $nama = $faker->firstName() . ' ' . $faker->lastName();

                        // Email berdasarkan NIM
                        $email = strtolower(str_replace(' ', '.', $nama)) . '@student.ac.id';

                        // Kelas format: TI-2024-A
                        $kelasNama = sprintf('%s-%d-%s', $prodi['kode'], $angkatan, $kelasChar);

                        // Cek apakah user sudah ada
                        $user = User::firstOrCreate(
                            ['email' => $email],
                            [
                                'name' => $nama,
                                'password' => Hash::make($nim), // Password = NIM
                                'role' => 'mahasiswa',
                            ]
                        );

                        // Cek apakah mahasiswa sudah ada
                        Mahasiswa::firstOrCreate(
                            ['nim' => $nim],
                            [
                                'user_id' => $user->id,
                                'prodi' => $prodi['nama'],
                                'angkatan' => $angkatan,
                                'kelas' => $kelasNama,
                            ]
                        );

                        $counterGlobal++;
                    }
                }
            }
        }

        $this->command->info("✅ Total " . ($counterGlobal - 1) . " mahasiswa berhasil dibuat!");
        $this->command->info("📊 Rincian:");
        $this->command->info("   • 3 Prodi: TI, TRMM, TRKJ");
        $this->command->info("   • 4 Angkatan: 2025, 2024, 2023, 2022");
        $this->command->info("   • 3 Kelas per Angkatan: A, B, C");
        $this->command->info("   • 10 Mahasiswa per Kelas");
        $this->command->info("   • Total: 3 × 4 × 3 × 10 = 360 Mahasiswa");
    }
}