@extends('layouts.dosen')

@section('title', 'Dashboard Dosen - SIAKAD')

@section('main-content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl p-8 text-white">
        <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ $dosen->nama ?? 'Dr. Ahmad Wijaya' }}!</h1>
        <p class="text-indigo-100">
            NIDN: 0123456789 | Fakultas Teknik Informatika
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @include('components.stat-card', [
            'title' => 'Total Kelas',
            'value' => '5',
            'icon' => 'book-open',
            'color' => 'blue',
            'trend' => 'Semester Genap'
        ])
        
        @include('components.stat-card', [
            'title' => 'Mahasiswa Aktif',
            'value' => '187',
            'icon' => 'users',
            'color' => 'green',
            'trend' => 'Di semua kelas'
        ])
        
        @include('components.stat-card', [
            'title' => 'Nilai Belum Diinput',
            'value' => '42',
            'icon' => 'file-spreadsheet',
            'color' => 'orange',
            'trend' => 'Perlu segera'
        ])
        
        @include('components.stat-card', [
            'title' => 'Jadwal Mengajar',
            'value' => '12',
            'icon' => 'calendar',
            'color' => 'purple',
            'trend' => 'Per minggu'
        ])
    </div>

    <!-- Quick Actions -->
    <div>
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('dosen.jadwal') }}" 
               class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md hover:border-indigo-300 transition-all">
                <div class="bg-indigo-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <i data-lucide="calendar" class="w-6 h-6 text-indigo-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Jadwal Mengajar</h3>
                <p class="text-sm text-gray-600">Lihat jadwal mengajar Anda</p>
            </a>

            <a href="{{ route('dosen.nilai') }}" 
               class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md hover:border-orange-300 transition-all">
                <div class="bg-orange-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <i data-lucide="file-spreadsheet" class="w-6 h-6 text-orange-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Input Nilai</h3>
                <p class="text-sm text-gray-600">Input nilai mahasiswa</p>
            </a>

            <a href="{{ route('dosen.kelas') }}" 
               class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md hover:border-blue-300 transition-all">
                <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Daftar Kelas</h3>
                <p class="text-sm text-gray-600">Kelola daftar kelas Anda</p>
            </a>
        </div>
    </div>

    <!-- Jadwal Mengajar Minggu Ini -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Jadwal Mengajar Minggu Ini</h3>
            <a href="{{ route('dosen.jadwal') }}" 
               class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Lihat Semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Hari</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Waktu</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Kelas</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Ruangan</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Mahasiswa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $jadwal = [
                            ['hari' => 'Senin', 'waktu' => '08:00 - 10:00', 'matkul' => 'Pemrograman Web', 'kelas' => 'TIF-6A', 'ruangan' => 'Lab 301', 'mahasiswa' => '38 orang'],
                            ['hari' => 'Selasa', 'waktu' => '10:00 - 12:00', 'matkul' => 'Pemrograman Web', 'kelas' => 'TIF-6B', 'ruangan' => 'Lab 301', 'mahasiswa' => '35 orang'],
                            ['hari' => 'Rabu', 'waktu' => '13:00 - 15:00', 'matkul' => 'Basis Data', 'kelas' => 'TIF-4A', 'ruangan' => 'Lab 302', 'mahasiswa' => '42 orang'],
                            ['hari' => 'Kamis', 'waktu' => '08:00 - 10:00', 'matkul' => 'Sistem Informasi', 'kelas' => 'SI-4A', 'ruangan' => 'GD 205', 'mahasiswa' => '40 orang'],
                            ['hari' => 'Jumat', 'waktu' => '10:00 - 12:00', 'matkul' => 'Rekayasa Perangkat Lunak', 'kelas' => 'TIF-6A', 'ruangan' => 'GD 301', 'mahasiswa' => '32 orang'],
                        ];
                    @endphp
                    
                    @foreach($jadwal as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item['hari'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['waktu'] }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item['matkul'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['kelas'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['ruangan'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['mahasiswa'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mahasiswa Bimbingan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Mahasiswa Bimbingan</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-sm font-semibold text-blue-600">BS</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Budi Santoso</p>
                            <p class="text-sm text-gray-600">2021001 - Skripsi</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">
                        Sistem Rekomendasi Berbasis Machine Learning
                    </p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="text-sm font-semibold text-green-600">SN</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Siti Nurhaliza</p>
                            <p class="text-sm text-gray-600">2021002 - Skripsi</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">
                        Aplikasi Mobile untuk E-Commerce
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
