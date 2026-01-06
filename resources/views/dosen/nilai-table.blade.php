@extends('layouts.dosen')

@section('main-content')

    <div class="space-y-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Input Nilai Mahasiswa (Tabel)</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Masukkan nilai mahasiswa dalam format tabel seperti Excel</p>
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

        <!-- Dropdown Mata Kuliah -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Pilih Mata Kuliah</h2>
            
            <div class="flex gap-4">
                <div class="flex-1">
                    <select id="mata-kuliah-select"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @forelse($mataKuliahList as $mk)
                            <option value="{{ $mk->mata_kuliah }}" data-kelas="{{ $mk->tipe_kelas }}" data-sks="{{ $mk->sks }}">
                                {{ $mk->mata_kuliah }} ({{ $mk->tipe_kelas }} - {{ $mk->sks }} SKS)
                            </option>
                        @empty
                            <option value="" disabled>Anda belum mengajar mata kuliah apapun</option>
                        @endforelse
                    </select>
                </div>
                <button type="button" id="load-btn"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                    <i data-lucide="loader" class="w-4 h-4 inline mr-2"></i>Muat Data
                </button>
            </div>
        </div>

        <!-- Tabel Input Nilai -->
        <div id="nilai-table-container" class="hidden bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 p-6 overflow-x-auto">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Tabel Input Nilai</h2>
                <p id="mata-kuliah-info" class="text-sm text-gray-600 dark:text-gray-400">-</p>
            </div>

            <form id="nilai-form" class="space-y-4">
                <table class="w-full border-collapse min-w-max">
                    <thead class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/40 dark:to-blue-800/40">
                        <tr>
                            <th class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-left font-semibold text-gray-900 dark:text-white w-16">No.</th>
                            <th class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">Nama Mahasiswa</th>
                            <th class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-left font-semibold text-gray-900 dark:text-white w-32">NIM</th>
                            <th class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">Kelas</th>
                            <th class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-center font-semibold text-gray-900 dark:text-white w-24">Nilai (Angka)</th>
                            <th class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-center font-semibold text-gray-900 dark:text-white w-24">Nilai (Huruf)</th>
                        </tr>
                    </thead>
                    <tbody id="nilai-tbody" class="divide-y divide-gray-200 dark:divide-slate-700">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>

                <div id="no-data-message" class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
                    <p>Belum ada mahasiswa. Silakan pilih mata kuliah terlebih dahulu.</p>
                </div>

                <div id="button-group" class="hidden flex gap-4 pt-4 border-t border-gray-200 dark:border-slate-700">
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors shadow-md">
                        <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>Simpan Semua Nilai
                    </button>
                    <button type="reset"
                        class="px-6 py-3 bg-gray-400 hover:bg-gray-500 text-white rounded-lg font-medium transition-colors shadow-md">
                        <i data-lucide="refresh-cw" class="w-4 h-4 inline mr-2"></i>Reset
                    </button>
                </div>
            </form>
        </div>

        <!-- Loading Spinner -->
        <div id="loading-spinner" class="hidden flex items-center justify-center py-8">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
        </div>
    </div>

    <script>
        // Konversi nilai angka ke huruf
        function convertToGrade(nilai) {
            nilai = parseFloat(nilai) || 0;
            if (nilai >= 85) return 'A';
            if (nilai >= 80) return 'A-';
            if (nilai >= 75) return 'B+';
            if (nilai >= 70) return 'B';
            if (nilai >= 65) return 'B-';
            if (nilai >= 60) return 'C+';
            if (nilai >= 55) return 'C';
            if (nilai >= 50) return 'C-';
            if (nilai >= 40) return 'D';
            return 'E';
        }

        // Handle mata kuliah selection change
        document.getElementById('mata-kuliah-select').addEventListener('change', function() {
            const loadBtn = document.getElementById('load-btn');
            loadBtn.disabled = !this.value;
        });

        // Load data mahasiswa berdasarkan mata kuliah
        document.getElementById('load-btn').addEventListener('click', async function() {
            const mataKuliah = document.getElementById('mata-kuliah-select').value;
            const selectElement = document.getElementById('mata-kuliah-select');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const kelas = selectedOption.getAttribute('data-kelas');

            if (!mataKuliah) {
                alert('Silakan pilih mata kuliah terlebih dahulu');
                return;
            }

            // Show loading
            document.getElementById('loading-spinner').classList.remove('hidden');
            document.getElementById('nilai-table-container').classList.add('hidden');

            try {
                const response = await fetch(`/dosen/api/mahasiswa-by-matakuliah/${mataKuliah}`);
                const result = await response.json();

                if (result.success) {
                    displayTable(result.mahasiswa, mataKuliah, kelas);
                } else {
                    alert(result.message || 'Error loading data');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data');
            } finally {
                document.getElementById('loading-spinner').classList.add('hidden');
            }
        });

        // Display table data
        function displayTable(mahasiswa, mataKuliah, kelas) {
            const tbody = document.getElementById('nilai-tbody');
            const infoText = document.getElementById('mata-kuliah-info');
            const container = document.getElementById('nilai-table-container');
            const buttonGroup = document.getElementById('button-group');
            const noDataMsg = document.getElementById('no-data-message');

            infoText.textContent = `Mata Kuliah: ${mataKuliah} | Kelas: ${kelas}`;

            if (mahasiswa.length === 0) {
                tbody.innerHTML = '';
                noDataMsg.classList.remove('hidden');
                buttonGroup.classList.add('hidden');
            } else {
                tbody.innerHTML = mahasiswa.map((item, index) => `
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-gray-900 dark:text-white font-medium">${index + 1}</td>
                        <td class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-gray-900 dark:text-white">${item.nama}</td>
                        <td class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-gray-900 dark:text-white font-mono">${item.nim}</td>
                        <td class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-gray-900 dark:text-white">${item.kelas}</td>
                        <td class="border border-gray-300 dark:border-slate-600 px-4 py-3">
                            <input type="number" 
                                class="nilai-input w-full px-3 py-2 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                min="0" max="100" step="0.1" 
                                value="${item.nilai_angka || ''}"
                                data-mahasiswa-id="${item.mahasiswa_id}"
                                placeholder="0">
                        </td>
                        <td class="border border-gray-300 dark:border-slate-600 px-4 py-3 text-center">
                            <span class="nilai-huruf inline-flex items-center justify-center w-12 h-10 rounded font-bold text-white" 
                                style="background-color: ${getGradeColor(item.nilai_huruf)}">
                                ${item.nilai_huruf || '-'}
                            </span>
                        </td>
                    </tr>
                `).join('');

                noDataMsg.classList.add('hidden');
                buttonGroup.classList.remove('hidden');

                // Add event listeners untuk input nilai
                document.querySelectorAll('.nilai-input').forEach(input => {
                    input.addEventListener('input', function() {
                        const nilai = this.value;
                        const huruf = convertToGrade(nilai);
                        const hurufSpan = this.closest('tr').querySelector('.nilai-huruf');
                        hurufSpan.textContent = huruf;
                        hurufSpan.style.backgroundColor = getGradeColor(huruf);
                    });
                });
            }

            container.classList.remove('hidden');
        }

        // Get warna berdasarkan grade
        function getGradeColor(grade) {
            const colors = {
                'A': '#10B981',    // green
                'A-': '#34D399',   // light green
                'B+': '#3B82F6',   // blue
                'B': '#0EA5E9',    // sky blue
                'B-': '#06B6D4',   // cyan
                'C+': '#F59E0B',   // amber
                'C': '#F97316',    // orange
                'C-': '#FB923C',   // light orange
                'D': '#EF4444',    // red
                'E': '#991B1B'     // dark red
            };
            return colors[grade] || '#6B7280';
        }

        // Handle form submission
        document.getElementById('nilai-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const mataKuliah = document.getElementById('mata-kuliah-select').value;
            const nilaiData = [];

            document.querySelectorAll('.nilai-input').forEach(input => {
                if (input.value) {
                    nilaiData.push({
                        mahasiswa_id: input.getAttribute('data-mahasiswa-id'),
                        nilai_angka: parseFloat(input.value)
                    });
                }
            });

            if (nilaiData.length === 0) {
                alert('Silakan masukkan minimal satu nilai');
                return;
            }

            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i data-lucide="loader" class="w-4 h-4 inline mr-2 animate-spin"></i>Menyimpan...';

            try {
                const response = await fetch('{{ route("dosen.nilai.table.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    body: JSON.stringify({
                        mata_kuliah: mataKuliah,
                        nilai_data: nilaiData
                    })
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message || 'Nilai berhasil disimpan!');
                    // Reload page untuk menampilkan data terbaru
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alert(result.message || 'Terjadi kesalahan');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });

        // Initialize lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>

    <style>
        /* Ensure table scrolls properly on mobile */
        @media (max-width: 768px) {
            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>

@endsection
