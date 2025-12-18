<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Mahasiswa;

Route::middleware('auth')->group(function () {
    // Search mahasiswa by NIM
    Route::get('/mahasiswa/{nim}', function ($nim) {
        $mahasiswa = Mahasiswa::where('nim', $nim)->with('user')->first();

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa dengan NIM ' . $nim . ' tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'mahasiswa' => $mahasiswa
        ]);
    });
});