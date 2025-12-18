@extends('layouts.base')

@section('content')
    <div x-data="{ sidebarOpen: true }" class="min-h-screen bg-gray-100 dark:bg-slate-950">
        <!-- Header -->
        @include('components.header', [
            'userName' => Auth::user()->name ?? 'Mahasiswa',
            'userRole' => 'Mahasiswa',
        ])

        <div class="flex">
            <!-- Sidebar -->
            @include('components.sidebar', [
                'menuItems' => [
                    [
                        'id' => 'dashboard',
                        'label' => 'Dashboard',
                        'icon' => 'layout-dashboard',
                        'route' => 'mahasiswa.dashboard',
                    ],
                    ['id' => 'isi-krs', 'label' => 'Isi KRS', 'icon' => 'file-edit', 'route' => 'mahasiswa.krs'],
                    [
                        'id' => 'jadwal-kuliah',
                        'label' => 'Jadwal Kuliah',
                        'icon' => 'calendar',
                        'route' => 'mahasiswa.jadwal',
                    ],
                    ['id' => 'nilai', 'label' => 'Nilai', 'icon' => 'award', 'route' => 'mahasiswa.nilai'],
                    ['id' => 'profil', 'label' => 'Profil', 'icon' => 'user', 'route' => 'mahasiswa.profil'],
                ],
                'activePage' => $activePage ?? 'dashboard',
            ])

            <!-- Main Content -->
            <main class="flex-1 p-8 ml-64">
                @yield('main-content')
            </main>
        </div>
    </div>
@endsection
