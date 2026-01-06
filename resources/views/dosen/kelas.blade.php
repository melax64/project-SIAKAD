@extends('layouts.dosen')

@section('title', 'Daftar Kelas - SIAKAD')

@section('main-content')
    <div class="space-y-6">
        <!-- Header -->
        <div
            class="bg-gradient-to-r from-indigo-600 to-indigo-800 dark:from-indigo-900 dark:to-indigo-950 p-8 rounded-xl shadow-md text-white">
            <h1 class="text-3xl font-bold">Daftar Kelas</h1>
            <p class="text-indigo-200 mt-2">Lihat daftar mahasiswa berdasarkan kelas yang diampu</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Prodi</label>
                    <select name="prodi" id="prodiSelect"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Semua Prodi --</option>
                        <option value="Teknik Informatika"
                            {{ request('prodi') === 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika (TI)
                        </option>
                        <option value="Teknologi Rekayasa Multimedia"
                            {{ request('prodi') === 'Teknologi Rekayasa Multimedia' ? 'selected' : '' }}>Teknologi Rekayasa
                            Multimedia (TRMM)</option>
                        <option value="Teknologi Rekayasa Komputer Jaringan"
                            {{ request('prodi') === 'Teknologi Rekayasa Komputer Jaringan' ? 'selected' : '' }}>Teknologi
                            Rekayasa Komputer Jaringan (TRKJ)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Angkatan</label>
                    <select name="angkatan" id="angkatanSelect"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Semua Angkatan --</option>
                        <option value="2025" {{ request('angkatan') === '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2024" {{ request('angkatan') === '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2023" {{ request('angkatan') === '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2022" {{ request('angkatan') === '2022' ? 'selected' : '' }}>2022</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Kelas</label>
                    <select name="kelas" id="kelasSelect"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Semua Kelas --</option>
                        <option value="A" {{ request('kelas') === 'A' ? 'selected' : '' }}>Kelas A</option>
                        <option value="B" {{ request('kelas') === 'B' ? 'selected' : '' }}>Kelas B</option>
                        <option value="C" {{ request('kelas') === 'C' ? 'selected' : '' }}>Kelas C</option>
                    </select>
                </div>

                <div class="md:col-span-3 flex gap-3">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition flex items-center gap-2">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        Cari
                    </button>
                    <a href="{{ route('dosen.kelas') }}"
                        class="px-6 py-2 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-800 dark:text-white rounded-lg font-medium transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Data Mahasiswa -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Daftar Mahasiswa
                    @if (request('prodi') || request('angkatan') || request('kelas'))
                        <span class="text-sm font-normal text-gray-600 dark:text-gray-400">
                            ({{ $mahasiswas->count() }} mahasiswa)
                        </span>
                    @endif
                </h2>
            </div>

            @if ($mahasiswas->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                                <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">No</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">NIM</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Nama Lengkap
                                </th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Prodi</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Angkatan</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswas as $index => $mhs)
                                <tr
                                    class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <td class="px-6 py-4 text-gray-900 dark:text-white font-medium">{{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white font-mono font-medium">
                                        {{ $mhs->nim }}</td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white font-medium">
                                        {{ $mhs->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $mhs->prodi }}</td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $mhs->angkatan }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-block px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-xs font-medium">
                                            {{ $mhs->kelas ? $mhs->kelas->nama_kelas : '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada mahasiswa dengan filter yang dipilih
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center">
                    <i data-lucide="inbox" class="w-12 h-12 text-gray-400 mx-auto mb-3"></i>
                    <p class="text-gray-600 dark:text-gray-400">Pilih filter terlebih dahulu untuk melihat daftar mahasiswa
                    </p>
                </div>
            @endif
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
