<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliahs';

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sks',
        'deskripsi',
    ];

    public function dosens()
    {
        return $this->hasMany(DosenMataKuliah::class, 'mata_kuliah', 'nama_matakuliah');
    }
}
