@extends('layouts.app')

@section('title', 'SIAKAD - Sistem Informasi Akademik')

@section('content')
<div class="min-h-screen bg-linear-to-br from-blue-50 to-indigo-50">

    <!-- Hero Section -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold text-blue-900 mb-4">
                SELAMAT DATANG DI SIAKAD
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi in ad reiciendis modi neque minima natus, ipsum quisquam. Sapiente doloremque obcaecati non aliquam eveniet? Magnam aliquam sapiente ipsum repudiandae veritatis.
            </p>
        </div>

        <!-- Role Selection Cards -->
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Admin Card -->
            <a href="" 
               class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-transparent hover:border-blue-500">
                <div class="bg-blue-100 w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="shield" class="w-8 h-8 text-blue-600"></i>
                    <img src="{{ asset('images/admin.png') }}" alt="Logo Admin">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2 text-center">Login Admin</h3>
                <p class="text-gray-600 text-center">
                    Kelola data mahasiswa, dosen, dan jadwal akademik
                </p>
            </a>

            <!-- Mahasiswa Card -->
            <a href="" 
               class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-transparent hover:border-blue-500">
                <div class="bg-green-100 w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="book-open" class="w-8 h-8 text-green-600"></i>
                    <img src="{{ asset('images/mahasiswa.png') }}" alt="Logo Mahasiswa">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2 text-center">Login Mahasiswa</h3>
                <p class="text-gray-600 text-center">
                    Akses jadwal, isi KRS, dan lihat nilai akademik
                </p>
            </a>

            <!-- Dosen Card -->
            <a href="" 
               class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-transparent hover:border-blue-500">
                <div class="bg-indigo-100 w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="users" class="w-8 h-8 text-indigo-600"></i>
                    <img src="{{ asset('images/dosen.png') }}" alt="Logo Dosen">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2 text-center">Login Dosen</h3>
                <p class="text-gray-600 text-center">
                    Kelola jadwal mengajar dan input nilai mahasiswa
                </p>
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-20 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-gray-600">
                © 2025 SIAKAD Universitas. All rights reserved.
            </p>
        </div>
    </footer>
</div>
@endsection
