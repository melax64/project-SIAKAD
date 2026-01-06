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
            // Teknik Informatika Angkatan 2025
            ['nama_kelas' => 'A', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'D', 'prodi' => 'Teknik Informatika', 'angkatan' => 2025, 'kapasitas' => 40],

            // Teknik Informatika Angkatan 2022
            ['nama_kelas' => 'A', 'prodi' => 'Teknik Informatika', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknik Informatika', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknik Informatika', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'D', 'prodi' => 'Teknik Informatika', 'angkatan' => 2022, 'kapasitas' => 40],

            // Teknik Informatika Angkatan 2023
            ['nama_kelas' => 'A', 'prodi' => 'Teknik Informatika', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknik Informatika', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknik Informatika', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'D', 'prodi' => 'Teknik Informatika', 'angkatan' => 2023, 'kapasitas' => 40],

            // Teknik Informatika Angkatan 2024
            ['nama_kelas' => 'A', 'prodi' => 'Teknik Informatika', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknik Informatika', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknik Informatika', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'D', 'prodi' => 'Teknik Informatika', 'angkatan' => 2024, 'kapasitas' => 40],

            // Teknologi Rekayasa Multimedia Angkatan 2025
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2025, 'kapasitas' => 40],

            // Teknologi Rekayasa Multimedia Angkatan 2022
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2022, 'kapasitas' => 40],

            // Teknologi Rekayasa Multimedia Angkatan 2023
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2023, 'kapasitas' => 40],

            // Teknologi Rekayasa Multimedia Angkatan 2024
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Multimedia', 'angkatan' => 2024, 'kapasitas' => 40],

            // Teknologi Rekayasa Komputer Jaringan Angkatan 2025
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2025, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2025, 'kapasitas' => 40],

            // Teknologi Rekayasa Komputer Jaringan Angkatan 2022
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2022, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2022, 'kapasitas' => 40],

            // Teknologi Rekayasa Komputer Jaringan Angkatan 2023
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2023, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2023, 'kapasitas' => 40],

            // Teknologi Rekayasa Komputer Jaringan Angkatan 2024
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2024, 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'angkatan' => 2024, 'kapasitas' => 40],
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
