@extends('layouts.dosen')

@section('main-content')

    <div class="space-y-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Input Nilai Mahasiswa</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Masukkan dan kelola nilai mahasiswa Anda</p>
        </div>

        <!-- Info Alert -->
        @if (session('success'))
            <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-4">
                <p class="text-green-800 dark:text-green-200">
                    <i data-lucide="check-circle" class="w-4 h-4 inline mr-2"></i>
                    {{ session('success') }}
                </p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <p class="text-red-800 dark:text-red-200 font-semibold mb-2">Terjadi kesalahan:</p>
                <ul class="list-disc list-inside text-red-700 dark:text-red-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Input Nilai -->
        <div
            class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6 md:p-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Cari dan Input Nilai Mahasiswa</h2>

            <form action="{{ route('dosen.nilai.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- NIM Mahasiswa -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">NIM Mahasiswa</label>
                    <div class="flex gap-2">
                        <input type="text" id="nim-input" name="nim"
                            class="flex-1 px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Masukkan NIM mahasiswa" required>
                        <button type="button" id="search-btn"
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors shadow-md">
                            <i data-lucide="search" class="w-4 h-4 inline mr-2"></i>Cari
                        </button>
                    </div>
                    @error('nim')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Info Mahasiswa (Hidden by default) -->
                <div id="mahasiswa-info"
                    class="hidden bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/40 dark:to-blue-800/40 border border-blue-300 dark:border-blue-700 rounded-lg p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-blue-600 dark:text-blue-400 font-semibold uppercase tracking-wide">Nama
                                Mahasiswa</p>
                            <p id="mahasiswa-name" class="text-lg font-bold text-gray-900 dark:text-white mt-1">-</p>
                        </div>
                        <div>
                            <p class="text-xs text-blue-600 dark:text-blue-400 font-semibold uppercase tracking-wide">NIM
                            </p>
                            <p id="mahasiswa-nim" class="text-lg font-bold text-gray-900 dark:text-white mt-1">-</p>
                        </div>
                    </div>
                </div>

                <!-- Nilai Section -->
                <div id="nilai-section" class="hidden space-y-6 pt-4 border-t border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Input Nilai</h3>

                    <!-- Hidden mahasiswa_id -->
                    <input type="hidden" id="mahasiswa-id" name="mahasiswa_id">

                    <!-- Mata Kuliah dan Tipe Kelas -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <!-- Nama Mata Kuliah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Mata Kuliah
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="mata_kuliah"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="Contoh: Pemrograman Web" required>
                        </div>

                        <!-- Tipe Kelas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipe Kelas <span
                                    class="text-red-500">*</span></label>
                            <select name="tipe_kelas"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                required>
                                <option value="">-- Pilih Tipe Kelas --</option>
                                <option value="teori">Teori</option>
                                <option value="praktikum">Praktikum</option>
                            </select>
                        </div>

                        <!-- SKS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">SKS <span
                                    class="text-red-500">*</span></label>
                            <select name="sks"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                required>
                                <option value="">-- Pilih SKS --</option>
                                <option value="1">1 SKS</option>
                                <option value="2">2 SKS</option>
                                <option value="3" selected>3 SKS</option>
                                <option value="4">4 SKS</option>
                                <option value="6">6 SKS</option>
                            </select>
                        </div>
                    </div>

                    <!-- Input Nilai -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Kehadiran -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kehadiran
                                (%)</label>
                            <input type="number" name="kehadiran" min="0" max="100" step="0.01"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="0 - 100">
                        </div>

                        <!-- Tugas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tugas</label>
                            <input type="number" name="tugas" min="0" max="100" step="0.01"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="0 - 100">
                        </div>

                        <!-- UTS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">UTS</label>
                            <input type="number" name="uts" min="0" max="100" step="0.01"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="0 - 100">
                        </div>

                        <!-- UAS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">UAS</label>
                            <input type="number" name="uas" min="0" max="100" step="0.01"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="0 - 100">
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan
                            (Opsional)</label>
                        <textarea name="catatan" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Masukkan catatan atau feedback untuk mahasiswa"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors shadow-md">
                            <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>Simpan Nilai
                        </button>
                        <button type="reset"
                            class="px-6 py-3 bg-gray-300 hover:bg-gray-400 dark:bg-slate-600 dark:hover:bg-slate-700 text-gray-800 dark:text-white rounded-lg font-medium transition-colors">
                            Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Daftar Nilai Terakhir -->
        @if (isset($nilaiList) && count($nilaiList) > 0)
            <div
                class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden">
                <div class="px-6 md:px-8 py-5 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-900">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Nilai yang Sudah Diinput</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    NIM</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Nama Mahasiswa</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Mata Kuliah</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Tipe</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Kehadiran</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Tugas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    UTS</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    UAS</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($nilaiList as $nilai)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $nilai->mahasiswa->nim ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $nilai->mahasiswa->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $nilai->mata_kuliah ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-medium {{ $nilai->tipe_kelas === 'teori' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300' : 'bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-300' }}">
                                            {{ $nilai->tipe_kelas === 'teori' ? 'Teori' : 'Praktikum' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $nilai->kehadiran ?? '-' }}%</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $nilai->tugas ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $nilai->uts ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $nilai->uas ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('dosen.nilai.edit', $nilai->id) }}"
                                            class="text-blue-600 hover:text-blue-700 font-medium mr-3">Edit</a>
                                        <form action="{{ route('dosen.nilai.delete', $nilai->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-700 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <!-- Script untuk mencari mahasiswa -->
    <script>
        document.getElementById('search-btn').addEventListener('click', async () => {
            const nim = document.getElementById('nim-input').value.trim();
            if (!nim) {
                alert('Masukkan NIM terlebih dahulu');
                return;
            }

            try {
                const response = await fetch(`/dosen/api/search-mahasiswa/${nim}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (data.success) {
                    document.getElementById('mahasiswa-name').textContent = data.mahasiswa.user.name;
                    document.getElementById('mahasiswa-nim').textContent = data.mahasiswa.nim;
                    document.getElementById('mahasiswa-id').value = data.mahasiswa.id;
                    document.getElementById('mahasiswa-info').classList.remove('hidden');
                    document.getElementById('nilai-section').classList.remove('hidden');
                } else {
                    alert(data.message || 'Mahasiswa tidak ditemukan');
                    document.getElementById('mahasiswa-info').classList.add('hidden');
                    document.getElementById('nilai-section').classList.add('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mencari mahasiswa: ' + error.message);
                document.getElementById('mahasiswa-info').classList.add('hidden');
                document.getElementById('nilai-section').classList.add('hidden');
            }
        }); // Trigger search dengan Enter key
        document.getElementById('nim-input').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('search-btn').click();
            }
        });
    </script>
@endsection
