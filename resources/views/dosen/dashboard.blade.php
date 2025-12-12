@extends('layouts.dosen')

@section('title', 'Dashboard Dosen')

@section('main-content')
    <div class="space-y-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-600 mt-1">
                    Anda login sebagai Dosen.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total SKS</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">12 SKS</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kelas Ajar</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">4 Kelas</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-purple-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Mahasiswa Bimbingan</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">8 Orang</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800">Jadwal Mengajar Hari Ini</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">Jam</th>
                            <th class="px-6 py-3">Mata Kuliah</th>
                            <th class="px-6 py-3">Kelas</th>
                            <th class="px-6 py-3">Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">08:00 - 10:30</td>
                            <td class="px-6 py-4">Pemrograman Web Lanjut</td>
                            <td class="px-6 py-4"><span
                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded">TI-3A</span></td>
                            <td class="px-6 py-4">Lab Komputer 1</td>
                        </tr>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">13:00 - 15:30</td>
                            <td class="px-6 py-4">Basis Data</td>
                            <td class="px-6 py-4"><span
                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded">TI-2B</span></td>
                            <td class="px-6 py-4">R. Teori 05</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
