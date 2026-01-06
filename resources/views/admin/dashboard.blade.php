@extends('layouts.admin')

@section('title', 'Dashboard Admin - SIAKAD')

@section('main-content')
    <div class="space-y-6">
        <!-- Gradient Header -->
        <div
            class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-900 dark:to-blue-950 p-8 rounded-xl shadow-md text-white">
            <h1 class="text-3xl font-bold">Dashboard Admin</h1>
            <p class="text-blue-200 mt-2">Kelola data pengguna dan sistem akademik</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Mahasiswa</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $mahasiswaCount ?? 0 }}</p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-full">
                        <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Dosen</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $dosenCount ?? 0 }}</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900/30 p-3 rounded-full">
                        <i data-lucide="graduation-cap" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Mata Kuliah</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $mataKuliahCount ?? 0 }}</p>
                    </div>
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-3 rounded-full">
                        <i data-lucide="book-open" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Section -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Kelola Data Pengguna</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                <a href="{{ route('admin.mahasiswa.create') }}"
                    class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-900/10 border border-blue-200 dark:border-blue-800 rounded-lg p-6 hover:shadow-md transition">
                    <div class="flex items-start">
                        <div class="bg-blue-600 p-3 rounded-lg mr-4">
                            <i data-lucide="user-plus" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Tambah Mahasiswa</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Buat akun dan input data mahasiswa baru
                            </p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.dosen.create') }}"
                    class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-900/10 border border-green-200 dark:border-green-800 rounded-lg p-6 hover:shadow-md transition">
                    <div class="flex items-start">
                        <div class="bg-green-600 p-3 rounded-lg mr-4">
                            <i data-lucide="user-plus" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Tambah Dosen</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Buat akun dan input data dosen baru</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Quick Access -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.mahasiswa') }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition">
                <div class="flex items-start">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-lg mr-4">
                        <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Data Mahasiswa</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Lihat & kelola mahasiswa</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.dosen') }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition">
                <div class="flex items-start">
                    <div class="bg-green-100 dark:bg-green-900/30 p-3 rounded-lg mr-4">
                        <i data-lucide="graduation-cap" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Data Dosen</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Lihat & kelola dosen</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.matakuliah.index') }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition">
                <div class="flex items-start">
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-3 rounded-lg mr-4">
                        <i data-lucide="book-open" class="w-6 h-6 text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Mata Kuliah</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola mata kuliah</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
