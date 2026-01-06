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

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('mahasiswa.krs') }}"
                class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-4 text-center hover:shadow-xl transition">
                <div class="bg-purple-100 dark:bg-purple-900/30 rounded-full p-3 w-fit mx-auto mb-2">
                    <i data-lucide="clipboard-list" class="w-6 h-6 text-purple-600"></i>
                </div>
                <p class="font-medium text-gray-900 dark:text-white text-sm">KRS</p>
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
