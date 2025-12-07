<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan updateOrCreate agar jika seeder dijalankan 2x, 
        // tidak error duplicate, tapi mengupdate data yang sudah ada.
        User::create([
            'name' => 'Admin',
            'email' => 'admin@siakad.com',
            'password' => bcrypt('123456'), // Pastikan pakai bcrypt
            'role' => 'admin',
        ]);
    }
}