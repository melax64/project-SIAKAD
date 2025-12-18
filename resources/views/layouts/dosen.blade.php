@extends('layouts.base')

@section('content')
    <div x-data="{ sidebarOpen: true }" class="min-h-screen bg-gray-100 dark:bg-slate-900">
        <!-- Header -->
        @include('components.header', [
            'userName' => Auth::user()->name ?? 'Dosen',
            'userRole' => 'Dosen',
        ])

        <div class="flex">
            <!-- Sidebar -->
            @include('components.sidebar', [
                'menuItems' => [
                    [
                        'id' => 'dashboard',
                        'label' => 'Dashboard',
                        'icon' => 'layout-dashboard',
                        'route' => 'dosen.dashboard',
                    ],
                    [
                        'id' => 'jadwal-mengajar',
                        'label' => 'Jadwal Mengajar',
                        'icon' => 'calendar',
                        'route' => 'dosen.jadwal',
                    ],
                    [
                        'id' => 'input-nilai',
                        'label' => 'Input Nilai',
                        'icon' => 'file-spreadsheet',
                        'route' => 'dosen.nilai',
                    ],
                    [
                        'id' => 'daftar-kelas',
                        'label' => 'Daftar Kelas',
                        'icon' => 'users',
                        'route' => 'dosen.kelas',
                    ],
                    ['id' => 'profil', 'label' => 'Profil', 'icon' => 'user', 'route' => 'dosen.profil'],
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
