@extends('layouts.dosen')

@section('title', 'Input Nilai - SIAKAD')

@section('main-content')
    <div class="space-y-6">
        <!-- Header -->
        <div
            class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-900 dark:to-blue-950 p-8 rounded-xl shadow-md text-white">
            <h1 class="text-3xl font-bold">Input Nilai Mahasiswa</h1>
            <p class="text-blue-200 mt-2">Masukkan nilai mahasiswa dengan format Excel</p>
        </div>

        <!-- Filter Kelas -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Kelas</label>
                    <select id="kelasSelect"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Kelas --</option>
                        @forelse($allKelas ?? [] as $kelas)
                            <option value="{{ $kelas->id }}">
                                {{ $kelas->nama_kelas }} - {{ $kelas->prodi }} {{ $kelas->angkatan }}
                            </option>
                        @empty
                            <option disabled>Tidak ada kelas</option>
                        @endforelse
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Mata Kuliah</label>
                    <select id="mataKuliahSelect"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @forelse($allMataKuliah ?? [] as $mk)
                            <option value="{{ $mk->id }}">
                                {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }}
                            </option>
                        @empty
                            <option disabled>Tidak ada mata kuliah</option>
                        @endforelse
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Prodi</label>
                    <input type="text" id="prodiKelas" readonly
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-400 bg-gray-100"
                        placeholder="Akan otomatis terisi">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Angkatan</label>
                    <input type="text" id="angkatanKelas" readonly
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-gray-400 bg-gray-100"
                        placeholder="Akan otomatis terisi">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Kelas</label>
                    <select id="kelasSelect"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Semua Kelas --</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tabel Input Nilai -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Mahasiswa & Input Nilai</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 w-12">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">NIM</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Kelas</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Nilai (0-100)
                            </th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Nilai Huruf
                            </th>
                        </tr>
                    </thead>
                    <tbody id="mahasiswaTable">
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                Pilih kelas dan mata kuliah terlebih dahulu
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol Aksi -->
            <div
                class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex justify-end gap-3">
                <button onclick="resetForm()"
                    class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                    Reset
                </button>
                <button onclick="submitNilai()"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>Simpan Nilai
                </button>
            </div>
        </div>
    </div>

    <script>
        // Data kelas dari blade
        const kelasData = {!! json_encode(
            ($allKelas ?? collect())->map(function ($kelas) {
                return [
                    'id' => $kelas->id,
                    'nama_kelas' => $kelas->nama_kelas,
                    'prodi' => $kelas->prodi,
                    'angkatan' => $kelas->angkatan,
                ];
            }),
        ) !!};

        // Data mata kuliah dari blade
        const mataKuliahData = {!! json_encode(
            ($allMataKuliah ?? collect())->map(function ($mk) {
                return [
                    'id' => $mk->id,
                    'nama_matakuliah' => $mk->nama_matakuliah,
                ];
            }),
        ) !!};

        // Konversi nilai angka ke huruf dengan skala: A(85-100), B(70-84), C(55-69), D(40-54), E(0-39)
        function nilaiKeHuruf(nilai) {
            nilai = parseInt(nilai);
            if (isNaN(nilai) || nilai === '') return '-';
            if (nilai >= 85) return 'A'; // 85-100: A (Sangat Baik)
            if (nilai >= 70) return 'B'; // 70-84:  B (Baik)
            if (nilai >= 55) return 'C'; // 55-69:  C (Cukup)
            if (nilai >= 40) return 'D'; // 40-54:  D (Kurang)
            return 'E'; // 0-39:   E (Sangat Kurang)
        }

        // Event listener untuk dropdown kelas
        document.getElementById('kelasSelect').addEventListener('change', function() {
            const selectedId = this.value;
            const table = document.getElementById('mahasiswaTable');

            if (!selectedId) {
                table.innerHTML =
                    '<tr><td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Pilih kelas dan mata kuliah terlebih dahulu</td></tr>';
                document.getElementById('prodiKelas').value = '';
                document.getElementById('angkatanKelas').value = '';
                return;
            }

            // Set prodi dan angkatan
            const selected = kelasData.find(k => k.id == selectedId);
            document.getElementById('prodiKelas').value = selected.prodi;
            document.getElementById('angkatanKelas').value = selected.angkatan;

            // Load data jika mata kuliah juga sudah dipilih
            const mataKuliahId = document.getElementById('mataKuliahSelect').value;
            if (mataKuliahId) {
                loadMahasiswaByKelas(selectedId);
            } else {
                table.innerHTML =
                    '<tr><td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Silakan pilih mata kuliah</td></tr>';
            }
        });

        // Event listener untuk dropdown mata kuliah
        document.getElementById('mataKuliahSelect').addEventListener('change', function() {
            const kelasId = document.getElementById('kelasSelect').value;
            const mataKuliahId = this.value;

            if (!kelasId) {
                alert('⚠️ Silahkan pilih kelas terlebih dahulu');
                this.value = '';
                return;
            }

            if (mataKuliahId) {
                loadMahasiswaByKelas(kelasId);
            } else {
                document.getElementById('mahasiswaTable').innerHTML =
                    '<tr><td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Silakan pilih mata kuliah</td></tr>';
            }
        });

        // Load mahasiswa berdasarkan kelas
        function loadMahasiswaByKelas(kelasId) {
            const mataKuliahId = document.getElementById('mataKuliahSelect').value;
            const url = `/dosen/api/mahasiswa-by-kelas/${kelasId}${mataKuliahId ? '?mata_kuliah_id=' + mataKuliahId : ''}`;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    allMahasiswaData = data.mahasiswa || [];
                    populateKelasDropdown(allMahasiswaData, data.kelasList || [], data.allKelasPatterns || []);
                    // default: show all (or first kelas if desired)
                    renderMahasiswaTable(allMahasiswaData);
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('mahasiswaTable').innerHTML =
                        '<tr><td colspan="6" class="px-4 py-8 text-center text-red-500">Error loading data</td></tr>';
                });
        }

        // Populate kelas dropdown. Priority:
        // 1) server-provided allKelasPatterns (global)
        // 2) server-provided kelasList (from DB)
        // 3) derived from mahasiswa array
        function populateKelasDropdown(mahasiswas, kelasList, allKelasPatterns) {
            const kelasSelect = document.getElementById('kelasSelect');
            kelasSelect.innerHTML = '<option value="">-- Semua Kelas --</option>';

            let items = [];
            if (Array.isArray(allKelasPatterns) && allKelasPatterns.length > 0) {
                items = allKelasPatterns.slice();
            } else if (Array.isArray(kelasList) && kelasList.length > 0) {
                items = kelasList.slice();
            } else if (Array.isArray(mahasiswas) && mahasiswas.length > 0) {
                const kelasSet = new Set();
                mahasiswas.forEach(m => {
                    if (m.kelas) kelasSet.add(m.kelas);
                });
                items = Array.from(kelasSet);
            }

            items.sort();
            items.forEach(k => {
                const opt = document.createElement('option');
                opt.value = k;
                opt.textContent = k;
                kelasSelect.appendChild(opt);
            });
        }

        // When kelas selected, try server-side filtered fetch if mata kuliah selected,
        // otherwise fall back to client-side filtering
        document.getElementById('kelasSelect').addEventListener('change', function() {
            const selectedKelas = this.value;
            const matkulId = document.getElementById('matkulSelect').value;

            if (!matkulId) {
                // no mata kuliah selected, just filter client-side
                if (!selectedKelas) return renderMahasiswaTable(allMahasiswaData);
                const filtered = allMahasiswaData.filter(m => m.kelas === selectedKelas);
                return renderMahasiswaTable(filtered);
            }

            // If kelas empty, load all cached data if available
            if (!selectedKelas) {
                if (allMahasiswaData.length > 0) return renderMahasiswaTable(allMahasiswaData);
                // otherwise fetch full list from server
                return loadMahasiswaByMataKuliah(matkulId);
            }

            // Fetch filtered mahasiswa from server for the selected kelas
            // include prodi when requesting filtered kelas results
            const prodiParam = document.getElementById('prodiSelect')?.value || '';
            let url = `/dosen/api/mahasiswa-by-matakuliah/${matkulId}?kelas=${encodeURIComponent(selectedKelas)}`;
            if (prodiParam) url += `&prodi=${encodeURIComponent(prodiParam)}`;
            fetch(url)
                .then(r => r.json())
                .then(data => {
                    allMahasiswaData = data.mahasiswa || [];
                    populateKelasDropdown(allMahasiswaData, data.kelasList || [], data.allKelasPatterns || []);
                    renderMahasiswaTable(allMahasiswaData);
                })
                .catch(err => {
                    console.error('Error fetching filtered mahasiswa:', err);
                    // fallback to client-side filter
                    const filtered = allMahasiswaData.filter(m => m.kelas === selectedKelas);
                    renderMahasiswaTable(filtered);
                });
        });

        // Render tabel mahasiswa
        function renderMahasiswaTable(mahasiswas) {
            const table = document.getElementById('mahasiswaTable');

            if (mahasiswas.length === 0) {
                table.innerHTML =
                    '<tr><td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Tidak ada mahasiswa untuk kelas ini</td></tr>';
                return;
            }

            let html = '';
            mahasiswas.forEach((mhs, index) => {
                const nilaiAngka = (mhs.nilai_angka !== null && mhs.nilai_angka !== undefined) ? mhs.nilai_angka : '';
                const nilaiHuruf = mhs.nilai_huruf || '-';
                const gradeClass = getNilaiClass(nilaiHuruf);
                
                html += `
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <td class="px-4 py-3 text-gray-900 dark:text-white font-medium">${index + 1}</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-white font-medium">${mhs.user.name}</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-white font-mono">${mhs.nim}</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-white">${mhs.kelas || '-'}</td>
                        <td class="px-4 py-3">
                            <input type="number" 
                                min="0" 
                                max="100" 
                                class="w-full px-3 py-2 border-2 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-center font-semibold focus:outline-none focus:border-blue-500 transition"
                                placeholder="0"
                                value="${nilaiAngka}"
                                data-mahasiswa-id="${mhs.id}"
                                data-index="${index}"
                                onchange="updateNilaiHuruf(this)"
                                oninput="updateNilaiHuruf(this)">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-block px-4 py-2 font-bold rounded-lg text-white ${gradeClass} transition"
                                  id="huruf-${index}">${nilaiHuruf}</span>
                        </td>
                    </tr>
                `;
            });

            table.innerHTML = html;
            lucide.createIcons();
        }

        // Update nilai huruf saat input nilai angka berubah (real-time)
        function updateNilaiHuruf(input) {
            const nilai = input.value;
            const index = input.getAttribute('data-index');
            const hurufCell = document.getElementById(`huruf-${index}`);
            const huruf = nilaiKeHuruf(nilai);

            if (hurufCell) {
                hurufCell.textContent = huruf;
                hurufCell.className = 'inline-block px-4 py-2 font-bold rounded-lg text-white transition ' + getNilaiClass(
                    huruf);

                // Add animation effect
                hurufCell.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    hurufCell.style.transform = 'scale(1)';
                }, 200);
            }
        }

        // Get CSS class berdasarkan nilai huruf dengan warna yang lebih menarik
        function getNilaiClass(huruf) {
            const classes = {
                'A': 'bg-emerald-600 hover:bg-emerald-700', // Hijau - Sangat Baik
                'B': 'bg-blue-600 hover:bg-blue-700', // Biru - Baik
                'C': 'bg-yellow-600 hover:bg-yellow-700', // Kuning - Cukup
                'D': 'bg-orange-600 hover:bg-orange-700', // Orange - Kurang
                'E': 'bg-red-600 hover:bg-red-700', // Merah - Sangat Kurang
                '-': 'bg-gray-500 hover:bg-gray-600' // Abu-abu - Belum diisi
            };
            return classes[huruf] || 'bg-gray-500 hover:bg-gray-600';
        }

        // Submit nilai dengan validasi lengkap
        function submitNilai() {
            const kelasId = document.getElementById('kelasSelect').value;
            const mataKuliahId = document.getElementById('mataKuliahSelect').value;

            if (!kelasId) {
                alert('⚠️ Silahkan pilih kelas terlebih dahulu');
                return;
            }

            if (!mataKuliahId) {
                alert('⚠️ Silahkan pilih mata kuliah terlebih dahulu');
                return;
            }

            const inputs = document.querySelectorAll('input[data-mahasiswa-id]');
            const nilai = [];

            inputs.forEach(input => {
                const nilaiAngka = input.value;
                if (nilaiAngka !== '') {
                    nilai.push({
                        mahasiswa_id: input.getAttribute('data-mahasiswa-id'),
                        kelas_id: kelasId,
                        mata_kuliah: mataKuliahId,
                        nilai_angka: parseInt(nilaiAngka),
                        nilai_huruf: nilaiKeHuruf(nilaiAngka)
                    });
                }
            });

            if (nilai.length === 0) {
                alert('⚠️ Silahkan isi nilai terlebih dahulu');
                return;
            }

            // Show loading state
            const btn = event.target;
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i data-lucide="loader" class="w-4 h-4 inline mr-2 animate-spin"></i>Menyimpan...';

            // Submit via AJAX
            fetch('/dosen/api/submit-nilai', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        nilai: nilai
                    })
                })
                .then(response => response.json())
                .then(data => {
                    btn.disabled = false;
                    btn.innerHTML = originalText;

                    if (data.success) {
                        alert('✅ Nilai berhasil disimpan!');
                        // Reload data untuk menampilkan nilai terbaru
                        const selectedId = document.getElementById('kelasSelect').value;
                        if (selectedId) {
                            loadMahasiswaByKelas(selectedId);
                        }
                    } else {
                        alert('❌ Error: ' + (data.message || 'Gagal menyimpan nilai'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                    alert('❌ Error: Gagal mengirim data');
                });
        }

        // Reset form
        function resetForm() {
            document.getElementById('kelasSelect').value = '';
            document.getElementById('mataKuliahSelect').value = '';
            document.getElementById('prodiKelas').value = '';
            document.getElementById('angkatanKelas').value = '';
            document.getElementById('mahasiswaTable').innerHTML =
                '<tr><td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Pilih kelas dan mata kuliah terlebih dahulu</td></tr>';
        }

        // Keyboard shortcut: Ctrl+Enter untuk submit
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.ctrlKey) {
                submitNilai();
            }
        });

        lucide.createIcons();
    </script>
@endsection