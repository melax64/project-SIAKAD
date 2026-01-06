<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Checking Prodi Names ===\n\n";

$prodiList = DB::table('mahasiswas')
    ->select('prodi')
    ->distinct()
    ->get();

echo "Prodi di tabel mahasiswas:\n";
foreach ($prodiList as $prodi) {
    $count = DB::table('mahasiswas')->where('prodi', $prodi->prodi)->count();
    echo "  - {$prodi->prodi} ({$count} mahasiswa)\n";
}

echo "\nProdi di tabel kelas:\n";
$prodiKelas = DB::table('kelas')
    ->select('prodi')
    ->distinct()
    ->get();

foreach ($prodiKelas as $prodi) {
    $count = DB::table('kelas')->where('prodi', $prodi->prodi)->count();
    echo "  - {$prodi->prodi} ({$count} kelas)\n";
}
