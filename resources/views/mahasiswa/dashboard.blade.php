@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa - SIAKAD')

@section('main-content')
    <div class="space-y-6">
        <!-- Header Greeting -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Anda login sebagai Mahasiswa</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- IPK -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">IPK</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">3.76</p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-900/30 rounded-full p-3">
                        <i data-lucide="award" class="w-8 h-8 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- SKS Diambil -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">SKS Diambil</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">20 SKS</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900/30 rounded-full p-3">
                        <i data-lucide="book-open" class="w-8 h-8 text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total SKS -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total SKS</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">110 SKS</p>
                    </div>
                    <div class="bg-purple-100 dark:bg-purple-900/30 rounded-full p-3">
                        <i data-lucide="zap" class="w-8 h-8 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Data Akademik -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Data Akademik</h2>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-slate-700">
                        <span class="text-gray-600 dark:text-gray-400">NIM</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $mahasiswa->nim ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-slate-700">
                        <span class="text-gray-600 dark:text-gray-400">Program Studi</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $mahasiswa->prodi ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-slate-700">
                        <span class="text-gray-600 dark:text-gray-400">Angkatan</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $mahasiswa->angkatan ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-600 dark:text-gray-400">Status</span>
                        <span
                            class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-sm font-medium rounded-full">Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Informasi Akademik -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    <i data-lucide="info" class="w-4 h-4 inline mr-2"></i>Informasi Akademik
                </h2>
                <div class="space-y-3">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Hubungi bagian akademik untuk informasi lebih lanjut
                        tentang akademik Anda.</p>
                </div>
            </div>
        </div>

        <!-- Jadwal Minggu Ini -->
        <div
            class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden">
            <div class="px-6 md:px-8 py-5 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Jadwal Minggu Ini</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-slate-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                Hari</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                Dosen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                Ruangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                        @php
                            $jadwal = [
                                [
                                    'hari' => 'Senin',
                                    'waktu' => '08:00 - 10:00',
                                    'matkul' => 'Pemrograman Web',
                                    'dosen' => 'Dr. Ahmad Wijaya',
                                    'ruangan' => 'Lab 301',
                                ],
                                [
                                    'hari' => 'Selasa',
                                    'waktu' => '10:00 - 12:00',
                                    'matkul' => 'Basis Data',
                                    'dosen' => 'Prof. Siti Rahman',
                                    'ruangan' => 'GD 205',
                                ],
                                [
                                    'hari' => 'Rabu',
                                    'waktu' => '13:00 - 15:00',
                                    'matkul' => 'Keamanan Siber',
                                    'dosen' => 'Dr. Budi Hartono',
                                    'ruangan' => 'Lab 302',
                                ],
                                [
                                    'hari' => 'Kamis',
                                    'waktu' => '08:00 - 10:00',
                                    'matkul' => 'Kecerdasan Buatan',
                                    'dosen' => 'Dr. Maya Putri',
                                    'ruangan' => 'GD 301',
                                ],
                            ];
                        @endphp

                        @foreach ($jadwal as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $item['hari'] }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $item['waktu'] }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $item['matkul'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $item['dosen'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $item['ruangan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('mahasiswa.krs') }}"
                class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-4 text-center hover:shadow-xl transition">
                <div class="bg-purple-100 dark:bg-purple-900/30 rounded-full p-3 w-fit mx-auto mb-2">
                    <i data-lucide="clipboard-list" class="w-6 h-6 text-purple-600"></i>
                </div>
                <p class="font-medium text-gray-900 dark:text-white text-sm">KRS</p>
            </a>

            <a href="{{ route('mahasiswa.jadwal') }}"
                class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-4 text-center hover:shadow-xl transition">
                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-full p-3 w-fit mx-auto mb-2">
                    <i data-lucide="calendar" class="w-6 h-6 text-blue-600"></i>
                </div>
                <p class="font-medium text-gray-900 dark:text-white text-sm">Jadwal</p>
            </a>

            <a href="{{ route('mahasiswa.nilai') }}"
                class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-4 text-center hover:shadow-xl transition">
                <div class="bg-green-100 dark:bg-green-900/30 rounded-full p-3 w-fit mx-auto mb-2">
                    <i data-lucide="file-text" class="w-6 h-6 text-green-600"></i>
                </div>
                <p class="font-medium text-gray-900 dark:text-white text-sm">Nilai</p>
            </a>
        </div>
    </div>
@endsection
