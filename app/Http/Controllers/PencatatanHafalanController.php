<?php

namespace App\Http\Controllers;

use App\Models\PencatatanHafalan;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\WaliSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PencatatanHafalanController extends Controller
{
    /**
     * Tampilkan daftar pencatatan hafalan.
     */
    
    public function index()
    {
        $query = PencatatanHafalan::with(['santri', 'semester'])->latest();

        if (Auth::user()->role === 'santri') {
            $santri = Auth::user()->santri;

            if ($santri) {
                $query->where('santri_id', $santri->id);
            } else {
                $query->whereNull('id'); 
            }
        }
        
        if (Auth::user()->role === 'walisantri') {
            $walisantri = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
            $santri = $walisantri->santri;

            if ($santri) {
                $query->where('santri_id', $santri->id);
            } else {
                $query->whereNull('id'); 
            }
        }

        // Ambil data utama
        $data = $query->get();
        $ziyadah = $data->where('jenis_hafalan', 'Ziyadah');
        $murajaah = $data->where('jenis_hafalan', 'Murajaah');

        return view('pages.pencatatan-hafalan.index', compact('data', 'ziyadah', 'murajaah'));
    }

    /**
     * Form tambah pencatatan hafalan.
     */
    public function create()
    {
        $santri = Santri::all();
        $semester = Semester::where('jenis_hafalan', 'ziyadah')->get();

        return view('pages.pencatatan-hafalan.create', compact('santri', 'semester'));
    }

    /**
     * Simpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required',
            'semester_id' => 'required',
            'tanggal' => 'required|date',
            'jenis_hafalan' => 'required|string',
            'surah_ayat' => 'required|string',
            'juz_tercapai' => 'nullable|numeric',
            'nilai_tajwid' => 'required|numeric|min:0|max:100',
            'nilai_kelancaran' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
            // 'status' => 'required|string',
        ]);

        $calculateJuzTercapaiSms = PencatatanHafalan::where('santri_id', $validated['santri_id'])
            ->where('semester_id', $validated['semester_id'])
            ->where('jenis_hafalan', 'Ziyadah')
            ->sum('juz_tercapai');
        $totalJuzTercapai = $calculateJuzTercapaiSms + ($validated['juz_tercapai'] ?? 0);

        $santri = Santri::where('id', $validated['santri_id'])->firstOrFail();

        if ($totalJuzTercapai >= 5) {

            $nextSemester = \App\Models\Semester::where('id', '>', $santri->semester_id)
                ->orderBy('id', 'asc')
                ->first();

            if ($nextSemester) {
                $santri->update([
                    'semester_id' => $nextSemester->id,
                    'total_juz_tercapai' => $santri->total_juz_tercapai + $totalJuzTercapai
                ]);
            } else {
                $santri->update([
                    'total_juz_tercapai' => $santri->total_juz_tercapai + $totalJuzTercapai
                ]);
            }
        }

        // PencatatanHafalan::create($validated);
        $totalNilai = ($request->nilai_tajwid + $request->nilai_kelancaran) / 2;

        if ($totalNilai <= 70) {
            $status = 'harus diulang';
        } elseif ($totalNilai > 70 && $totalNilai <= 85) {
            $status = 'lulus jayyid';
        } else {
            $status = 'lulus mumtaz';
        }

        // Simpan ke database
        PencatatanHafalan::create([
            'santri_id'        => $request->santri_id,
            'semester_id'      => $request->semester_id,
            'tanggal'          => $request->tanggal,
            'jenis_hafalan'    => $request->jenis_hafalan,
            'surah_ayat'       => $request->surah_ayat,
            'nilai_tajwid'     => $request->nilai_tajwid,
            'nilai_kelancaran' => $request->nilai_kelancaran,
            'juz_tercapai'     => $request->juz_tercapai,
            'catatan'          => $request->catatan,
            'status'           => $status,
        ]);

        return redirect()->route('pencatatan-hafalan.index')
            ->with('success', 'Data pencatatan hafalan berhasil disimpan.');
    }

    /**
     * Detail data hafalan.
     */
    public function show($id)
    {
        $data = PencatatanHafalan::with(['santri', 'semester'])->findOrFail($id);

        return view('pages.pencatatan-hafalan.show', compact('data'));
    }

    /**
     * Form edit pencatatan hafalan.
     */
    public function edit($id)
    {
        $data = PencatatanHafalan::findOrFail($id);
        $santri = Santri::all();
        $semester = Semester::where('jenis_hafalan', 'ziyadah')->get();

        return view('pages.pencatatan-hafalan.edit', compact('data', 'santri', 'semester'));
    }

    /**
     * Update data.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'santri_id' => 'required',
            'semester_id' => 'required',
            'tanggal' => 'required|date',
            'jenis_hafalan' => 'required|string',
            'surah_ayat' => 'required|string',
            'juz_tercapai' => 'nullable|numeric',
            'nilai_tajwid' => 'required|numeric|min:0|max:100',
            'nilai_kelancaran' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $totalNilai = ($request->nilai_tajwid + $request->nilai_kelancaran) / 2;

        // Logika otomatis status berdasarkan nilai
        if ($totalNilai <= 70) {
            $status = 'harus di ulang';
        } elseif ($totalNilai > 70 && $totalNilai <= 85) {
            $status = 'lulus jayyid';
        } else {
            $status = 'lulus mumtaz';
        }

        $calculateJuzTercapaiSms = PencatatanHafalan::where('santri_id', $validated['santri_id'])
            ->where('semester_id', $validated['semester_id'])
            ->where('jenis_hafalan', 'Ziyadah')
            ->sum('juz_tercapai');
        $totalJuzTercapai = $calculateJuzTercapaiSms + ($validated['juz_tercapai'] ?? 0);

        $santri = Santri::where('id', $validated['santri_id'])->firstOrFail();

        if ($totalJuzTercapai >= 5) {

            $nextSemester = \App\Models\Semester::where('id', '>', $santri->semester_id)
                ->orderBy('id', 'asc')
                ->first();

            if ($nextSemester) {
                $santri->update([
                    'semester_id' => $nextSemester->id,
                    'total_juz_tercapai' => $santri->total_juz_tercapai + $totalJuzTercapai
                ]);
            } else {
                $santri->update([
                    'total_juz_tercapai' => $santri->total_juz_tercapai + $totalJuzTercapai
                ]);
            }
        }

        $data = PencatatanHafalan::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pencatatan-hafalan.index')
            ->with('success', 'Data pencatatan hafalan berhasil diperbarui.');
    }

    /**
     * Hapus data.
     */
    public function destroy($id)
    {
        $data = PencatatanHafalan::findOrFail($id);
        $data->delete();

        return redirect()->route('pencatatan-hafalan.index')
            ->with('success', 'Data pencatatan hafalan berhasil dihapus.');
    }
}
