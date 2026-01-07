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
        // Manual entry - 3 kelas per prodi
        $kelas_data = [
            // Teknik Informatika
            ['nama_kelas' => 'A', 'prodi' => 'Teknik Informatika', 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknik Informatika', 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknik Informatika', 'kapasitas' => 40],

            // Teknologi Rekayasa Multimedia
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Multimedia', 'kapasitas' => 40],

            // Teknologi Rekayasa Komputer Jaringan
            ['nama_kelas' => 'A', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kapasitas' => 40],
            ['nama_kelas' => 'B', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kapasitas' => 40],
            ['nama_kelas' => 'C', 'prodi' => 'Teknologi Rekayasa Komputer Jaringan', 'kapasitas' => 40],
        ];

        foreach ($kelas_data as $data) {
            Kelas::firstOrCreate(
                [
                    'nama_kelas' => $data['nama_kelas'],
                    'prodi' => $data['prodi'],
                ],
                [
                    'kapasitas' => $data['kapasitas'],
                ]
            );
        }
    }
}
