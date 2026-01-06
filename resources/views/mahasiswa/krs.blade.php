@extends('layouts.mahasiswa')

@section('title', 'Cetak KRS - SIAKAD')

@section('main-content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Kartu Rencana Studi (KRS)</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Lihat dan cetak rencana studi Anda</p>
            </div>
            <button onclick="window.print()"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-lg">
                <i data-lucide="printer" class="w-5 h-5 inline mr-2"></i>Cetak KRS
            </button>
        </div>

        <!-- KRS Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-8">
            <!-- Identitas Mahasiswa -->
            <div class="border-b border-gray-300 pb-6 mb-6 print-section">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Nama Mahasiswa</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{ $mahasiswa->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold">NIM</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{ $mahasiswa->nim }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Program Studi</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{ $mahasiswa->prodi }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Angkatan</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">{{ $mahasiswa->angkatan }}</p>
                    </div>
                </div>
            </div>

            <!-- Daftar Mata Kuliah -->
            <div class="print-section">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Daftar Mata Kuliah</h2>

                @if ($nilaiList->isEmpty())
                    <div
                        class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-6 text-center">
                        <p class="text-gray-600 dark:text-gray-400">Belum ada mata kuliah yang diambil</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b-2 border-gray-300 bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-3 text-left font-bold text-gray-900 dark:text-white">No</th>
                                    <th class="px-4 py-3 text-left font-bold text-gray-900 dark:text-white">Mata Kuliah</th>
                                    <th class="px-4 py-3 text-left font-bold text-gray-900 dark:text-white">Tipe Kelas</th>
                                    <th class="px-4 py-3 text-center font-bold text-gray-900 dark:text-white">SKS</th>
                                    <th class="px-4 py-3 text-left font-bold text-gray-900 dark:text-white">Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilaiList as $index => $nilai)
                                    <tr
                                        class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <td class="px-4 py-3 text-gray-900 dark:text-white">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 text-gray-900 dark:text-white font-medium">
                                            {{ $nilai->mata_kuliah ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $nilai->tipe_kelas === 'teori' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400' }}">
                                                {{ $nilai->tipe_kelas === 'teori' ? 'Teori' : 'Praktikum' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center text-gray-900 dark:text-white font-medium">
                                            {{ $nilai->sks ?? '-' }}</td>
                                        <td class="px-4 py-3 text-gray-900 dark:text-white">
                                            {{ $nilai->dosen->user->name ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-t-2 border-gray-300 bg-gray-100 dark:bg-gray-700">
                                    <td colspan="3" class="px-4 py-3 font-bold text-gray-900 dark:text-white text-right">
                                        Total SKS:</td>
                                    <td class="px-4 py-3 text-center font-bold text-gray-900 dark:text-white text-lg">
                                        {{ $totalSKS }}</td>
                                    <td class="px-4 py-3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Catatan Cetak -->
            <div
                class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 text-xs text-gray-600 dark:text-gray-400 print-section">
                <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
                <p class="mt-2">* KRS ini adalah dokumen resmi dari Sistem Informasi Akademik (SIAKAD)</p>
            </div>
        </div>
    </div>

    <style media="print">
        @media print {
            body {
                background-color: white;
            }

            .print-section {
                page-break-inside: avoid;
            }

            button {
                display: none !important;
            }
        }
    </style>
@endsection
