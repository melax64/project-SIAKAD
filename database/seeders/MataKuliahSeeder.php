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
                'kode_matakuliah' => 'PW102',
                'nama_matakuliah' => 'Web Framework Advanced',
                'sks' => 3,
                'deskripsi' => 'Pembelajaran framework web seperti Laravel, React, dan Vue.js',
            ],
            [
                'kode_matakuliah' => 'DB101',
                'nama_matakuliah' => 'Database Design',
                'sks' => 3,
                'deskripsi' => 'Desain dan implementasi database relasional',
            ],
            [
                'kode_matakuliah' => 'DB102',
                'nama_matakuliah' => 'Advanced Database',
                'sks' => 3,
                'deskripsi' => 'Database optimization dan NoSQL',
            ],
            [
                'kode_matakuliah' => 'OS101',
                'nama_matakuliah' => 'Operating System',
                'sks' => 3,
                'deskripsi' => 'Konsep dan manajemen sistem operasi',
            ],
            [
                'kode_matakuliah' => 'OS102',
                'nama_matakuliah' => 'Linux Administration',
                'sks' => 3,
                'deskripsi' => 'Administrasi dan konfigurasi Linux',
            ],
            [
                'kode_matakuliah' => 'ALG101',
                'nama_matakuliah' => 'Algoritma & Struktur Data',
                'sks' => 4,
                'deskripsi' => 'Pembelajaran algoritma dan struktur data dasar',
            ],
            [
                'kode_matakuliah' => 'ALG102',
                'nama_matakuliah' => 'Advanced Algorithm',
                'sks' => 3,
                'deskripsi' => 'Algoritma lanjutan dan kompleksitas komputasi',
            ],
            [
                'kode_matakuliah' => 'NET101',
                'nama_matakuliah' => 'Jaringan Komputer',
                'sks' => 3,
                'deskripsi' => 'Konsep dasar jaringan komputer dan protokol komunikasi',
            ],
            [
                'kode_matakuliah' => 'NET102',
                'nama_matakuliah' => 'Network Security',
                'sks' => 3,
                'deskripsi' => 'Keamanan jaringan dan enkripsi data',
            ],
            [
                'kode_matakuliah' => 'UI101',
                'nama_matakuliah' => 'User Interface Design',
                'sks' => 3,
                'deskripsi' => 'Desain interface dan user experience',
            ],
            [
                'kode_matakuliah' => 'SE101',
                'nama_matakuliah' => 'Software Engineering',
                'sks' => 3,
                'deskripsi' => 'Metodologi pengembangan software dan project management',
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
