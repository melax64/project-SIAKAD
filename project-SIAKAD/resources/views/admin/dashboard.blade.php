@extends('layouts.admin')

@section('title', 'Dashboard Admin - SIAKAD')

@section('main-content')
<div class="space-y-8">
    <!-- Page Title -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Admin</h1>
        <p class="text-gray-600">Selamat datang di sistem informasi akademik</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @include('components.stat-card', [
            'title' => 'Total Mahasiswa',
            'value' => '2,847',
            'icon' => 'users',
            'color' => 'blue',
            'trend' => '+12% dari semester lalu'
        ])
        
        @include('components.stat-card', [
            'title' => 'Total Dosen',
            'value' => '156',
            'icon' => 'graduation-cap',
            'color' => 'green',
            'trend' => '+5 dosen baru'
        ])
        
        @include('components.stat-card', [
            'title' => 'Mata Kuliah',
            'value' => '89',
            'icon' => 'book-open',
            'color' => 'purple',
            'trend' => 'Semester Genap 2024/2025'
        ])
        
        @include('components.stat-card', [
            'title' => 'Jadwal Aktif',
            'value' => '234',
            'icon' => 'calendar',
            'color' => 'orange',
            'trend' => 'Minggu ini'
        ])
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart Card 1 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Mahasiswa per Program Studi</h3>
            <div class="space-y-4">
                @php
                    $prodi = [
                        ['name' => 'Teknik Informatika', 'count' => 892, 'width' => '75%', 'color' => 'blue'],
                        ['name' => 'Sistem Informasi', 'count' => 654, 'width' => '55%', 'color' => 'green'],
                        ['name' => 'Teknik Elektro', 'count' => 721, 'width' => '60%', 'color' => 'purple'],
                        ['name' => 'Teknik Mesin', 'count' => 580, 'width' => '48%', 'color' => 'orange'],
                    ];
                @endphp
                
                @foreach($prodi as $item)
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">{{ $item['name'] }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $item['count'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-{{ $item['color'] }}-600 h-2 rounded-full" style="width: {{ $item['width'] }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Chart Card 2 - KRS Status -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">KRS Status</h3>
            <div class="flex items-center justify-center h-64">
                <div class="text-center">
                    <div class="text-5xl font-bold text-blue-600 mb-2">74%</div>
                    <p class="text-gray-600 mb-4">Mahasiswa Sudah KRS</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center gap-2 justify-center">
                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                            <span class="text-gray-700">Sudah KRS: 2,100</span>
                        </div>
                        <div class="flex items-center gap-2 justify-center">
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                            <span class="text-gray-700">Belum KRS: 747</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Waktu</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Aktivitas</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">User</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $activities = [
                            ['time' => '10:30 AM', 'activity' => 'Mahasiswa baru terdaftar', 'user' => 'Siti Nurhaliza', 'status' => 'success'],
                            ['time' => '10:15 AM', 'activity' => 'Pengajuan KRS', 'user' => 'Andi Pratama', 'status' => 'pending'],
                            ['time' => '09:45 AM', 'activity' => 'Input nilai mahasiswa', 'user' => 'Dr. Ahmad Wijaya', 'status' => 'success'],
                            ['time' => '09:30 AM', 'activity' => 'Update jadwal kuliah', 'user' => 'Admin Akademik', 'status' => 'success'],
                        ];
                    @endphp
                    
                    @foreach($activities as $activity)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $activity['time'] }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $activity['activity'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $activity['user'] }}</td>
                            <td class="px-6 py-4">
                                @if($activity['status'] === 'success')
                                    <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                        Berhasil
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded-full">
                                        Pending
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
