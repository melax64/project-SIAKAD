@extends('layouts.mahasiswa')

@section('title', 'Isi KRS - SIAKAD')

@section('main-content')
<div x-data="{
    selectedCourses: [1, 2, 3, 4],
    courses: [
        { id: 1, kode: 'TIF601', nama: 'Pemrograman Web Lanjut', sks: 3, dosen: 'Dr. Ahmad Wijaya', waktu: 'Senin, 08:00-10:00' },
        { id: 2, kode: 'TIF602', nama: 'Basis Data Lanjut', sks: 3, dosen: 'Prof. Siti Rahman', waktu: 'Selasa, 10:00-12:00' },
        { id: 3, kode: 'TIF603', nama: 'Keamanan Siber', sks: 3, dosen: 'Dr. Budi Hartono', waktu: 'Rabu, 13:00-15:00' },
        { id: 4, kode: 'TIF604', nama: 'Kecerdasan Buatan', sks: 3, dosen: 'Dr. Maya Putri', waktu: 'Kamis, 08:00-10:00' },
        { id: 5, kode: 'TIF605', nama: 'Rekayasa Perangkat Lunak', sks: 4, dosen: 'Dr. Rizki Firmansyah', waktu: 'Jumat, 10:00-13:00' },
        { id: 6, kode: 'TIF606', nama: 'Jaringan Komputer', sks: 3, dosen: 'Dr. Dewi Lestari', waktu: 'Senin, 13:00-15:00' },
        { id: 7, kode: 'TIF607', nama: 'Pemrograman Mobile', sks: 3, dosen: 'Dr. Andi Pratama', waktu: 'Selasa, 15:00-17:00' },
        { id: 8, kode: 'TIF608', nama: 'Sistem Terdistribusi', sks: 2, dosen: 'Prof. Linda Susanti', waktu: 'Rabu, 08:00-10:00' }
    ],
    maxSKS: 24,
    get totalSKS() {
        return this.courses
            .filter(c => this.selectedCourses.includes(c.id))
            .reduce((sum, c) => sum + c.sks, 0);
    },
    get isOverLimit() {
        return this.totalSKS > this.maxSKS;
    },
    toggleCourse(id) {
        if (this.selectedCourses.includes(id)) {
            this.selectedCourses = this.selectedCourses.filter(cid => cid !== id);
        } else {
            this.selectedCourses.push(id);
        }
    }
}" class="space-y-6">
    
    <!-- Page Title -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Isi Kartu Rencana Studi (KRS)</h1>
        <p class="text-gray-600">Pilih mata kuliah untuk semester genap 2024/2025</p>
    </div>

    <!-- Alert -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex gap-3">
        <i data-lucide="alert-circle" class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5"></i>
        <div>
            <p class="font-semibold text-blue-900 mb-1">Periode Pengisian KRS</p>
            <p class="text-sm text-blue-700">
                Pengisian KRS dibuka hingga 20 Januari 2025. Pastikan Anda menyimpan perubahan sebelum batas waktu.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Course List -->
        <div class="lg:col-span-2 space-y-4">
            <template x-for="course in courses" :key="course.id">
                <div :class="selectedCourses.includes(course.id) ? 'border-blue-500 shadow-md' : 'border-gray-200 hover:border-gray-300'"
                     class="bg-white rounded-xl p-6 border-2 transition-all">
                    <div class="flex items-start gap-4">
                        <input type="checkbox" 
                               :checked="selectedCourses.includes(course.id)"
                               @change="toggleCourse(course.id)"
                               class="mt-1 w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <label class="text-base font-semibold text-gray-900 cursor-pointer block mb-1" 
                                           x-text="course.nama"></label>
                                    <p class="text-sm text-gray-600" x-text="course.kode"></p>
                                </div>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium whitespace-nowrap ml-2"
                                      x-text="course.sks + ' SKS'"></span>
                            </div>
                            <div class="flex items-center gap-4 text-sm text-gray-600">
                                <span>👨‍🏫 <span x-text="course.dosen"></span></span>
                                <span>🕐 <span x-text="course.waktu"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Summary Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 sticky top-24">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Ringkasan KRS</h3>
                </div>
                <div class="p-6 space-y-6">
                    <!-- SKS Counter -->
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">Total SKS</span>
                            <span class="text-sm font-semibold"
                                  :class="isOverLimit ? 'text-red-600' : 'text-gray-900'"
                                  x-text="totalSKS + ' / ' + maxSKS"></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div :class="isOverLimit ? 'bg-red-600' : 'bg-blue-600'"
                                 class="h-3 rounded-full transition-all"
                                 :style="'width: ' + Math.min((totalSKS / maxSKS) * 100, 100) + '%'"></div>
                        </div>
                        <p x-show="isOverLimit" class="text-sm text-red-600 mt-2">
                            ⚠️ SKS melebihi batas maksimal!
                        </p>
                    </div>

                    <!-- Stats -->
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Mata Kuliah Dipilih</span>
                            <span class="font-medium text-gray-900" x-text="selectedCourses.length"></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">IPK Semester Lalu</span>
                            <span class="font-medium text-gray-900">3.76</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Maks. SKS Diizinkan</span>
                            <span class="font-medium text-gray-900" x-text="maxSKS + ' SKS'"></span>
                        </div>
                    </div>

                    <!-- Success Message -->
                    <div x-show="!isOverLimit && selectedCourses.length > 0" 
                         class="bg-green-50 border border-green-200 rounded-lg p-3 flex gap-2">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-600 flex-shrink-0"></i>
                        <p class="text-sm text-green-700">KRS Anda sudah sesuai</p>
                    </div>

                    <!-- Submit Button -->
                    <form action="{{ route('mahasiswa.krs.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="courses" :value="JSON.stringify(selectedCourses)">
                        <button type="submit"
                                :disabled="isOverLimit || selectedCourses.length === 0"
                                class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            Simpan KRS
                        </button>
                    </form>

                    <a href="{{ route('mahasiswa.dashboard') }}" 
                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors text-center">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
