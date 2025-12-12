@extends('layouts.dosen')

@section('main-content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Profil Dosen</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Kelola data pribadi dan informasi akademik Anda</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form action="{{ route('dosen.profil.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Data Pribadi Section -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Data Pribadi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama
                                Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan nama lengkap" required>
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan email" required>
                            @error('email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Data Akademik Section -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Data Akademik</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- NIP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIP</label>
                            <input type="text" value="{{ $dosen->nip ?? '-' }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg bg-gray-100 dark:bg-gray-600 cursor-not-allowed"
                                disabled>
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jabatan</label>
                            <input type="text" name="jabatan" value="{{ $dosen->jabatan ?? '-' }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan jabatan (Dosen Tetap, Dosen Kontrak, dll)">
                            @error('jabatan')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Ubah Password</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Password Baru -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Baru
                                (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" name="password"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan password baru">
                            @error('password')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi
                                Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Konfirmasi password baru">
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                        <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>Simpan Perubahan
                    </button>
                    <a href="{{ route('dosen.dashboard') }}"
                        class="px-6 py-2 bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-700 text-gray-800 dark:text-white rounded-lg font-medium transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
            <p class="text-sm text-blue-800 dark:text-blue-200">
                <i data-lucide="info" class="w-4 h-4 inline mr-2"></i>
                NIP tidak dapat diubah. Hubungi administrator jika ada kesalahan pada data.
            </p>
        </div>
    </div>
@endsection
