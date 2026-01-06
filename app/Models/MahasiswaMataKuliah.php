<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MahasiswaMataKuliah extends Model
{
    protected $table = 'mahasiswa_mata_kuliahs';

    protected $fillable = [
        'mahasiswa_id',
        'mata_kuliah_id',
        'dosen_mata_kuliah_id',
        'status',
        'semester',
    ];

    // Relationships
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mata_kuliah', 'mata_kuliah_id');
    }
}
