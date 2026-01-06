<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\MahasiswaMataKuliah;

class MahasiswaMataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua mahasiswa
        $mahasiswas = Mahasiswa::all();

        // Semester saat ini
        $semester = '2025/2026 Genap';

        foreach ($mahasiswas as $mhs) {
            // Mata kuliah berdasarkan prodi
            $mataKuliahNames = [];

            if ($mhs->prodi === 'Teknik Informatika') {
                $mataKuliahNames = [
                    'Advanced Database', // Wajib untuk TI
                    'Pemrograman Web Lanjut',
                    'Struktur Data',
                    'Algoritma dan Pemrograman',
                ];
            } elseif ($mhs->prodi === 'Teknologi Rekayasa Multimedia') {
                $mataKuliahNames = [
                    'Desain Grafis',
                    'Animasi 2D',
                    'Video Editing',
                    'Pemrograman Web Lanjut',
                ];
            } elseif ($mhs->prodi === 'Teknologi Rekayasa Komputer Jaringan') {
                $mataKuliahNames = [
                    'Jaringan Komputer',
                    'Administrasi Server',
                    'Keamanan Jaringan',
                    'Pemrograman Web Lanjut',
                ];
            }

            // Ambil mata kuliah dari database dan insert ke KRS
            foreach ($mataKuliahNames as $mkName) {
                $mataKuliah = MataKuliah::where('nama_matakuliah', $mkName)->first();

                if ($mataKuliah) {
                    MahasiswaMataKuliah::firstOrCreate(
                        [
                            'mahasiswa_id' => $mhs->id,
                            'mata_kuliah_id' => $mataKuliah->id,
                            'semester' => $semester,
                        ],
                        [
                            'status' => 'aktif',
                        ]
                    );
                }
            }
        }

        $this->command->info("✅ KRS mahasiswa berhasil dibuat!");
        $this->command->info("📚 Setiap mahasiswa sudah terdaftar di mata kuliah sesuai prodi");
        $this->command->info("🎓 Mahasiswa Teknik Informatika wajib mengambil Advanced Database");
    }
}
