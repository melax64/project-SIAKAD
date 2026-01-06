<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenMataKuliah extends Model
{
    protected $table = 'dosen_mata_kuliah';

    protected $fillable = [
        'dosen_id',
        'mata_kuliah',
        'tipe_kelas',
        'sks',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
