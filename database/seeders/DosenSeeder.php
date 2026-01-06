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
                'mataKuliah' => ['Pemrograman Web', 'Web Framework Advanced'],
            ],
            [
                'name' => 'Prof. Siti Nurhaliza, Ph.D',
                'email' => 'siti.nurhaliza@siakad.com',
                'nip' => '111',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Database Design', 'Advanced Database'],
            ],
            [
                'name' => 'Ir. Ahmad Wijaya, M.T',
                'email' => 'ahmad.wijaya@siakad.com',
                'nip' => '198703151998021001',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Operating System', 'Linux Administration'],
            ],
            [
                'name' => 'Dr. Rina Puspita, S.Kom, M.Tech',
                'email' => 'rina.puspita@siakad.com',
                'nip' => '198912251997032001',
                'jabatan' => 'Dosen Tidak Tetap',
                'mataKuliah' => ['Algoritma & Struktur Data', 'Advanced Algorithm'],
            ],
            [
                'name' => 'Drs. Hendra Gunawan, M.Sc',
                'email' => 'hendra.gunawan@siakad.com',
                'nip' => '196508301995121001',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Jaringan Komputer', 'Network Security'],
            ],
            [
                'name' => 'Dr. Dwi Retno Kusuma, M.Pd',
                'email' => 'dwi.retno@siakad.com',
                'nip' => '197805201999032002',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['User Interface Design', 'Pemrograman Web'],
            ],
            [
                'name' => 'Ir. Toni Hermawan, M.Tech',
                'email' => 'toni.hermawan@siakad.com',
                'nip' => '198401181996031001',
                'jabatan' => 'Dosen Tetap',
                'mataKuliah' => ['Software Engineering', 'Web Framework Advanced'],
            ],
            [
                'name' => 'Dr. Maya Wijayanti, S.Si, M.Tech',
                'email' => 'maya.wijayanti@siakad.com',
                'nip' => '198612141998021003',
                'jabatan' => 'Dosen Tidak Tetap',
                'mataKuliah' => ['Network Security', 'Database Design'],
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
    }
}
