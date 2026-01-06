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
        // Generate 100 mahasiswa
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
            'Teknik Informatika' => 11, // Kode prodi: 11
            'Teknologi Rekayasa Multimedia' => 12, // Kode prodi: 12
            'Teknologi Rekayasa Komputer Jaringan' => 13, // Kode prodi: 13
        ];
        
        $angkatanList = [2022, 2023, 2024, 2025];
        $kelasList = ['A', 'B', 'C'];
        
        $counter = 1;
        $nimCounter = 1;
        
        foreach ($angkatanList as $angkatan) {
            foreach ($prodiList as $prodiName => $prodiCode) {
                // Tentukan jumlah mahasiswa per prodi per angkatan (sekitar 8-9)
                $jumlahPerProdiAngkatan = 8;
                
                for ($i = 1; $i <= $jumlahPerProdiAngkatan; $i++) {
                    if ($counter > 100) break 3; // Stop jika sudah 100
                    
                    // NIM format: angkatan (2 digit) + kode prodi (2 digit) + nomor urut (4 digit)
                    // Contoh: 22110001 = angkatan 2022, prodi 11, nomor 0001
                    $nim = sprintf('%02d%02d%04d', $angkatan % 100, $prodiCode, $nimCounter);
                    
                    $namaDepanPilih = $namaDepan[array_rand($namaDepan)];
                    $namaBelakangPilih = $namaBelakang[array_rand($namaBelakang)];
                    $nama = $namaDepanPilih . ' ' . $namaBelakangPilih;
                    $kelas = $kelasList[($i - 1) % count($kelasList)]; // Distribusi merata A, B, C
                    
                    $mahasiswas[] = [
                        'nim' => $nim,
                        'nama' => $nama,
                        'nama_depan' => $namaDepanPilih,
                        'nama_belakang' => $namaBelakangPilih,
                        'prodi' => $prodiName,
                        'angkatan' => $angkatan,
                        'kelas_name' => $kelas
                    ];
                    
                    $counter++;
                    $nimCounter++;
                }
            }
        }

        foreach ($mahasiswas as $data) {
            // Email format: namadepan.namabelakang@student.ac.id
            $email = strtolower($data['nama_depan']) . '.' . strtolower($data['nama_belakang']) . '@student.ac.id';
            $kelas_name = $data['kelas_name'];
            unset($data['kelas_name']);
            unset($data['nama_depan']);
            unset($data['nama_belakang']);

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