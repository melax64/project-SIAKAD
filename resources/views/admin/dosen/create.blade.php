@extends('layouts.admin')

@section('title', 'Tambah Dosen')

@section('main-content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Input Data Dosen Baru</h2>
        <p class="text-gray-500 text-sm">Password akan otomatis diset sama dengan NIP.</p>
    </div>
    
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
            <ul class="list-disc ml-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.dosen.store') }}" method="POST">
        @csrf
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Dr. Budi Santoso, M.Kom" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">NIP (Nomor Induk Pegawai)</label>
                <input type="text" name="nip" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="1980xxxx..." required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Email (Untuk Login)</label>
                <input type="email" name="email" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Jabatan</label>
                <select name="jabatan" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="Dosen Tetap">Dosen Tetap</option>
                    <option value="Dosen Tidak Tetap">Dosen Tidak Tetap</option>
                </select>
            </div>
        </div>

        <div class="mt-8 flex gap-4">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                Simpan Data
            </button>
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection