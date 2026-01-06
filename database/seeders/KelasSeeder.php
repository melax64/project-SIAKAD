<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas_data = [
            // Informatika Angkatan 2025
            ['nama_kelas' => 'A1', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'A2', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'B1', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'B2', 'prodi' => 'Informatika', 'angkatan' => 2025, 'kapasitas' => 40],

            // Informatika Angkatan 2022
            ['nama_kelas' => 'A1', 'prodi' => 'Informatika', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'A2', 'prodi' => 'Informatika', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'B1', 'prodi' => 'Informatika', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'B2', 'prodi' => 'Informatika', 'angkatan' => 2022, 'kapasitas' => 40],

            // Informatika Angkatan 2023
            ['nama_kelas' => 'A1', 'prodi' => 'Informatika', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'A2', 'prodi' => 'Informatika', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'B1', 'prodi' => 'Informatika', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'B2', 'prodi' => 'Informatika', 'angkatan' => 2023, 'kapasitas' => 40],

            // Informatika Angkatan 2024
            ['nama_kelas' => 'A1', 'prodi' => 'Informatika', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'A2', 'prodi' => 'Informatika', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'B1', 'prodi' => 'Informatika', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'B2', 'prodi' => 'Informatika', 'angkatan' => 2024, 'kapasitas' => 40],

            // Sistem Informasi Angkatan 2025
            ['nama_kelas' => 'A1', 'prodi' => 'Sistem Informasi', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'A2', 'prodi' => 'Sistem Informasi', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'B1', 'prodi' => 'Sistem Informasi', 'angkatan' => 2025, 'kapasitas' => 40],

            // Sistem Informasi Angkatan 2022
            ['nama_kelas' => 'A1', 'prodi' => 'Sistem Informasi', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'A2', 'prodi' => 'Sistem Informasi', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'B1', 'prodi' => 'Sistem Informasi', 'angkatan' => 2022, 'kapasitas' => 40],

            // Sistem Informasi Angkatan 2023
            ['nama_kelas' => 'A1', 'prodi' => 'Sistem Informasi', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'A2', 'prodi' => 'Sistem Informasi', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'B1', 'prodi' => 'Sistem Informasi', 'angkatan' => 2023, 'kapasitas' => 40],

            // Sistem Informasi Angkatan 2024
            ['nama_kelas' => 'A1', 'prodi' => 'Sistem Informasi', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'A2', 'prodi' => 'Sistem Informasi', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'B1', 'prodi' => 'Sistem Informasi', 'angkatan' => 2024, 'kapasitas' => 40],
        ];

        foreach ($kelas_data as $data) {
            Kelas::firstOrCreate(
                [
                    'nama_kelas' => $data['nama_kelas'],
                    'prodi' => $data['prodi'],
                    'angkatan' => $data['angkatan'],
                ],
                [
                    'kapasitas' => $data['kapasitas'],
                ]
            );
        }
    }
}
