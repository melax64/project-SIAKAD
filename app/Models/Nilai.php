<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['dosen_id', 'mahasiswa_id', 'mata_kuliah', 'tipe_kelas', 'sks', 'kehadiran', 'tugas', 'uts', 'uas', 'catatan', 'nilai_akhir', 'nilai_huruf'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Relasi ke Kelas melalui Mahasiswa
    public function kelas()
    {
        return $this->belongsThrough(Kelas::class, Mahasiswa::class);
    }
}
