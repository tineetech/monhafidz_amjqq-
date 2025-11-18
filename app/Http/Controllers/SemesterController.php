<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Menampilkan daftar semua semester.
     */
    public function index()
    {
        $semesterZiyadah = Semester::where('jenis_hafalan', 'ziyadah')->get();
        $semesterMurajaah = Semester::where('jenis_hafalan', 'murajaah')->get();
        return view('pages.master.semester.index', compact('semesterZiyadah', 'semesterMurajaah'));
    }

    /**
     * Form untuk tambah data semester.
     */
    public function create()
    {
        return view('pages.master.semester.create');
    }

    /**
     * Simpan data semester baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_semester' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'jenis_hafalan' => 'required',
            'status' => 'required|string|in:aktif,nonaktif,selesai',
        ]);

        Semester::create($validated);

        return redirect()->route('semester.index')->with('success', 'Data semester berhasil ditambahkan!');
    }

    /**
     * Form edit data semester.
     */
    public function edit($id)
    {
        $semester = Semester::findOrFail($id);
        return view('pages.master.semester.edit', compact('semester'));
    }

    /**
     * Update data semester.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_semester' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
            'periode_mulai' => 'required|date',
            'jenis_hafalan' => 'required',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'status' => 'required|string|in:aktif,nonaktif,selesai',
        ]);

        $semester = Semester::findOrFail($id);
        $semester->update($validated);

        return redirect()->route('semester.index')->with('success', 'Data semester berhasil diperbarui!');
    }

    /**
     * Hapus data semester.
     */
    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return redirect()->route('semester.index')->with('success', 'Data semester berhasil dihapus!');
    }
}
