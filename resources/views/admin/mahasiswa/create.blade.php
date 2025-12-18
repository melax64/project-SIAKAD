@extends('layouts.admin')

@section('title', 'Tambah Mahasiswa - SIAKAD')

@section('main-content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Input Data Mahasiswa Baru</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Nama Lengkap</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-8">
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

            <form action="{{ route('admin.mahasiswa.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                        placeholder="Contoh: Maila Aziza" required>
                    @error('name')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- NIM -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        NIM (Akan menjadi Password Default) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nim" value="{{ old('nim') }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('nim') border-red-500 @enderror"
                        placeholder="202xxxx..." required>
                    @error('nim')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Email (Untuk Login) <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                        placeholder="nama@student.ac.id" required>
                    @error('email')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Program Studi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Program Studi <span class="text-red-500">*</span>
                    </label>
                    <select name="prodi"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('prodi') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Program Studi</option>
                        <option value="Teknik Informatika" {{ old('prodi') === 'Teknik Informatika' ? 'selected' : '' }}>
                            Teknik Informatika</option>
                        <option value="Teknologi Rekayasa Komputer Jaringan"
                            {{ old('prodi') === 'Teknologi Rekayasa Komputer Jaringan' ? 'selected' : '' }}>Teknologi
                            Rekayasa Komputer Jaringan</option>
                        <option value="Teknologi Rekayasa Multimedia"
                            {{ old('prodi') === 'Teknologi Rekayasa Multimedia' ? 'selected' : '' }}>Teknologi Rekayasa
                            Multimedia</option>
                    </select>
                    @error('prodi')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Angkatan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Angkatan <span class="text-red-500">*</span>
                    </label>
                    <select name="angkatan"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('angkatan') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Angkatan</option>
                        <option value="2025" {{ old('angkatan') === '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2024" {{ old('angkatan') === '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2023" {{ old('angkatan') === '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2022" {{ old('angkatan') === '2022' ? 'selected' : '' }}>2022</option>
                        <option value="2021" {{ old('angkatan') === '2021' ? 'selected' : '' }}>2021</option>
                        <option value="2020" {{ old('angkatan') === '2020' ? 'selected' : '' }}>2020</option>
                    </select>
                    @error('angkatan')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-slate-700">
                    <button type="submit"
                        class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors shadow-md flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Simpan Data
                    </button>
                    <a href="{{ route('admin.mahasiswa') }}"
                        class="px-8 py-3 bg-gray-300 hover:bg-gray-400 dark:bg-slate-600 dark:hover:bg-slate-700 text-gray-800 dark:text-white rounded-lg font-medium transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
            <p class="text-blue-800 dark:text-blue-200 text-sm">
                <i data-lucide="info" class="w-4 h-4 inline mr-2"></i>
                <strong>Catatan:</strong> Password default mahasiswa adalah NIM-nya. Mahasiswa dapat mengubah password
                setelah login pertama kali.
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection
