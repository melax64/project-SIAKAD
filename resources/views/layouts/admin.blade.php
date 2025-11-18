@extends('layouts.app')

@section('content')
<div x-data="{ sidebarOpen: true }" class="min-h-screen bg-slate-50">
    <!-- Header -->
    @include('components.header', [
        'userName' => $userName ?? 'Admin Universitas',
        'userRole' => 'Administrator'
    ])
    
    <div class="flex">
        <!-- Sidebar -->
        @include('components.sidebar', [
            'menuItems' => [
                ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'layout-dashboard', 'route' => 'admin.dashboard'],
                ['id' => 'data-mahasiswa', 'label' => 'Data Mahasiswa', 'icon' => 'users', 'route' => 'admin.mahasiswa'],
                ['id' => 'data-dosen', 'label' => 'Data Dosen', 'icon' => 'graduation-cap', 'route' => 'admin.dosen'],
                ['id' => 'mata-kuliah', 'label' => 'Mata Kuliah', 'icon' => 'book-open', 'route' => 'admin.matakuliah'],
                ['id' => 'jadwal', 'label' => 'Jadwal', 'icon' => 'calendar', 'route' => 'admin.jadwal'],
                ['id' => 'krs-management', 'label' => 'KRS Management', 'icon' => 'file-text', 'route' => 'admin.krs'],
                ['id' => 'pengumuman', 'label' => 'Pengumuman', 'icon' => 'megaphone', 'route' => 'admin.pengumuman'],
                ['id' => 'settings', 'label' => 'Settings', 'icon' => 'settings', 'route' => 'admin.settings'],
            ],
            'activePage' => $activePage ?? 'dashboard'
        ])
        
        <!-- Main Content -->
        <main class="flex-1 p-8 ml-64">
            @yield('main-content')
        </main>
    </div>
</div>
@endsection
