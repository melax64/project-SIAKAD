<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use App\Models\DosenMataKuliah;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $dosens = [
            [
                'name' => 'Dr. Budi Santoso, M.Kom',
                'email' => 'budi.santoso@siakad.com',
                'nip' => '198501151020011001',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Pemrograman Dasar', 'Pemrograman Web Lanjut'],
            ],
            [
                'name' => 'Prof. Siti Nurhaliza, Ph.D',
                'email' => 'siti.nurhaliza@siakad.com',
                'nip' => '111',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Advanced Database', 'Struktur Data'],
            ],
            [
                'name' => 'Ir. Ahmad Wijaya, M.T',
                'email' => 'ahmad.wijaya@siakad.com',
                'nip' => '198703151998021001',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Algoritma dan Pemrograman', 'Software Engineering'],
            ],
            [
                'name' => 'Dr. Rina Puspita, S.Kom, M.Tech',
                'email' => 'rina.puspita@siakad.com',
                'nip' => '198912251997032001',
                'jabatan' => 'Dosen Tidak Tetap',
                'mataKuliah' => ['Mobile Application Development', 'Bahasa Indonesia'],
            ],
            [
                'name' => 'Drs. Hendra Gunawan, M.Sc',
                'email' => 'hendra.gunawan@siakad.com',
                'nip' => '196508301995121001',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Jaringan Komputer', 'Keamanan Jaringan'],
            ],
            [
                'name' => 'Dr. Dwi Retno Kusuma, M.Pd',
                'email' => 'dwi.retno@siakad.com',
                'nip' => '197805201999032002',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['UI/UX Design', 'Desain Grafis'],
            ],
            [
                'name' => 'Ir. Toni Hermawan, M.Tech',
                'email' => 'toni.hermawan@siakad.com',
                'nip' => '198401181996031001',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Administrasi Server', 'Cloud Computing'],
            ],
            [
                'name' => 'Dr. Maya Wijayanti, S.Si, M.Tech',
                'email' => 'maya.wijayanti@siakad.com',
                'nip' => '198612141998021003',
                'jabatan' => 'Dosen Tidak Tetap',
                'mataKuliah' => ['Animasi 2D', 'Video Editing'],
            ],
            [
                'name' => 'Prof. Agus Prasetyo, Ph.D',
                'email' => 'agus.prasetyo@siakad.com',
                'nip' => '196712201992031001',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Bahasa Inggris', 'Pendidikan Kewarganegaraan'],
            ],
            [
                'name' => 'Dr. Sri Wahyuni, M.Kom',
                'email' => 'sri.wahyuni@siakad.com',
                'nip' => '197506151999032001',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Matematika Dasar', 'Kewirausahaan'],
            ],
        ];

        foreach ($dosens as $data) {
            $mataKuliah = $data['mataKuliah'];
            unset($data['mataKuliah']);

            DB::transaction(function () use ($data, $mataKuliah) {
                // Cek apakah user sudah ada
                $user = User::firstOrCreate(
                    ['email' => $data['email']],
                    [
                        'name' => $data['name'],
                        'password' => Hash::make($data['nip']),
                        'role' => 'dosen',
                    ]
                );

                // Cek apakah dosen sudah ada
                $dosen = Dosen::firstOrCreate(
                    ['nip' => $data['nip']],
                    [
                        'user_id' => $user->id,
                        'jabatan' => $data['jabatan'],
                    ]
                );

                // Simpan mata kuliah yang diampu
                foreach ($mataKuliah as $mk) {
                    $mataKuliahModel = \App\Models\MataKuliah::where('nama_matakuliah', $mk)->first();
                    if ($mataKuliahModel) {
                        DosenMataKuliah::firstOrCreate(
                            [
                                'dosen_id' => $dosen->id,
                                'mata_kuliah' => $mk,
                                'tipe_kelas' => 'teori',
                            ],
                            [
                                'mata_kuliah_id' => $mataKuliahModel->id,
                                'sks' => $mataKuliahModel->sks,
                            ]
                        );
                    }
                }
            });
        }
        
        $this->command->info("✅ Total " . count($dosens) . " dosen berhasil dibuat!");
    }
}
