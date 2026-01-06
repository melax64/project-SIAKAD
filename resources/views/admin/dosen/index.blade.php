@extends('layouts.admin')

@section('title', 'Data Dosen')

@section('main-content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Data Dosen</h2>

            {{-- Tombol Tambah Data --}}
            <a href="{{ route('admin.dosen.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition">
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
                        <th class="px-6 py-3">Nama Lengkap</th>
                        <th class="px-6 py-3">NIP</th>
                        <th class="px-6 py-3">Jabatan</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Mata Kuliah yang Diampu</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosens as $dsn)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $dsn->user->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4">{{ $dsn->nip }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ $dsn->jabatan }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $dsn->user->email ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if ($dsn->mataKuliah && count($dsn->mataKuliah) > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($dsn->mataKuliah as $mk)
                                            <span
                                                class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                {{ $mk->mata_kuliah ?? '-' }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('admin.dosen.edit', $dsn->id) }}"
                                    class="text-blue-600 hover:text-blue-900 font-medium">Edit</a>
                                <form action="{{ route('admin.dosen.destroy', $dsn->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus dosen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
