@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa - SIAKAD')

@section('main-content')
    <div class="space-y-6">
        <!-- Gradient Header -->
        <div
            class="bg-gradient-to-r from-purple-600 to-purple-800 dark:from-purple-900 dark:to-purple-950 p-8 rounded-xl shadow-md text-white">
            <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-purple-200 mt-2">Kelola KRS dan lihat nilai akademik Anda</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- NIM -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">NIM</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $mahasiswa->nim ?? '-' }}</p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-full">
                        <i data-lucide="user" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Program Studi -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Program Studi</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white mt-2">{{ $mahasiswa->prodi ?? '-' }}</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900/30 p-3 rounded-full">
                        <i data-lucide="book-open" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Angkatan -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Angkatan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $mahasiswa->angkatan ?? '-' }}
                        </p>
                    </div>
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-3 rounded-full">
                        <i data-lucide="calendar" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('mahasiswa.krs') }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition">
                <div class="flex items-start">
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-3 rounded-lg mr-4">
                        <i data-lucide="clipboard-list" class="w-6 h-6 text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Isi KRS</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Input rencana studi Anda</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('mahasiswa.krs.print') }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition">
                <div class="flex items-start">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                        <i data-lucide="printer" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Cetak KRS</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Lihat dan cetak KRS Anda</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('mahasiswa.nilai') }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition">
                <div class="flex items-start">
                    <div class="bg-green-100 dark:bg-green-900/30 p-3 rounded-lg mr-4">
                        <i data-lucide="file-text" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Nilai</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Lihat nilai akademik Anda</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Info Box -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-start">
                <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                    <i data-lucide="info" class="w-5 h-5 text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Informasi Penting</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Untuk informasi lebih lanjut mengenai akademik
                        Anda, silahkan hubungi bagian akademik di ruang administrator.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
