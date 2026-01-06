@extends('layouts.admin')

@section('title', 'Edit Mata Kuliah')

@section('main-content')
    <div
        class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Mata Kuliah</h2>
            <p class="text-gray-500 text-sm">Ubah informasi mata kuliah</p>
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

        <form action="{{ route('admin.matakuliah.update', $mataKuliah->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Kode Mata Kuliah <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="kode_matakuliah"
                        class="w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-2"
                        value="{{ $mataKuliah->kode_matakuliah }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Mata Kuliah <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama_matakuliah"
                        class="w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-2"
                        value="{{ $mataKuliah->nama_matakuliah }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">SKS <span
                            class="text-red-500">*</span></label>
                    <select name="sks"
                        class="w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-2"
                        required>
                        <option value="">-- Pilih SKS --</option>
                        <option value="1" {{ $mataKuliah->sks == '1' ? 'selected' : '' }}>1 SKS</option>
                        <option value="2" {{ $mataKuliah->sks == '2' ? 'selected' : '' }}>2 SKS</option>
                        <option value="3" {{ $mataKuliah->sks == '3' ? 'selected' : '' }}>3 SKS</option>
                        <option value="4" {{ $mataKuliah->sks == '4' ? 'selected' : '' }}>4 SKS</option>
                        <option value="6" {{ $mataKuliah->sks == '6' ? 'selected' : '' }}>6 SKS</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-2">{{ $mataKuliah->deskripsi }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.matakuliah.index') }}"
                    class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
