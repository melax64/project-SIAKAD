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
            // Add tugas1, tugas2, tugas3 columns for separate task grades
            $table->decimal('tugas1', 5, 2)->nullable()->after('tugas');
            $table->decimal('tugas2', 5, 2)->nullable()->after('tugas1');
            $table->decimal('tugas3', 5, 2)->nullable()->after('tugas2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn(['tugas1', 'tugas2', 'tugas3']);
        });
    }
};
