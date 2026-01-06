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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas'); // A1, A2, B1, B2, etc.
            $table->string('prodi'); // Program Studi
            $table->year('angkatan'); // Tahun angkatan
            $table->integer('kapasitas')->default(40);
            $table->timestamps();

            // Unique constraint untuk nama kelas per prodi dan angkatan
            $table->unique(['nama_kelas', 'prodi', 'angkatan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
