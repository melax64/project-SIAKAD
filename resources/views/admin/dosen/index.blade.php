@extends('layouts.admin')

@section('title', 'Data Dosen')

@section('main-content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-800">Data Dosen</h2>
        
        {{-- Tombol Tambah Data --}}
        <a href="{{ route('admin.dosen.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition">
            + Tambah Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Nama Lengkap</th>
                    <th class="px-6 py-3">NIP</th>
                    <th class="px-6 py-3">Jabatan</th>
                    <th class="px-6 py-3">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dosens as $dsn)
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection