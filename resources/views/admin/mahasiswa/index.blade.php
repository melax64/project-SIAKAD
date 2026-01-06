@extends('layouts.admin')

@section('title', 'Data Mahasiswa')

@section('main-content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Data Mahasiswa</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Total: {{ $mahasiswas->count() }} Mahasiswa</p>
            </div>
            <a href="{{ route('admin.mahasiswa.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition flex items-center gap-2">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Tambah Baru
            </a>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg">
                <p class="text-green-800 dark:text-green-200 font-medium">
                    <i data-lucide="check-circle" class="w-5 h-5 inline mr-2"></i>
                    {{ session('success') }}
                </p>
            </div>
        @endif

        <!-- Tabel Data Mahasiswa -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Semua Mahasiswa</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">NIM</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Nama Lengkap</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Prodi</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Angkatan</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Kelas</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Email</th>
                            <th class="px-6 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswas as $index => $mhs)
                            <tr
                                class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 text-gray-900 dark:text-white font-medium">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white font-mono font-medium">
                                    {{ $mhs->nim }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $mhs->user->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $mhs->prodi }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $mhs->angkatan }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 rounded-full text-xs font-medium">
                                        {{ $mhs->kelas ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $mhs->user->email ?? '-' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data mahasiswa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
