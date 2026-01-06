<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'prodi',
        'angkatan',
        'kapasitas',
    ];

    /**
     * Relasi ke Mahasiswa - satu kelas banyak mahasiswa
     */
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'kelas_id');
    }

    /**
     * Relasi ke Nilai - untuk filter nilai per kelas
     */
    public function nilais()
    {
        return $this->hasManyThrough(
            Nilai::class,
            Mahasiswa::class,
            'kelas_id',
            'mahasiswa_id'
        );
    }

    /**
     * Get full kelas name (e.g., "A1 - Informatika 2022")
     */
    public function getFullNameAttribute()
    {
        return "{$this->nama_kelas} - {$this->prodi} {$this->angkatan}";
    }
}
