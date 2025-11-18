@extends('layouts.dosen')

@section('title', 'Input Nilai - SIAKAD')

@section('main-content')
<div x-data="{
    selectedMatkul: '{{ old('mata_kuliah', '') }}',
    saved: false,
    mahasiswa: [
        { id: 1, nim: '2021001', nama: 'Budi Santoso', nilai: 85 },
        { id: 2, nim: '2021002', nama: 'Siti Nurhaliza', nilai: 92 },
        { id: 3, nim: '2021003', nama: 'Andi Pratama', nilai: 78 },
        { id: 4, nim: '2021004', nama: 'Dewi Lestari', nilai: 88 },
        { id: 5, nim: '2021005', nama: 'Rizky Firmansyah', nilai: 75 },
        { id: 6, nim: '2021006', nama: 'Maya Putri', nilai: 90 },
        { id: 7, nim: '2021007', nama: 'Rudi Hartono', nilai: 82 },
        { id: 8, nim: '2021008', nama: 'Linda Susanti', nilai: 87 }
    ],
    getGrade(nilai) {
        if (nilai >= 85) return 'A';
        if (nilai >= 75) return 'B';
        if (nilai >= 65) return 'C';
        if (nilai >= 55) return 'D';
        return 'E';
    },
    getGradeColor(grade) {
        if (grade === 'A') return 'bg-green-100 text-green-700';
        if (grade === 'B') return 'bg-blue-100 text-blue-700';
        if (grade === 'C') return 'bg-yellow-100 text-yellow-700';
        return 'bg-red-100 text-red-700';
    },
    countGrade(grade) {
        return this.mahasiswa.filter(m => this.getGrade(m.nilai) === grade).length;
    },
    getAverage() {
        const sum = this.mahasiswa.reduce((acc, m) => acc + m.nilai, 0);
        return (sum / this.mahasiswa.length).toFixed(2);
    }
}" class="space-y-6">
    
    <!-- Page Title -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Input Nilai Mahasiswa</h1>
        <p class="text-gray-600">Masukkan nilai untuk mata kuliah yang Anda ampu</p>
    </div>

    <!-- Select Mata Kuliah -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <label for="mata-kuliah" class="block text-sm font-medium text-gray-700 mb-3">
            Pilih Mata Kuliah
        </label>
        <select x-model="selectedMatkul" id="mata-kuliah"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="">Pilih mata kuliah...</option>
            <option value="pweb">Pemrograman Web - TIF-6A</option>
            <option value="pweb-b">Pemrograman Web - TIF-6B</option>
            <option value="bd">Basis Data - TIF-4A</option>
            <option value="si">Sistem Informasi - SI-4A</option>
            <option value="rpl">Rekayasa Perangkat Lunak - TIF-6A</option>
        </select>
    </div>

    <!-- Success Message -->
    <div x-show="saved" x-cloak
         class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center gap-3">
        <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
        <p class="text-green-700 font-medium">Nilai berhasil disimpan!</p>
    </div>

    <!-- Table -->
    <form x-show="selectedMatkul" @submit.prevent="saved = true; setTimeout(() => saved = false, 3000)"
          action="{{ route('dosen.nilai.submit') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="mata_kuliah" :value="selectedMatkul">
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Mahasiswa</h3>
                <p class="text-sm text-gray-600" x-text="'Total: ' + mahasiswa.length + ' mahasiswa'"></p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">No</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">NIM</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Nama Mahasiswa</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Nilai Angka</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Nilai Huruf</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <template x-for="(mhs, index) in mahasiswa" :key="mhs.id">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-600" x-text="index + 1"></td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900" x-text="mhs.nim"></td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900" x-text="mhs.nama"></td>
                                <td class="px-6 py-4">
                                    <input type="number" 
                                           :name="'nilai[' + mhs.id + ']'"
                                           x-model="mhs.nilai"
                                           min="0" max="100"
                                           class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium"
                                          :class="getGradeColor(getGrade(mhs.nilai))"
                                          x-text="getGrade(mhs.nilai)"></span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div class="p-6 border-t border-gray-200 bg-gray-50">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-1">Nilai A</p>
                        <p class="text-lg font-bold text-gray-900" x-text="countGrade('A')"></p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-1">Nilai B</p>
                        <p class="text-lg font-bold text-gray-900" x-text="countGrade('B')"></p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-1">Nilai C</p>
                        <p class="text-lg font-bold text-gray-900" x-text="countGrade('C')"></p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-1">Nilai D</p>
                        <p class="text-lg font-bold text-gray-900" x-text="countGrade('D')"></p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-1">Rata-rata</p>
                        <p class="text-lg font-bold text-gray-900" x-text="getAverage()"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Save Button -->
        <div x-show="selectedMatkul" class="sticky bottom-8 flex justify-end">
            <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-xl flex items-center gap-2">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Nilai
            </button>
        </div>
    </form>
</div>
@endsection
