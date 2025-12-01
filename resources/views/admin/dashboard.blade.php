@extends('layouts.admin')

@section('title', 'Dashboard Admin - SIAKAD')

@section('main-content')
<div class="space-y-8">

    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Admin</h1>
        <p class="text-gray-600">Selamat datang di Sistem Informasi Akademik</p>
    </div>

    <!-- Statistik -->
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
            'trend' => 'Semester Genap 2024'
        ])

        @include('components.stat-card', [
            'title' => 'Jadwal Aktif',
            'value' => '234',
            'icon' => 'calendar',
            'color' => 'orange',
            'trend' => 'Minggu ini'
        ])
    </div>

    <!-- Chart Mahasiswa Per Prodi -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Mahasiswa Per Prodi</h3>

        @php
            $prodi = [
                ['name' => 'Teknik Informatika', 'count' => 892, 'width' => 75, 'color' => 'blue'],
                ['name' => 'Sistem Informasi', 'count' => 654, 'width' => 55, 'color' => 'green'],
                ['name' => 'Teknik Elektro', 'count' => 721, 'width' => 60, 'color' => 'purple'],
                ['name' => 'Teknik Mesin', 'count' => 580, 'width' => 48, 'color' => 'orange'],
            ];
        @endphp

        <div class="space-y-4">
            @foreach($prodi as $item)

                @php
                    $colorClass = [
                        'blue' => 'bg-blue-600',
                        'green' => 'bg-green-600',
                        'purple' => 'bg-purple-600',
                        'orange' => 'bg-orange-600',
                    ][$item['color']];
                @endphp

                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm text-gray-600">{{ $item['name'] }}</span>
                        <span class="text-sm font-medium text-gray-900">{{ $item['count'] }}</span>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="h-2 rounded-full {{ $colorClass }}"
                             style="width: {{ $item['width'] }}%;">
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

</div>
@endsection
