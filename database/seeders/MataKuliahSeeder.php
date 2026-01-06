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
            // ========== MATA KULIAH UMUM (Semua Prodi) ==========
            [
                'kode_matakuliah' => 'UMUM101',
                'nama_matakuliah' => 'Bahasa Indonesia',
                'sks' => 2,
                'deskripsi' => 'Pembelajaran bahasa Indonesia yang baik dan benar',
            ],
            [
                'kode_matakuliah' => 'UMUM102',
                'nama_matakuliah' => 'Bahasa Inggris',
                'sks' => 2,
                'deskripsi' => 'Pembelajaran bahasa Inggris dasar dan komunikasi',
            ],
            [
                'kode_matakuliah' => 'UMUM103',
                'nama_matakuliah' => 'Pendidikan Kewarganegaraan',
                'sks' => 2,
                'deskripsi' => 'Pembelajaran nilai-nilai pancasila dan kewarganegaraan',
            ],
            [
                'kode_matakuliah' => 'UMUM104',
                'nama_matakuliah' => 'Matematika Dasar',
                'sks' => 3,
                'deskripsi' => 'Pembelajaran matematika dasar untuk teknologi',
            ],
            [
                'kode_matakuliah' => 'UMUM105',
                'nama_matakuliah' => 'Kewirausahaan',
                'sks' => 2,
                'deskripsi' => 'Pembelajaran dasar kewirausahaan dan bisnis',
            ],

            // ========== TEKNIK INFORMATIKA (Programming & Web Development) ==========
            [
                'kode_matakuliah' => 'TI101',
                'nama_matakuliah' => 'Pemrograman Dasar',
                'sks' => 3,
                'deskripsi' => 'Pembelajaran dasar programming menggunakan Python',
            ],
            [
                'kode_matakuliah' => 'TI102',
                'nama_matakuliah' => 'Pemrograman Web Lanjut',
                'sks' => 3,
                'deskripsi' => 'Pembelajaran web development dengan Laravel dan React',
            ],
            [
                'kode_matakuliah' => 'TI103',
                'nama_matakuliah' => 'Advanced Database',
                'sks' => 3,
                'deskripsi' => 'Database optimization, NoSQL, dan Big Data',
            ],
            [
                'kode_matakuliah' => 'TI104',
                'nama_matakuliah' => 'Struktur Data',
                'sks' => 3,
                'deskripsi' => 'Pembelajaran struktur data dan algoritma dasar',
            ],
            [
                'kode_matakuliah' => 'TI105',
                'nama_matakuliah' => 'Algoritma dan Pemrograman',
                'sks' => 4,
                'deskripsi' => 'Algoritma kompleks dan problem solving',
            ],
            [
                'kode_matakuliah' => 'TI106',
                'nama_matakuliah' => 'Mobile Application Development',
                'sks' => 3,
                'deskripsi' => 'Pengembangan aplikasi mobile Android dan iOS',
            ],
            [
                'kode_matakuliah' => 'TI107',
                'nama_matakuliah' => 'Software Engineering',
                'sks' => 3,
                'deskripsi' => 'Metodologi pengembangan software dan project management',
            ],

            // ========== TEKNOLOGI REKAYASA MULTIMEDIA (Design & Multimedia) ==========
            [
                'kode_matakuliah' => 'MM101',
                'nama_matakuliah' => 'Desain Grafis',
                'sks' => 3,
                'deskripsi' => 'Pembelajaran desain grafis menggunakan Adobe Photoshop dan Illustrator',
            ],
            [
                'kode_matakuliah' => 'MM102',
                'nama_matakuliah' => 'Animasi 2D',
                'sks' => 3,
                'deskripsi' => 'Teknik animasi 2D menggunakan Adobe Animate',
            ],
            [
                'kode_matakuliah' => 'MM103',
                'nama_matakuliah' => 'Video Editing',
                'sks' => 3,
                'deskripsi' => 'Editing video menggunakan Adobe Premiere dan After Effects',
            ],
            [
                'kode_matakuliah' => 'MM104',
                'nama_matakuliah' => 'Animasi 3D',
                'sks' => 3,
                'deskripsi' => 'Modeling dan animasi 3D menggunakan Blender',
            ],
            [
                'kode_matakuliah' => 'MM105',
                'nama_matakuliah' => 'UI/UX Design',
                'sks' => 3,
                'deskripsi' => 'Desain user interface dan user experience',
            ],
            [
                'kode_matakuliah' => 'MM106',
                'nama_matakuliah' => 'Digital Illustration',
                'sks' => 3,
                'deskripsi' => 'Ilustrasi digital dan character design',
            ],
            [
                'kode_matakuliah' => 'MM107',
                'nama_matakuliah' => 'Motion Graphics',
                'sks' => 3,
                'deskripsi' => 'Desain motion graphics untuk video dan multimedia',
            ],

            // ========== TEKNOLOGI REKAYASA KOMPUTER JARINGAN (Networking & Security) ==========
            [
                'kode_matakuliah' => 'KJ101',
                'nama_matakuliah' => 'Jaringan Komputer',
                'sks' => 3,
                'deskripsi' => 'Konsep dasar jaringan komputer dan protokol TCP/IP',
            ],
            [
                'kode_matakuliah' => 'KJ102',
                'nama_matakuliah' => 'Administrasi Server',
                'sks' => 3,
                'deskripsi' => 'Administrasi server Linux dan Windows',
            ],
            [
                'kode_matakuliah' => 'KJ103',
                'nama_matakuliah' => 'Keamanan Jaringan',
                'sks' => 3,
                'deskripsi' => 'Keamanan jaringan, firewall, dan enkripsi',
            ],
            [
                'kode_matakuliah' => 'KJ104',
                'nama_matakuliah' => 'Cisco Networking',
                'sks' => 3,
                'deskripsi' => 'Konfigurasi router dan switch Cisco',
            ],
            [
                'kode_matakuliah' => 'KJ105',
                'nama_matakuliah' => 'Cloud Computing',
                'sks' => 3,
                'deskripsi' => 'Teknologi cloud computing dan virtualisasi',
            ],
            [
                'kode_matakuliah' => 'KJ106',
                'nama_matakuliah' => 'Network Security & Penetration Testing',
                'sks' => 3,
                'deskripsi' => 'Ethical hacking dan penetration testing',
            ],
            [
                'kode_matakuliah' => 'KJ107',
                'nama_matakuliah' => 'Wireless Network',
                'sks' => 3,
                'deskripsi' => 'Jaringan wireless dan konfigurasi access point',
            ],
        ];

        foreach ($mataKuliahs as $mk) {
            MataKuliah::firstOrCreate(
                ['kode_matakuliah' => $mk['kode_matakuliah']],
                $mk
            );
        }

        $this->command->info("✅ Mata kuliah berhasil dibuat!");
        $this->command->info("📚 Total: " . count($mataKuliahs) . " mata kuliah");
        $this->command->info("   • Mata Kuliah Umum: 5");
        $this->command->info("   • Teknik Informatika: 7");
        $this->command->info("   • Teknologi Rekayasa Multimedia: 7");
        $this->command->info("   • Teknologi Rekayasa Komputer Jaringan: 7");
    }
}
