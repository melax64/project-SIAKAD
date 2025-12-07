@extends('layouts.admin')

@section('title', 'Data Mahasiswa')

@section('main-content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-800">Data Mahasiswa</h2>
        
        {{-- Tombol Tambah Data --}}
        <a href="{{ route('admin.mahasiswa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
            + Tambah Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Nama Lengkap</th>
                    <th class="px-6 py-3">NIM</th>
                    <th class="px-6 py-3">Prodi</th>
                    <th class="px-6 py-3">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswas as $mhs)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{-- Mengambil nama dari tabel users lewat relasi --}}
                        {{ $mhs->user->name ?? '-' }}
                    </td>
                    <td class="px-6 py-4">{{ $mhs->nim }}</td>
                    <td class="px-6 py-4">{{ $mhs->prodi }}</td>
                    <td class="px-6 py-4">{{ $mhs->user->email ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection