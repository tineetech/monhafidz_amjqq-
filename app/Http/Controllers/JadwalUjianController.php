<?php

namespace App\Http\Controllers;

use App\Models\JadwalUjian;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\Ustadzah;
use App\Models\WaliSantri;
use App\Services\MpwaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        
    public function index()
    {
        $semesters = Semester::all();

        $filter = request('filter_semester');
        $filterJenisUjian = request('filter_jenis_ujian');
        $jadwalQuery = JadwalUjian::with(['santri', 'semester', 'pembimbingPutra', 'pembimbingPutri'])
            ->when($filter, function ($query) use ($filter) {
                $query->where('semester_id', $filter);
            })
            ->when($filterJenisUjian, function ($query) use ($filterJenisUjian) {
                $query->where('jenis_ujian', $filterJenisUjian);
            });

        if (Auth::user()->role === 'santri') {
            $santri = Auth::user()->santri;

            if ($santri) {
                $jadwalQuery->where('santri_id', $santri->id);
            } else {
                $jadwalQuery->whereNull('id'); // biar hasil kosong kalau belum ada santri
            }
        }
        if (Auth::user()->role === 'walisantri') {
            $walisantri = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
            $santri = $walisantri->santri;

            if ($santri) {
                $jadwalQuery->where('santri_id', $santri->id);
            } else {
                $jadwalQuery->whereNull('id'); // biar hasil kosong kalau belum ada santri
            }
        }

        $jadwal = $jadwalQuery->orderBy('tanggal', 'asc')->get();

        return view('pages.jadwal-ujian.index', compact('jadwal', 'semesters'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $santris = Santri::orderBy('nama_lengkap','asc')->get();
        $ustadzah = Ustadzah::orderBy('nama_lengkap','asc')->get();
        $semesters = Semester::where('jenis_hafalan', 'ziyadah')->orderBy('nama_semester','asc')->get();

        return view('pages.jadwal-ujian.create', compact('santris','ustadzah','semesters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'santri_id'             => 'required|exists:santri,id',
            'is_bertahap'           => 'nullable',
            'tahap'                 => 'nullable',
            // 'semester_id'           => 'required|exists:semester,id',
            'tanggal'               => 'required|date',
            'jam_mulai'             => 'required|date_format:H:i',
            'jam_selesai'           => 'nullable|date_format:H:i|after:jam_mulai',
            'tempat'                => 'nullable',
            'pembimbing_putra_id'   => 'nullable|exists:ustadzah,id',
            'pembimbing_putri_id'   => 'nullable|exists:ustadzah,id',
            'jenis_ujian'           => 'required'
        ]);


        $validated['is_bertahap'] = 0;
        $jadwal = JadwalUjian::create($validated);

        // ambil nomor WA santri
        $santri = $jadwal->santri;
        $phone  = $santri->no_hp ?? null;

        if ($phone) {
            $text = "Assalamualaikum, {$santri->nama_lengkap}.\n"
                . "Anda mendapatkan jadwal ujian:\n"
                . "📆 Tanggal : {$jadwal->tanggal}\n"
                . "⏰ Jam     : {$jadwal->jam_mulai} - {$jadwal->jam_selesai}\n"
                . "📝 Jenis   : " . strtoupper($jadwal->jenis_ujian);

            try {
                MpwaService::sendMessage($phone, $text);
            } catch (\Exception $e) {
                Log::error("Gagal kirim WA ke $phone: " . $e->getMessage());
            }
        }


        return redirect()->route('dashboard')
                ->with('success', 'Jadwal ujian berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal = JadwalUjian::findOrFail($id);
        $santri = Santri::orderBy('nama_lengkap','asc')->get();
        $ustadzah = Ustadzah::orderBy('nama_lengkap','asc')->get();
        $semesters = Semester::where('jenis_hafalan', 'ziyadah')->orderBy('nama_semester','asc')->get();

        return view('pages.jadwal-ujian.edit', compact('jadwal','santri','ustadzah','semesters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            // 'santri_id'             => 'required|exists:santri,id',
            'is_bertahap'           => 'nullable',
            'tahap'                 => 'nullable',
            // 'semester_id'           => 'required|exists:semester,id',
            'tanggal'               => 'required|date',
            'jam_mulai'             => 'required|',
            'jam_selesai'           => 'nullable|after:jam_mulai',
            'tempat'                => 'nullable',
            'pembimbing_putra_id'   => 'nullable|exists:ustadzah,id',
            'pembimbing_putri_id'   => 'nullable|exists:ustadzah,id',
            'jenis_ujian'           => 'required'
        ]);

        $validated['is_bertahap'] = 0;
        $jadwal = JadwalUjian::findOrFail($id);
        $jadwal->update($validated);

        // ambil nomor WA santri
        $santri = $jadwal->santri;
        $phone  = $santri->no_hp ?? null;

        if ($phone) {
            $text = "Assalamualaikum, {$santri->nama_lengkap}.\n"
                . "Jadwal ujian anda telah Diperbarui:\n"
                . "📆 Tanggal : {$jadwal->tanggal}\n"
                . "⏰ Jam     : {$jadwal->jam_mulai} - {$jadwal->jam_selesai}\n"
                . "📝 Jenis   : " . strtoupper($jadwal->jenis_ujian);

            try {
                MpwaService::sendMessage($phone, $text);
            } catch (\Exception $e) {
                Log::error("Gagal kirim WA ke $phone: " . $e->getMessage());
            }
        }
        return redirect()->route('dashboard')
                ->with('success', 'Jadwal ujian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalUjian::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal-ujian.index')
                ->with('success', 'Jadwal ujian berhasil dihapus!');
    }
}
