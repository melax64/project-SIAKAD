<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run()
    {
        // DosenSeeder kosong - Dosen hanya bisa dibuat via admin dashboard
        // Password default akan menggunakan NIP
    }
}
