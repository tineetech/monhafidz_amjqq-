<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Perizinan;
use App\Models\Santri;
use App\Models\PencatatanHafalan;
use App\Models\WaliSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AbsensiController extends Controller
{
    /**
     * Tampilkan daftar absensi.
     */
    
    public function index()
    {
        $absensiQuery = Absensi::with(['santri'])->latest();

        if (Auth::user()->role === 'santri') {
            $santri = Auth::user()->santri;

            if ($santri) {
                $absensiQuery->where('santri_id', $santri->id);
            } else {
                $absensiQuery->whereNull('id');
            }
        }

        if (Auth::user()->role === 'walisantri') {
            $walisantri = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
            $santri = $walisantri->santri;

            if ($santri) {
                $absensiQuery->where('santri_id', $santri->id);
            } else {
                $absensiQuery->whereNull('id');
            }
        }

        $absensi = $absensiQuery->get();
        $perizinan = Perizinan::orderBy('created_at', 'desc')->get();

        return view('pages.absensi.index', compact('absensi', 'perizinan'));
    }
    
    public function pengajuanIzin()
    {
        $santri = Santri::where('user_id', Auth::id())->first();
        return view('pages.absensi.perizinan', compact('santri'));
    }

    public function pengajuanIzinPost(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpa',
            'alasan' => 'nullable|string',
        ]);

        Perizinan::create($request->all());

        return redirect()->route('absensi.index')->with('success', 'Perizinan berhasil diajukan.');
    }
    
    public function pengajuanIzinSetujui($id)
    {
        $perizinan = Perizinan::findOrFail($id);

        Absensi::create([
            'santri_id' => $perizinan->santri_id,
            'tanggal'   => $perizinan->tanggal,
            'status'    => $perizinan->status,
            'catatan'   => $perizinan->alasan,
        ]);

        // Hapus data perizinan
        $perizinan->delete();

        return redirect()->route('absensi.index')
            ->with('success', 'Perizinan disetujui dan data absensi berhasil dibuat.');
    }


    public function pengajuanIzinDelete($id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $perizinan->delete();

        return redirect()->route('absensi.index')->with('success', 'Data perizinan berhasil dihapus.');
    }


    /**
     * Tampilkan form tambah absensi.
     */
    public function create()
    {
        $santri = Santri::all();
        $hafalan = PencatatanHafalan::all();
        return view('pages.absensi.create', compact('santri', 'hafalan'));
    }

    /**
     * Simpan data absensi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpa',
            'catatan' => 'nullable|string',
        ]);

        Absensi::create($request->all());

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail absensi tertentu.
     */
    public function show($id)
    {
        $absensi = Absensi::with(['santri'])->findOrFail($id);
        return view('pages.absensi.show', compact('absensi'));
    }

    /**
     * Tampilkan form edit absensi.
     */
    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $santri = Santri::all();
        $hafalan = PencatatanHafalan::all();

        return view('pages.absensi.edit', compact('absensi', 'santri', 'hafalan'));
    }

    /**
     * Update data absensi.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpa',
            'catatan' => 'nullable|string',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update($request->all());

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Hapus data absensi.
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus.');
    }

    public function getHafalan($santri_id)
    {
        $hafalan = \App\Models\PencatatanHafalan::where('santri_id', $santri_id)
            ->select('id', 'jenis_hafalan', 'surah_ayat')
            ->get();

        return response()->json($hafalan);
    }

}
