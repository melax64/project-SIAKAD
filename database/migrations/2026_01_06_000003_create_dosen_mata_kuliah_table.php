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
        Schema::create('dosen_mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('dosens')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
            $table->string('mata_kuliah');
            $table->enum('tipe_kelas', ['teori', 'praktikum'])->default('teori');
            $table->integer('sks')->default(3);
            $table->timestamps();

            // Pastikan satu dosen tidak bisa punya mata kuliah duplikat
            $table->unique(['dosen_id', 'mata_kuliah', 'tipe_kelas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_mata_kuliah');
    }
};
