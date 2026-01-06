<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataKuliahs = [
            [
                'kode_matakuliah' => 'PW101',
                'nama_matakuliah' => 'Pemrograman Web',
                'sks' => 3,
                'deskripsi' => 'Pembelajaran dasar pemrograman web menggunakan HTML, CSS, dan JavaScript',
            ],
            [
                'kode_matakuliah' => 'DB101',
                'nama_matakuliah' => 'Database Design',
                'sks' => 3,
                'deskripsi' => 'Desain dan implementasi database relasional',
            ],
            [
                'kode_matakuliah' => 'OS101',
                'nama_matakuliah' => 'Operating System',
                'sks' => 3,
                'deskripsi' => 'Konsep dan manajemen sistem operasi',
            ],
            [
                'kode_matakuliah' => 'ALG101',
                'nama_matakuliah' => 'Algoritma & Struktur Data',
                'sks' => 4,
                'deskripsi' => 'Pembelajaran algoritma dan struktur data dasar',
            ],
            [
                'kode_matakuliah' => 'NET101',
                'nama_matakuliah' => 'Jaringan Komputer',
                'sks' => 3,
                'deskripsi' => 'Konsep dasar jaringan komputer dan protokol komunikasi',
            ],
        ];

        foreach ($mataKuliahs as $mk) {
            MataKuliah::firstOrCreate(
                ['kode_matakuliah' => $mk['kode_matakuliah']],
                $mk
            );
        }
    }
}
