@extends('layouts.mahasiswa')

@section('main-content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Profil Saya</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Informasi data pribadi dan akademik Anda</p>
        </div>

        <!-- Main Profile Card -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Avatar & Basic Info -->
            <div class="lg:col-span-1">
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                    <!-- Avatar -->
                    <div class="text-center mb-6">
                        <div
                            class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-4xl font-bold text-white">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-4">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $user->email }}</p>
                    </div>

                    <!-- Quick Status -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-slate-700">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Status</span>
                            <span
                                class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-semibold rounded-full">Aktif</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-slate-700">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Role</span>
                            <span
                                class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-semibold rounded-full">Mahasiswa</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Terdaftar</span>
                            <span
                                class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Detailed Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Data Akademik -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i data-lucide="book-open" class="w-5 h-5 mr-2 text-blue-600"></i>
                        Data Akademik
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NIM -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">NIM</label>
                            <div
                                class="px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg">
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $mahasiswa->nim ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Program Studi -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Program
                                Studi</label>
                            <div
                                class="px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg">
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $mahasiswa->prodi ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Angkatan -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Angkatan</label>
                            <div
                                class="px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg">
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $mahasiswa->angkatan ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Tahun Akademik -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Tahun
                                Akademik</label>
                            <div
                                class="px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg">
                                <p class="text-gray-900 dark:text-white font-semibold">2024/2025</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Pribadi -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i data-lucide="user" class="w-5 h-5 mr-2 text-green-600"></i>
                        Data Pribadi
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Nama
                                Lengkap</label>
                            <div
                                class="px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg">
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $user->name }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Email</label>
                            <div
                                class="px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg">
                                <p class="text-gray-900 dark:text-white font-semibold text-sm break-all">{{ $user->email }}
                                </p>
                            </div>
                        </div>

                        <!-- Tanggal Daftar -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Tanggal
                                Daftar</label>
                            <div
                                class="px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg">
                                <p class="text-gray-900 dark:text-white font-semibold">
                                    {{ $user->created_at->format('d F Y') }}</p>
                            </div>
                        </div>

                        <!-- Updated At -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Update
                                Terakhir</label>
                            <div
                                class="px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-lg">
                                <p class="text-gray-900 dark:text-white font-semibold">
                                    {{ $user->updated_at->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total SKS -->
            <div
                class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl shadow-lg border border-blue-200 dark:border-blue-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-semibold text-blue-900 dark:text-blue-300">Total SKS</h4>
                    <div class="bg-blue-500/20 p-3 rounded-lg">
                        <i data-lucide="zap" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-blue-900 dark:text-blue-300">110</p>
                <p class="text-xs text-blue-700 dark:text-blue-400 mt-2">Total SKS yang harus ditempuh</p>
            </div>

            <!-- SKS Terselesaikan -->
            <div
                class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl shadow-lg border border-green-200 dark:border-green-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-semibold text-green-900 dark:text-green-300">SKS Terselesaikan</h4>
                    <div class="bg-green-500/20 p-3 rounded-lg">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-green-900 dark:text-green-300">45</p>
                <p class="text-xs text-green-700 dark:text-green-400 mt-2">41% dari total SKS</p>
            </div>

            <!-- IPK -->
            <div
                class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-xl shadow-lg border border-purple-200 dark:border-purple-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-semibold text-purple-900 dark:text-purple-300">IPK Kumulatif</h4>
                    <div class="bg-purple-500/20 p-3 rounded-lg">
                        <i data-lucide="award" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-purple-900 dark:text-purple-300">3.76</p>
                <p class="text-xs text-purple-700 dark:text-purple-400 mt-2">Prestasi akademik Anda</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i data-lucide="settings" class="w-5 h-5 mr-2 text-orange-600"></i>
                Aksi
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('mahasiswa.profil.edit') }}"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors shadow-md flex items-center justify-center gap-2">
                    <i data-lucide="edit" class="w-4 h-4"></i>
                    Edit Profil
                </a>
                <button
                    class="px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition-colors shadow-md flex items-center justify-center gap-2">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    Ubah Password
                </button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
