<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi
    protected $fillable = [
        'user_id',
        'nim',
        'prodi',
        'angkatan',
    ];

    // Relasi balik ke User (Opsional tapi bagus ada)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}