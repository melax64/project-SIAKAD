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
        Schema::table('nilais', function (Blueprint $table) {
            $table->decimal('nilai_angka', 5, 2)->nullable()->after('uas');
            $table->string('nilai_huruf', 2)->nullable()->after('nilai_angka');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn(['nilai_angka', 'nilai_huruf']);
        });
    }
};
