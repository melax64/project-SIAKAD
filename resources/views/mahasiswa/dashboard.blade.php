@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa - SIAKAD')

@section('main-content')
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl p-8 text-white">
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                <span class="text-2xl font-bold text-white">BS</span>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ $mahasiswa->nama ?? 'Budi Santoso' }}!</h1>
                <p class="text-blue-100">
                    NIM: {{ $mahasiswa->nim ?? '2021001' }} | Teknik Informatika | Semester 6
                </p>
            </div>
        </div>
    </div>

    <!-- Quick Access Cards -->
    <div>
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Akses Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('mahasiswa.krs') }}" 
               class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md hover:border-blue-300 transition-all">
                <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <i data-lucide="file-edit" class="w-6 h-6 text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Isi KRS</h3>
                <p class="text-sm text-gray-600">Daftar mata kuliah semester ini</p>
            </a>

            <a href="{{ route('mahasiswa.nilai') }}" 
               class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md hover:border-green-300 transition-all">
                <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <i data-lucide="award" class="w-6 h-6 text-green-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Lihat Nilai</h3>
                <p class="text-sm text-gray-600">Cek nilai dan transkrip</p>
            </a>

            <a href="{{ route('mahasiswa.jadwal') }}" 
               class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md hover:border-purple-300 transition-all">
                <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <i data-lucide="calendar" class="w-6 h-6 text-purple-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Jadwal Hari Ini</h3>
                <p class="text-sm text-gray-600">Lihat jadwal kuliah hari ini</p>
            </a>
        </div>
    </div>

    <!-- Academic Info -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <p class="text-sm text-gray-600 mb-2">IPK</p>
            <h2 class="text-4xl font-bold text-gray-900">3.76</h2>
            <p class="text-sm text-green-600 mt-2">Predikat: Cum Laude</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <p class="text-sm text-gray-600 mb-2">SKS Diambil</p>
            <h2 class="text-4xl font-bold text-gray-900">20 SKS</h2>
            <p class="text-sm text-blue-600 mt-2">Semester 6</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <p class="text-sm text-gray-600 mb-2">Total SKS</p>
            <h2 class="text-4xl font-bold text-gray-900">110 SKS</h2>
            <p class="text-sm text-gray-600 mt-2">dari 144 SKS</p>
        </div>
    </div>

    <!-- Jadwal Minggu Ini -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Jadwal Minggu Ini</h3>
            <a href="{{ route('mahasiswa.jadwal') }}" 
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
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Dosen</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Ruangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $jadwal = [
                            ['hari' => 'Senin', 'waktu' => '08:00 - 10:00', 'matkul' => 'Pemrograman Web', 'dosen' => 'Dr. Ahmad Wijaya', 'ruangan' => 'Lab 301'],
                            ['hari' => 'Selasa', 'waktu' => '10:00 - 12:00', 'matkul' => 'Basis Data', 'dosen' => 'Prof. Siti Rahman', 'ruangan' => 'GD 205'],
                            ['hari' => 'Rabu', 'waktu' => '13:00 - 15:00', 'matkul' => 'Keamanan Siber', 'dosen' => 'Dr. Budi Hartono', 'ruangan' => 'Lab 302'],
                            ['hari' => 'Kamis', 'waktu' => '08:00 - 10:00', 'matkul' => 'Kecerdasan Buatan', 'dosen' => 'Dr. Maya Putri', 'ruangan' => 'GD 301'],
                        ];
                    @endphp
                    
                    @foreach($jadwal as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item['hari'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['waktu'] }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item['matkul'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['dosen'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['ruangan'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pengumuman -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Pengumuman Terbaru</h3>
        </div>
        <div class="p-6 space-y-4">
            <div class="flex gap-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <div class="w-2 bg-blue-600 rounded-full flex-shrink-0"></div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900 mb-1">Pendaftaran KRS Semester Genap</h4>
                    <p class="text-sm text-gray-600 mb-2">
                        Pendaftaran KRS dibuka mulai tanggal 15 Januari 2025. Pastikan Anda melakukan registrasi tepat waktu.
                    </p>
                    <span class="text-xs text-gray-500">2 hari yang lalu</span>
                </div>
            </div>
            <div class="flex gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="w-2 bg-gray-400 rounded-full flex-shrink-0"></div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900 mb-1">Seminar Teknologi Terkini</h4>
                    <p class="text-sm text-gray-600 mb-2">
                        Ikuti seminar tentang AI dan Machine Learning pada tanggal 20 Januari 2025 di Auditorium Utama.
                    </p>
                    <span class="text-xs text-gray-500">5 hari yang lalu</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
