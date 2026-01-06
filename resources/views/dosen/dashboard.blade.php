@extends('layouts.dosen')

@section('title', 'Dashboard Dosen')

@section('main-content')
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div
            class="bg-gradient-to-r from-indigo-600 to-indigo-800 dark:from-indigo-900 dark:to-indigo-950 p-8 rounded-xl shadow-md text-white">
            <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-indigo-200 mt-2">Kelola nilai dan mata kuliah Anda dari sini</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Mata Kuliah</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $mataKuliahCount ?? 0 }}</p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-full">
                        <i data-lucide="book-open" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Nilai Terisi</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $nilaiCount ?? 0 }}</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900/30 p-3 rounded-full">
                        <i data-lucide="file-spreadsheet" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">NIP</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white mt-2">{{ $dosen?->nip ?? '-' }}</p>
                    </div>
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-3 rounded-full">
                        <i data-lucide="award" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('dosen.nilai') }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition">
                <div class="flex items-start">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                        <i data-lucide="file-spreadsheet" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Input Nilai</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola nilai mahasiswa Anda</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('dosen.kelas') }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition">
                <div class="flex items-start">
                    <div class="bg-green-100 dark:bg-green-900/30 p-3 rounded-lg mr-4">
                        <i data-lucide="users" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Daftar Kelas</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Lihat mahasiswa di kelas Anda</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Mata Kuliah Ajar -->
        @if (($dosen?->mataKuliah ?? collect())->isNotEmpty())
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Mata Kuliah yang Diampu</h2>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($dosen->mataKuliah as $mk)
                        <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">
                                        {{ $mk->mataKuliah->nama_matakuliah ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        Kode: {{ $mk->mataKuliah->kode_matakuliah ?? '-' }} | SKS: {{ $mk->sks ?? '-' }}
                                    </p>
                                </div>
                                <span
                                    class="inline-block px-3 py-1 text-xs font-medium rounded-full {{ $mk->tipe_kelas === 'teori' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400' }}">
                                    {{ $mk->tipe_kelas === 'teori' ? 'Teori' : 'Praktikum' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
