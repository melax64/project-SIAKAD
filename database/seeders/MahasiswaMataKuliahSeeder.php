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
        $minSKS = 16;

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

            // Ambil mata kuliah dari database dan hitung total SKS
            $totalSKS = 0;
            $enrolledMataKuliah = [];

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
                    $totalSKS += $mataKuliah->sks;
                    $enrolledMataKuliah[] = $mataKuliah->id;
                }
            }

            // Jika total SKS kurang dari 16, tambahkan mata kuliah lain
            if ($totalSKS < $minSKS) {
                // Ambil mata kuliah lain yang belum diambil
                $additionalMataKuliah = MataKuliah::whereNotIn('id', $enrolledMataKuliah)
                    ->orderBy('nama_matakuliah')
                    ->get();

                foreach ($additionalMataKuliah as $mk) {
                    if ($totalSKS >= $minSKS) {
                        break; // Sudah mencapai minimal 16 SKS
                    }

                    MahasiswaMataKuliah::firstOrCreate(
                        [
                            'mahasiswa_id' => $mhs->id,
                            'mata_kuliah_id' => $mk->id,
                            'semester' => $semester,
                        ],
                        [
                            'status' => 'aktif',
                        ]
                    );
                    $totalSKS += $mk->sks;
                    $enrolledMataKuliah[] = $mk->id;
                }
            }
        }

        $this->command->info("✅ KRS mahasiswa berhasil dibuat!");
        $this->command->info("📚 Setiap mahasiswa sudah terdaftar di mata kuliah sesuai prodi");
        $this->command->info("🎓 Mahasiswa Teknik Informatika wajib mengambil Advanced Database");
        $this->command->info("📊 Minimal 16 SKS per mahasiswa terpenuhi");
    }
}
