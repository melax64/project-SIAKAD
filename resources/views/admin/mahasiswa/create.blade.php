@extends('layouts.admin')

@section('title', 'Tambah Mahasiswa')

@section('main-content')
    <div
        class="max-w-2xl mx-auto bg-white dark:bg-slate-800 p-8 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Input Data Mahasiswa Baru</h2>

        <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                    <input type="text" name="name"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Maila Aziza" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">NIM (Akan menjadi Password Default)</label>
                    <input type="text" name="nim"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="202xxxx..." required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email (Untuk Login)</label>
                    <input type="email" name="email"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Program Studi</label>
                    <select name="prodi"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Teknologi Rekayasa Komputer Jaringan</option>
                        <option value="Teknik Elektro">Teknologi Rekayasa Multimedia</option>
                    </select>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan Data
                </button>
                <a href="{{ route('admin.dashboard') }}"
                    class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
