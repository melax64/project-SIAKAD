@extends('layouts.admin')

@section('title', 'Dashboard Admin - SIAKAD')

@section('main-content')
    <div class="space-y-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Dashboard Admin</h1>
            <p class="text-gray-600">Selamat datang di Sistem Informasi Akademik</p>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 dark:bg-slate-800 border-blue-500 p-6 rounded-r-xl shadow-sm">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Kelola Data Pengguna</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <a href="{{ route('admin.mahasiswa.create') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer border border-blue-100 dark:border-gray-800 group">
                    <div class="p-3 bg-blue-100 rounded-full text-blue-600 mr-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        {{-- Icon User Plus --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 dark:text-white">Tambah Mahasiswa</h3>
                        <p class="text-sm text-gray-500">Input data & buat akun login mahasiswa</p>
                    </div>
                </a>

                <a href="{{ route('admin.dosen.create') }}"
                    class="flex items-center p-4 bg-white dark:bg-slate-800 rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer border border-green-100 dark:border-gray-800 group">
                    <div class="p-3 bg-green-100 rounded-full text-green-600 mr-4 group-hover:bg-green-600 group-hover:text-white transition-colors">
                        {{-- Icon Briefcase --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 dark:text-white">Tambah Dosen</h3>
                        <p class="text-sm text-gray-500">Input data & buat akun login dosen</p>
                    </div>
                </a>
            </div>
        </div>

    </div> 
@endsection