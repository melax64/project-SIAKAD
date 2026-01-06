<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    // List semua mata kuliah
    public function index()
    {
        $mataKuliahs = MataKuliah::orderBy('kode_matakuliah')->paginate(10);
        return view('admin.matakuliah.index', compact('mataKuliahs'), ['activePage' => 'mata-kuliah']);
    }

    // Form create
    public function create()
    {
        return view('admin.matakuliah.create', ['activePage' => 'mata-kuliah']);
    }

    // Simpan mata kuliah baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => 'required|string|unique:mata_kuliahs,kode_matakuliah|max:10',
            'nama_matakuliah' => 'required|string|max:255',
            'sks' => 'required|numeric|min:1|max:6',
            'deskripsi' => 'nullable|string',
        ]);

        MataKuliah::create($validated);

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        return view('admin.matakuliah.edit', compact('mataKuliah'));
    }

    // Update mata kuliah
    public function update(Request $request, $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);

        $validated = $request->validate([
            'kode_matakuliah' => 'required|string|unique:mata_kuliahs,kode_matakuliah,' . $id . '|max:10',
            'nama_matakuliah' => 'required|string|max:255',
            'sks' => 'required|numeric|min:1|max:6',
            'deskripsi' => 'nullable|string',
        ]);

        $mataKuliah->update($validated);

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    // Hapus mata kuliah
    public function destroy($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
