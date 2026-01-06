@extends('layouts.admin')

@section('title', 'Edit Dosen')

@section('main-content')
    <div
        class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Data Dosen</h2>
            <p class="text-gray-500 text-sm">Update informasi dosen dan mata kuliah yang diampu.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $dosen->user->name) }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Contoh: Dr. Budi Santoso, M.Kom" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">NIP (Nomor Induk Pegawai)</label>
                    <input type="text" name="nip" value="{{ old('nip', $dosen->nip) }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="1980xxxx..." required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email (Untuk Login)</label>
                    <input type="email" name="email" value="{{ old('email', $dosen->user->email) }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Jabatan</label>
                    <select name="jabatan"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="Dosen Tetap" {{ $dosen->jabatan == 'Dosen Tetap' ? 'selected' : '' }}>Dosen Tetap</option>
                        <option value="Dosen Tidak Tetap" {{ $dosen->jabatan == 'Dosen Tidak Tetap' ? 'selected' : '' }}>Dosen Tidak Tetap</option>
                    </select>
                </div>

                <div class="border-t pt-4 mt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Mata Kuliah yang Dipegang</h3>

                    @if($mataKuliahs->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($mataKuliahs as $mk)
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200 cursor-pointer hover:bg-gray-100 transition">
                                    <input type="checkbox" name="mata_kuliah_ids[]" value="{{ $mk->id }}" 
                                        {{ in_array($mk->id, $selectedMataKuliahIds) ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 rounded">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-700">{{ $mk->kode_matakuliah }}</p>
                                        <p class="text-sm text-gray-500">{{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Belum ada mata kuliah tersedia. Silakan tambahkan mata kuliah terlebih dahulu.</p>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    Update Data
                </button>
                <a href="{{ route('admin.dosen') }}"
                    class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
