<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Dosen;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Tampilkan daftar nilai dengan filter per kelas dan mata kuliah
     */
    public function index(Request $request)
    {
        $query = Nilai::with(['mahasiswa', 'mahasiswa.kelas', 'dosen']);

        // Filter berdasarkan kelas
        if ($request->filled('kelas_id')) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }

        // Filter berdasarkan mata kuliah
        if ($request->filled('mata_kuliah')) {
            $query->where('mata_kuliah', $request->mata_kuliah);
        }

        // Filter berdasarkan dosen (untuk dosen hanya bisa lihat nilai mereka)
        if (auth()->user()->role === 'dosen') {
            $dosen = Dosen::where('user_id', auth()->id())->first();
            if ($dosen) {
                $query->where('dosen_id', $dosen->id);
            }
        }

        $nilais = $query->paginate(15);
        $kelas = Kelas::orderBy('prodi')->orderBy('angkatan')->orderBy('nama_kelas')->get();
        $mataKuliahs = MataKuliah::all();

        return view('nilai.index', compact('nilais', 'kelas', 'mataKuliahs'));
    }

    /**
     * Tampilkan form untuk input nilai per kelas dan mata kuliah
     */
    public function inputForm(Request $request)
    {
        $kelas_id = $request->query('kelas_id');
        $mata_kuliah = $request->query('mata_kuliah');

        $mahasiswas = Mahasiswa::query();

        if ($kelas_id) {
            $mahasiswas->where('kelas_id', $kelas_id);
        }

        $mahasiswas = $mahasiswas->with('kelas')->paginate(10);

        $kelas = Kelas::all();
        $mataKuliahs = MataKuliah::all();
        $dosen = Dosen::where('user_id', auth()->id())->first();

        return view('nilai.input', compact('mahasiswas', 'kelas', 'mataKuliahs', 'dosen', 'kelas_id', 'mata_kuliah'));
    }

    /**
     * Simpan nilai untuk satu mahasiswa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'mata_kuliah' => 'required|string',
            'kehadiran' => 'required|numeric|min:0|max:100',
            'tugas' => 'required|numeric|min:0|max:100',
            'uts' => 'required|numeric|min:0|max:100',
            'uas' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        $dosen = Dosen::where('user_id', auth()->id())->first();

        // Hitung nilai akhir
        $nilai_akhir = ($validated['kehadiran'] * 0.1) + ($validated['tugas'] * 0.2) + ($validated['uts'] * 0.3) + ($validated['uas'] * 0.4);

        // Tentukan nilai huruf
        $nilai_huruf = $this->getNilaiHuruf($nilai_akhir);

        // Cari atau buat record nilai
        $mataKuliah = MataKuliah::where('nama_matakuliah', $validated['mata_kuliah'])->first();

        Nilai::updateOrCreate(
            [
                'dosen_id' => $dosen->id,
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'mata_kuliah' => $validated['mata_kuliah'],
            ],
            [
                'tipe_kelas' => 'teori',
                'sks' => $mataKuliah->sks ?? 3,
                'kehadiran' => $validated['kehadiran'],
                'tugas' => $validated['tugas'],
                'uts' => $validated['uts'],
                'uas' => $validated['uas'],
                'catatan' => $validated['catatan'],
                'nilai_akhir' => round($nilai_akhir, 2),
                'nilai_huruf' => $nilai_huruf,
            ]
        );

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }

    /**
     * Tampilkan laporan nilai per kelas
     */
    public function laporanKelas(Request $request)
    {
        $kelas_id = $request->query('kelas_id');
        $mata_kuliah = $request->query('mata_kuliah');

        $query = Nilai::with(['mahasiswa.kelas', 'dosen']);

        if ($kelas_id) {
            $query->whereHas('mahasiswa', function ($q) use ($kelas_id) {
                $q->where('kelas_id', $kelas_id);
            });
        }

        if ($mata_kuliah) {
            $query->where('mata_kuliah', $mata_kuliah);
        }

        $nilais = $query->orderBy('mata_kuliah')->orderByRaw('CAST(nilai_akhir AS DECIMAL) DESC')->get();

        $kelas = Kelas::all();
        $mataKuliahs = MataKuliah::all();

        return view('nilai.laporan-kelas', compact('nilais', 'kelas', 'mataKuliahs', 'kelas_id', 'mata_kuliah'));
    }

    /**
     * Tentukan nilai huruf berdasarkan nilai akhir
     */
    private function getNilaiHuruf($nilai)
    {
        if ($nilai >= 85) return 'A';
        if ($nilai >= 80) return 'A-';
        if ($nilai >= 75) return 'B+';
        if ($nilai >= 70) return 'B';
        if ($nilai >= 65) return 'B-';
        if ($nilai >= 60) return 'C+';
        if ($nilai >= 55) return 'C';
        if ($nilai >= 50) return 'C-';
        if ($nilai >= 40) return 'D';
        return 'E';
    }
}
