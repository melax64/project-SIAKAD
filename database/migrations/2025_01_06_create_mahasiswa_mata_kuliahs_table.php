<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa_mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
            $table->enum('status', ['aktif', 'batal', 'selesai'])->default('aktif');
            $table->string('semester')->nullable(); // Contoh: '2024/2025 Genap'
            $table->timestamps();

            // Composite unique - satu mahasiswa tidak bisa ambil satu mata kuliah 2x di semester sama
            $table->unique(['mahasiswa_id', 'mata_kuliah_id', 'semester']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_mata_kuliahs');
    }
};
