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
        'kelas_id',
    ];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi ke Nilai
    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    // Relasi Many-to-Many ke Mata Kuliah (melalui mahasiswa_mata_kuliahs)
    public function mataKuliahs()
    {
        return $this->hasMany(MahasiswaMataKuliah::class);
    }
}
