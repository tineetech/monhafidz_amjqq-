<?php

namespace App\Http\Controllers;

use App\Models\UjianTasmi;
use App\Models\JadwalUjian;
use App\Models\Ustadzah;
use Illuminate\Http\Request;

class UjianTasmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ujian = UjianTasmi::with(['jadwalUjian', 'ustadzah'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('pages.ujian-tasmi.index', compact('ujian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ustadzah = Ustadzah::all();
        $jadwalUjian = JadwalUjian::with('santri')
            ->where('jenis_ujian', 'tasmi')
            ->whereDoesntHave('ujianTasmi') // penting
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.ujian-tasmi.create', compact('jadwalUjian', 'ustadzah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_ujian_id' => 'required|exists:jadwal_ujian,id',
            'ustadzah_id'     => 'nullable|exists:ustadzah,id',
            'tanggal_tasmi'   => 'required|date',
            'juz_yang_ditasmi' => 'required|string',
            'status_ujian'    => 'required|in:belum_diuji,lancar,remidi',
            'catatan' => 'nullable|string',
        ]);

        UjianTasmi::create($request->all());

        return redirect()->route('ujian-tasmi.index')
            ->with('success', 'Data ujian tasmi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = UjianTasmi::with(['jadwalUjian', 'ustadzah'])->findOrFail($id);

        return view('pages.ujian-tasmi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ujian = UjianTasmi::findOrFail($id);
        $jadwalUjian = JadwalUjian::where('jenis_ujian', 'tasmi')
            // ->whereDoesntHave('ujianTasmi') // penting
            ->orderBy('tanggal', 'desc')
            ->get();
        $ustadzah = Ustadzah::all();

        return view('pages.ujian-tasmi.edit', compact('ujian', 'jadwalUjian', 'ustadzah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jadwal_ujian_id' => 'required|exists:jadwal_ujian,id',
            'ustadzah_id'     => 'nullable|exists:ustadzah,id',
            'tanggal_tasmi'   => 'required|date',
            'juz_yang_ditasmi' => 'required|string|max:10',
            'status_ujian'    => 'required|in:belum_diuji,lancar,remidi',
            'catatan' => 'nullable|string',
        ]);

        $data = UjianTasmi::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('ujian-tasmi.index')
            ->with('success', 'Data ujian tasmi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = UjianTasmi::findOrFail($id);
        $data->delete();

        return redirect()->route('ujian-tasmi.index')
            ->with('success', 'Data ujian tasmi berhasil dihapus');
    }
}
