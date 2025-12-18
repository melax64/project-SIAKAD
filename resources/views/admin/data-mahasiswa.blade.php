@extends('layouts.admin')

@section('title', 'Data Mahasiswa - SIAKAD')

@section('main-content')
    <div x-data="{ modalOpen: false, searchQuery: '', selectedProdi: 'all' }" class="space-y-6">
        <!-- Page Title -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Data Mahasiswa</h1>
            <p class="text-gray-600">Kelola data mahasiswa universitas</p>
        </div>

        <!-- Filters and Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1 relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                    <input type="text" x-model="searchQuery" placeholder="Cari berdasarkan NIM atau nama..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Filter by Prodi -->
                <select x-model="selectedProdi"
                    class="w-full md:w-64 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="all">Semua Prodi</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknologi Rekayasa Komputer Jaringan">Teknologi Rekayasa Komputer Jaringan</option>
                    <option value="Teknologi Rekayasa Multimedia">Teknologi Rekayasa Multimedia</option>
                </select>

                <!-- Add Button -->
                <button @click="modalOpen = true"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Tambah Mahasiswa
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">NIM</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Program Studi</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Semester</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @php
                            $mahasiswa = [
                                [
                                    'nim' => '2021001',
                                    'nama' => 'Budi Santoso',
                                    'prodi' => 'Teknik Informatika',
                                    'semester' => 6,
                                ],
                                [
                                    'nim' => '2021002',
                                    'nama' => 'Siti Nurhaliza',
                                    'prodi' => 'Sistem Informasi',
                                    'semester' => 6,
                                ],
                                [
                                    'nim' => '2021003',
                                    'nama' => 'Andi Pratama',
                                    'prodi' => 'Teknik Informatika',
                                    'semester' => 5,
                                ],
                                [
                                    'nim' => '2022004',
                                    'nama' => 'Dewi Lestari',
                                    'prodi' => 'Teknik Elektro',
                                    'semester' => 4,
                                ],
                                [
                                    'nim' => '2022005',
                                    'nama' => 'Rizky Firmansyah',
                                    'prodi' => 'Teknik Mesin',
                                    'semester' => 4,
                                ],
                                [
                                    'nim' => '2023006',
                                    'nama' => 'Maya Putri',
                                    'prodi' => 'Sistem Informasi',
                                    'semester' => 2,
                                ],
                            ];
                        @endphp

                        @foreach ($mahasiswa as $mhs)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $mhs['nim'] }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $mhs['nama'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $mhs['prodi'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Semester {{ $mhs['semester'] }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <button class="p-2 hover:bg-blue-50 rounded-lg transition-colors">
                                            <i data-lucide="edit-2" class="w-4 h-4 text-blue-600"></i>
                                        </button>
                                        <button class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                <p class="text-sm text-gray-600">
                    Menampilkan 1-6 dari 2,847 mahasiswa
                </p>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50"
                        disabled>
                        Previous
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium">1</button>
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Mahasiswa -->
        <div x-show="modalOpen" x-cloak @click.away="modalOpen = false"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
            <div @click.stop class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-900">Tambah Mahasiswa Baru</h3>
                    <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-600">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mb-6">Masukkan data mahasiswa baru ke sistem</p>

                <form action="{{ route('admin.mahasiswa.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                        <input type="text" id="nim" name="nim" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan NIM">
                    </div>
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan nama lengkap">
                    </div>
                    <div>
                        <label for="prodi" class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                        <select id="prodi" name="prodi" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih program studi</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknologi Rekayasa Komputer Jaringan">Teknologi Rekayasa Komputer Jaringan
                            </option>
                            <option value="Teknologi Rekayasa Multimedia">Teknologi Rekayasa Multimedia</option>
                        </select>
                    </div>
                    <div>
                        <label for="angkatan" class="block text-sm font-medium text-gray-700 mb-2">Angkatan</label>
                        <select id="angkatan" name="angkatan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih angkatan</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                        </select>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan email">
                    </div>
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                        <input type="number" id="semester" name="semester" required min="1" max="14"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan semester">
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button type="button" @click="modalOpen = false"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
