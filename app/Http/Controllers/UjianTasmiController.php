<?php

namespace App\Http\Controllers;

use App\Models\UjianTasmi;
use App\Models\JadwalUjian;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\Ustadzah;
use App\Models\WaliSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UjianTasmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ujian = UjianTasmi::with(['santri', 'semester', 'ustadzah'])
            ->when(Auth::user()->role === 'santri', function ($q) {
                $q->where('santri_id', Auth::user()->santri->id ?? 0);
            })
            ->when(Auth::user()->role === 'walisantri', function ($q) {
                $wali = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
                $idSantri = $wali->santri->id ?? 0;
                $q->where('santri_id', $idSantri);
            })
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
        $santri = Santri::all();
        $semester = Semester::where('jenis_hafalan', 'ziyadah')->get();
        // $jadwalUjian = JadwalUjian::with('santri')
        //     ->where('jenis_ujian', 'tasmi')
        //     ->whereDoesntHave('ujianTasmi') // penting
        //     ->orderBy('tanggal', 'desc')
        //     ->get();

        return view('pages.ujian-tasmi.create', compact('ustadzah', 'santri', 'semester'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'jadwal_ujian_id' => 'required|exists:jadwal_ujian,id',
            'santri_id'       => 'required|exists:santri,id',
            'semester_id'     => 'required|exists:semester,id',
            'tanggal'         => 'required',
            'ustadzah_id'     => 'nullable|exists:ustadzah,id',
            'tanggal_tasmi'   => 'required|date',
            'juz_yang_ditasmi' => 'required|string',
            'status_ujian'    => 'required|in:selesai,belum_diuji',
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
        $santri = Santri::all();
        $semester = Semester::where('jenis_hafalan', 'ziyadah')->get();

        return view('pages.ujian-tasmi.edit', compact('ujian', 'jadwalUjian', 'ustadzah', 'santri', 'semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'jadwal_ujian_id' => 'required|exists:jadwal_ujian,id',
            'santri_id'       => 'required|exists:santri,id',
            'semester_id'     => 'required|exists:semester,id',
            'tanggal'         => 'required',
            'ustadzah_id'     => 'nullable|exists:ustadzah,id',
            'tanggal_tasmi'   => 'required|date',
            'juz_yang_ditasmi' => 'required|string',
            'status_ujian'    => 'required|in:selesai,belum_diuji',
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
