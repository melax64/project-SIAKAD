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
        // Generate 300 mahasiswa
        $mahasiswas = [];
        
        // Daftar nama untuk randomisasi
        $namaDepan = ['Andi', 'Budi', 'Citra', 'Dedi', 'Eka', 'Faisal', 'Gita', 'Hendra', 'Intan', 'Joko', 
                      'Kasino', 'Laila', 'Miko', 'Nina', 'Oscar', 'Padmi', 'Qori', 'Rini', 'Sandi', 'Tina',
                      'Udin', 'Vina', 'Wahyu', 'Xenya', 'Yuni', 'Zaki', 'Ahmad', 'Bella', 'Candra', 'Dian',
                      'Evan', 'Fitri', 'Gilang', 'Hani', 'Irfan', 'Julia', 'Kevin', 'Luna', 'Maya', 'Nanda'];
        
        $namaBelakang = ['Pratama', 'Santoso', 'Dewi', 'Harahap', 'Putri', 'Rahman', 'Sari', 'Wijaya', 'Kusuma', 'Supriyanto',
                         'Nurdin', 'Handoko', 'Salsabila', 'Mandala', 'Hermawan', 'Susanti', 'Suganda', 'Hayati', 'Abdullah', 'Saputra',
                         'Permana', 'Wulandari', 'Setiawan', 'Lestari', 'Hidayat', 'Anggraeni', 'Firmansyah', 'Maharani', 'Ramadhan', 'Nurhaliza'];
        
        $prodiList = [
            'Teknik Informatika' => 'TI',
            'Teknologi Rekayasa Multimedia' => 'TRMM',
            'Teknologi Rekayasa Komputer Jaringan' => 'TRKJ',
        ];
        
        $angkatanList = [2022, 2023, 2024, 2025];
        $kelasList = ['A', 'B', 'C'];
        
        $counter = 1;
        foreach ($angkatanList as $angkatan) {
            foreach ($prodiList as $prodiName => $prodiCode) {
                // Tentukan jumlah mahasiswa per prodi per angkatan (sekitar 25)
                $jumlahPerProdiAngkatan = 25;
                
                for ($i = 1; $i <= $jumlahPerProdiAngkatan; $i++) {
                    if ($counter > 300) break 3; // Stop jika sudah 300
                    
                    $nim = sprintf('%s%d%03d', $prodiCode, $angkatan, $i);
                    $nama = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBelakang[array_rand($namaBelakang)];
                    $kelas = $kelasList[($i - 1) % count($kelasList)]; // Distribusi merata A, B, C
                    
                    $mahasiswas[] = [
                        'nim' => $nim,
                        'nama' => $nama,
                        'prodi' => $prodiName,
                        'angkatan' => $angkatan,
                        'kelas_name' => $kelas
                    ];
                    
                    $counter++;
                }
            }
        }

        foreach ($mahasiswas as $data) {
            $email = strtolower(str_replace(' ', '.', $data['nama'])) . $data['nim'] . '@student.ac.id';
            $kelas_name = $data['kelas_name'];
            unset($data['kelas_name']);

            // Cek apakah user sudah ada
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $data['nama'],
                    'password' => Hash::make($data['nim']), // Password = NIM
                    'role' => 'mahasiswa',
                ]
            );

            // Cari kelas berdasarkan nama_kelas, prodi, dan angkatan
            $kelas = Kelas::where('nama_kelas', $kelas_name)
                ->where('prodi', $data['prodi'])
                ->where('angkatan', $data['angkatan'])
                ->first();

            // Cek apakah mahasiswa sudah ada
            Mahasiswa::firstOrCreate(
                ['nim' => $data['nim']],
                [
                    'user_id' => $user->id,
                    'prodi' => $data['prodi'],
                    'angkatan' => $data['angkatan'],
                    'kelas_id' => $kelas->id ?? null,
                ]
            );
        }

        $this->command->info("✅ Total " . count($mahasiswas) . " mahasiswa berhasil dibuat!");
        
        // Hitung per prodi
        $tiCount = count(array_filter($mahasiswas, fn($m) => $m['prodi'] === 'Teknik Informatika'));
        $trmmCount = count(array_filter($mahasiswas, fn($m) => $m['prodi'] === 'Teknologi Rekayasa Multimedia'));
        $trkjCount = count(array_filter($mahasiswas, fn($m) => $m['prodi'] === 'Teknologi Rekayasa Komputer Jaringan'));
        
        $this->command->info("📊 Rincian:");
        $this->command->info("   • Teknik Informatika: {$tiCount} mahasiswa");
        $this->command->info("   • Teknologi Rekayasa Multimedia: {$trmmCount} mahasiswa");
        $this->command->info("   • Teknologi Rekayasa Komputer Jaringan: {$trkjCount} mahasiswa");
    }
}