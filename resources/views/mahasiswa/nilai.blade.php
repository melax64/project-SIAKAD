@extends('layouts.mahasiswa')

@section('main-content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Nilai Akademik</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Lihat nilai mata kuliah yang Anda ambil</p>
        </div>

        <!-- Info Alert -->
        @if ($nilaiList->isEmpty())
            <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <p class="text-blue-800 dark:text-blue-200">
                    <i data-lucide="info" class="w-4 h-4 inline mr-2"></i>
                    Belum ada nilai yang tercatat. Hubungi dosen untuk memastikan nilai Anda sudah diinput.
                </p>
            </div>
        @endif

        <!-- Filter & Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Total Mata Kuliah -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Mata Kuliah</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $nilaiList->count() }}</p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-900/30 rounded-full p-3">
                        <i data-lucide="book" class="w-8 h-8 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Rata-rata IPK -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Rata-rata Nilai</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ number_format($averageNilai, 2) }}</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900/30 rounded-full p-3">
                        <i data-lucide="award" class="w-8 h-8 text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total SKS -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total SKS</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalSks }}</p>
                    </div>
                    <div class="bg-purple-100 dark:bg-purple-900/30 rounded-full p-3">
                        <i data-lucide="zap" class="w-8 h-8 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Nilai -->
        @if ($nilaiList->isNotEmpty())
            <div
                class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden">
                <div class="px-6 md:px-8 py-5 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-900">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Nilai Mata Kuliah</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-slate-900">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Mata Kuliah</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    SKS</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Dosen</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Kehadiran</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Tugas</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    UTS</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    UAS</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Nilai Akhir</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Grade</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                            @foreach ($nilaiList as $index => $nilai)
                                @php
                                    $nilaiAkhir =
                                        ($nilai->kehadiran ?? 0) * 0.1 +
                                        ($nilai->tugas ?? 0) * 0.2 +
                                        ($nilai->uts ?? 0) * 0.3 +
                                        ($nilai->uas ?? 0) * 0.4;

                                    if ($nilaiAkhir >= 85) {
                                        $grade = 'A';
                                    } elseif ($nilaiAkhir >= 80) {
                                        $grade = 'A-';
                                    } elseif ($nilaiAkhir >= 75) {
                                        $grade = 'B+';
                                    } elseif ($nilaiAkhir >= 70) {
                                        $grade = 'B';
                                    } elseif ($nilaiAkhir >= 65) {
                                        $grade = 'B-';
                                    } elseif ($nilaiAkhir >= 60) {
                                        $grade = 'C+';
                                    } elseif ($nilaiAkhir >= 55) {
                                        $grade = 'C';
                                    } elseif ($nilaiAkhir >= 50) {
                                        $grade = 'D';
                                    } else {
                                        $grade = 'E';
                                    }

                                    $gradeColor = match ($grade) {
                                        'A',
                                        'A-'
                                            => 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400',
                                        'B+',
                                        'B',
                                        'B-'
                                            => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
                                        'C+',
                                        'C'
                                            => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400',
                                        'D'
                                            => 'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400',
                                        'E' => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400',
                                        default => 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400',
                                    };
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $nilai->mata_kuliah ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-600 dark:text-gray-400">
                                        {{ $nilai->sks ?? 3 }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $nilai->dosen->user->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900 dark:text-white">
                                        {{ $nilai->kehadiran ?? '-' }}%
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900 dark:text-white">
                                        {{ $nilai->tugas ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900 dark:text-white">
                                        {{ $nilai->uts ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900 dark:text-white">
                                        {{ $nilai->uas ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center font-semibold text-gray-900 dark:text-white">
                                        {{ number_format($nilaiAkhir, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <span class="px-3 py-1 rounded-full font-semibold {{ $gradeColor }}">
                                            {{ $grade }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Detail Nilai Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Penjelasan Komponen Nilai -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Komponen Penilaian</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-slate-700">
                            <span class="text-gray-600 dark:text-gray-400">Kehadiran</span>
                            <span class="font-semibold text-gray-900 dark:text-white">10%</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-slate-700">
                            <span class="text-gray-600 dark:text-gray-400">Tugas</span>
                            <span class="font-semibold text-gray-900 dark:text-white">20%</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-slate-700">
                            <span class="text-gray-600 dark:text-gray-400">UTS (Mid Semester)</span>
                            <span class="font-semibold text-gray-900 dark:text-white">30%</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 dark:text-gray-400">UAS (Final)</span>
                            <span class="font-semibold text-gray-900 dark:text-white">40%</span>
                        </div>
                    </div>
                </div>

                <!-- Skala Penilaian -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Skala Penilaian</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">A / A-</span>
                            <span
                                class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-sm font-medium rounded">85
                                - 100</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">B+ / B / B-</span>
                            <span
                                class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-sm font-medium rounded">70
                                - 84</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">C+ / C</span>
                            <span
                                class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-sm font-medium rounded">55
                                - 69</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">D</span>
                            <span
                                class="px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 text-sm font-medium rounded">50
                                - 54</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">E</span>
                            <span
                                class="px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm font-medium rounded">&lt;
                                50</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
