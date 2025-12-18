@extends('layouts.mahasiswa')

@section('main-content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Profil</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Perbarui informasi pribadi Anda</p>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6 md:p-8">
            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                    <p class="text-red-800 dark:text-red-200 font-semibold mb-2">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside text-red-700 dark:text-red-300 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
                    <p class="text-green-800 dark:text-green-200">
                        <i data-lucide="check-circle" class="w-4 h-4 inline mr-2"></i>
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <form action="{{ route('mahasiswa.profil.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                        placeholder="Masukkan nama lengkap" required>
                    @error('name')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email <span
                            class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                        placeholder="Masukkan email" required>
                    @error('email')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Data Akademik (Read-only) -->
                <div class="border-t border-gray-200 dark:border-slate-700 pt-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Data Akademik (Tidak dapat diubah)
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NIM -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">NIM</label>
                            <input type="text" value="{{ $mahasiswa->nim ?? '-' }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg bg-gray-100 dark:bg-slate-900 cursor-not-allowed"
                                disabled>
                        </div>

                        <!-- Program Studi -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Program
                                Studi</label>
                            <input type="text" value="{{ $mahasiswa->prodi ?? '-' }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg bg-gray-100 dark:bg-slate-900 cursor-not-allowed"
                                disabled>
                        </div>

                        <!-- Angkatan -->
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Angkatan</label>
                            <input type="text" value="{{ $mahasiswa->angkatan ?? '-' }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg bg-gray-100 dark:bg-slate-900 cursor-not-allowed"
                                disabled>
                        </div>

                        <!-- Tanggal Daftar -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tanggal
                                Daftar</label>
                            <input type="text" value="{{ $user->created_at->format('d F Y') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg bg-gray-100 dark:bg-slate-900 cursor-not-allowed"
                                disabled>
                        </div>
                    </div>
                </div>

                <!-- Button Actions -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors shadow-md flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('mahasiswa.profil') }}"
                        class="px-6 py-3 bg-gray-300 hover:bg-gray-400 dark:bg-slate-600 dark:hover:bg-slate-700 text-gray-800 dark:text-white rounded-lg font-medium transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
            <p class="text-blue-800 dark:text-blue-200 text-sm">
                <i data-lucide="info" class="w-4 h-4 inline mr-2"></i>
                Data akademik seperti NIM, Program Studi, dan Angkatan tidak dapat diubah. Hubungi admin jika ada perubahan.
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
