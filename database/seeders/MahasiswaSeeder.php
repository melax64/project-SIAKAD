<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $mahasiswas = [
            [
                'name' => 'Maila Aziza',
                'email' => 'maila.aziza@student.ac.id',
                'nim' => '2024573010001',
                'prodi' => 'Teknik Informatika',
                'angkatan' => 2024,
            ],
            [
                'name' => 'Reza Firmansyah',
                'email' => 'reza.firmansyah@student.ac.id',
                'nim' => '2024573010002',
                'prodi' => 'Teknik Informatika',
                'angkatan' => 2024,
            ],
            [
                'name' => 'Siti Aminah Putri',
                'email' => 'siti.aminah@student.ac.id',
                'nim' => '2024573010003',
                'prodi' => 'Sistem Informasi',
                'angkatan' => 2024,
            ],
            [
                'name' => 'Budi Hartono',
                'email' => 'budi.hartono@student.ac.id',
                'nim' => '2024573010004',
                'prodi' => 'Teknik Informatika',
                'angkatan' => 2024,
            ],
            [
                'name' => 'Dina Rahmawati',
                'email' => 'dina.rahmawati@student.ac.id',
                'nim' => '2024573010005',
                'prodi' => 'Sistem Informasi',
                'angkatan' => 2024,
            ],
        ];

        foreach ($mahasiswas as $data) {
            DB::transaction(function () use ($data) {
                // Cek apakah user sudah ada
                $user = User::firstOrCreate(
                    ['email' => $data['email']],
                    [
                        'name' => $data['name'],
                        'password' => Hash::make($data['nim']),
                        'role' => 'mahasiswa',
                    ]
                );

                // Cek apakah mahasiswa sudah ada
                Mahasiswa::firstOrCreate(
                    ['nim' => $data['nim']],
                    [
                        'user_id' => $user->id,
                        'prodi' => $data['prodi'],
                        'angkatan' => $data['angkatan'],
                    ]
                );
            });
        }
    }
}
