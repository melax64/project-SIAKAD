@extends('layouts.admin')

@section('title', 'Data Mata Kuliah')

@section('main-content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Data Mata Kuliah</h2>

            {{-- Tombol Tambah Data --}}
            <a href="{{ route('admin.matakuliah.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                + Tambah Baru
            </a>
        </div>

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="m-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Kode</th>
                        <th class="px-6 py-3">Nama Mata Kuliah</th>
                        <th class="px-6 py-3">SKS</th>
                        <th class="px-6 py-3">Deskripsi</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mataKuliahs as $mk)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $mk->kode_matakuliah }}</td>
                            <td class="px-6 py-4">{{ $mk->nama_matakuliah }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $mk->sks }} SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ Str::limit($mk->deskripsi, 50) ?? '-' }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('admin.matakuliah.edit', $mk->id) }}"
                                    class="text-blue-600 hover:text-blue-900 font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('admin.matakuliah.destroy', $mk->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b">
                            <td colspan="5" class="px-6 py-4 text-center text-gray-600">
                                Belum ada data mata kuliah
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($mataKuliahs->hasPages())
            <div class="p-6 border-t border-gray-200">
                {{ $mataKuliahs->links() }}
            </div>
        @endif
    </div>
@endsection
