<?php

namespace App\Http\Controllers;

use App\Models\PencatatanUjian;
use App\Models\Santri;
use App\Models\Ustadzah;
use App\Models\WaliSantri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PencatatanUjianController extends Controller
{
    public function index()
    {
        $semesters = \App\Models\Semester::all();
        $filter = request('filter_semester');
        $filterJenisUjian = request('filter_jenis_ujian');

        // ---------------------------------------------------------
        // 1) AMBIL SEMUA DATA UJIAN (TANPA FILTER SANTRI/WALISANTRI)
        // ---------------------------------------------------------
        $ujianForRank = PencatatanUjian::with(['jadwalUjian.semester', 'ustadzah', 'jadwalUjian.santri'])
            ->whereHas('jadwalUjian', function ($q) {
                $q->where('jenis_ujian', '!=', 'tasmi');
            })
            ->when($filter, function ($q) use ($filter) {
                $q->whereHas('jadwalUjian', function ($q2) use ($filter) {
                    $q2->where('semester_id', $filter);
                });
            })
            ->when($filterJenisUjian, function ($q) use ($filterJenisUjian) {
                $q->whereHas('jadwalUjian', function ($q2) use ($filterJenisUjian) {
                    $q2->where('jenis_ujian', $filterJenisUjian);
                });
            })
            ->get();

        // Ambil jadwal untuk grouping per semester & jenis
        $jadwal = \App\Models\JadwalUjian::with('semester')
            ->when($filter, function ($q) use ($filter) {
                $q->where('semester_id', $filter);
            })
            ->get();

        $groupJadwal = $jadwal->groupBy('semester_id');

        // ---------------------------------------------------------
        // 2) HITUNG RANKING MENGGUNAKAN SEMUA DATA ($ujianForRank)
        // ---------------------------------------------------------
        foreach ($groupJadwal as $semesterId => $jadwalSemesterIni) {

            $groupJenis = $jadwalSemesterIni->groupBy('jenis_ujian');

            foreach ($groupJenis as $jenis => $jadwalJenisIni) {

                $totalPeserta = $jadwalJenisIni->count();

                $pencatatanJenisIni = $ujianForRank->filter(function ($item) use ($semesterId, $jenis) {
                    return $item->jadwalUjian 
                        && $item->jadwalUjian->semester_id == $semesterId
                        && $item->jadwalUjian->jenis_ujian == $jenis;
                });

                $sudahUjian = $pencatatanJenisIni->count();

                $sorted = $pencatatanJenisIni->sortByDesc('nilai_akhir')->values();
                $rank = 1;

                // Jika peserta belum lengkap → rank = null
                if ($totalPeserta == 0 || $sudahUjian < $totalPeserta) {
                    foreach ($sorted as $item) {
                        $item->rank = 'null';
                    }
                    continue;
                }

                // Jika lengkap → berikan ranking
                foreach ($sorted as $item) {
                    $item->rank = $rank++;
                }
            }
        }

        // Urutan jenis ujian
        $orderJenis = [
            'tasmi' => 1,
            'ujian_akhir' => 2,
            'ziyadah' => 3,
            'murajaah' => 4
        ];

        // ---------------------------------------------------------
        // 3) SETELAH RANK SIAP → FILTER UNTUK USER LOGIN
        // ---------------------------------------------------------
        $ujian = $ujianForRank;

        if (Auth::user()->role === 'santri') {
            $idSantri = Auth::user()->santri->id ?? 0;
            $ujian = $ujian->filter(fn($x) => $x->jadwalUjian->santri_id == $idSantri);
        }

        if (Auth::user()->role === 'walisantri') {
            $walisantri = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
            $idSantri = $walisantri->santri->id ?? 0;
            $ujian = $ujian->filter(fn($x) => $x->jadwalUjian->santri_id == $idSantri);
        }

        // ---------------------------------------------------------
        // 4) SORTING UNTUK TAMPILAN
        // ---------------------------------------------------------
        $ujian = $ujian->sortBy(function ($item) use ($orderJenis) {
            $jenisOrder = $orderJenis[$item->jadwalUjian->jenis_ujian] ?? 999;
            $rankOrder = $item->rank ?? 999999;
            return $jenisOrder . '-' . $rankOrder;
        })->values();

        return view('pages.pencatatan-ujian.index', compact('ujian', 'semesters'));
    }

    public function create()
    {
        $santri = Santri::all();
        $ustadzah = Ustadzah::all();

        // ambil jadwal yang belum tercatat di pencatatan_ujian
        $jadwalUjian = \App\Models\JadwalUjian::with('santri')
            ->whereDoesntHave('pencatatanUjian') // penting
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.pencatatan-ujian.create', compact('santri', 'ustadzah', 'jadwalUjian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'jadwal_ujian_id'    => 'required|exists:jadwal_ujian,id',
            'tanggal'            => 'required',
            // 'ustadzah_id'        => 'nullable|exists:ustadzah,id',
            'nilai_tajwid'       => 'nullable|numeric|min:0|max:100',
            'nilai_kelancaran'   => 'nullable|numeric|min:0|max:100',
            'kesalahan'          => 'nullable|numeric|min:0|max:100',
            'status_ujian'       => 'required|in:belum_diuji,lulus',
        ]);

        // Hitung nilai akhir otomatis
        $nilaiTajwid = $request->nilai_tajwid ?? 0;
        $nilaiKelancaran = $request->nilai_kelancaran ?? 0;

        $nilaiAkhir = ($nilaiTajwid + $nilaiKelancaran) / 2;

        $data = $request->all();
        $data['nilai_akhir'] = $nilaiAkhir;

        PencatatanUjian::create($data);

        return redirect()->route('pencatatan-ujian.index')
                        ->with('success', 'Data ujian berhasil ditambahkan');
    }


    public function edit($id)
    {
        $ujian = PencatatanUjian::findOrFail($id);
        $santri = Santri::all();
        $ustadzah = Ustadzah::all();
        $jadwalUjian = \App\Models\JadwalUjian::with('santri')->orderBy('tanggal', 'desc')->get();
        return view('pages.pencatatan-ujian.edit', compact('ujian', 'santri', 'ustadzah', 'jadwalUjian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal_ujian_id'    => 'required|exists:jadwal_ujian,id',
            'ustadzah_id'        => 'nullable|exists:ustadzah,id',
            'nilai_tajwid'       => 'nullable|numeric|min:0|max:100',
            'nilai_kelancaran'   => 'nullable|numeric|min:0|max:100',
            'kesalahan'          => 'nullable|numeric|min:0|max:100',
            'status_ujian'       => 'required|in:belum_diuji,lulus',
        ]);


        // Hitung nilai akhir otomatis
        $nilaiTajwid = $request->nilai_tajwid ?? 0;
        $nilaiKelancaran = $request->nilai_kelancaran ?? 0;

        $nilaiAkhir = ($nilaiTajwid + $nilaiKelancaran) / 2;

        $data = $request->all();
        $data['nilai_akhir'] = $nilaiAkhir;
        
        $ujian = PencatatanUjian::findOrFail($id);
        $ujian->update($request->all());

        return redirect()->route('pencatatan-ujian.index')
                         ->with('success', 'Data ujian berhasil diupdate');
    }

    public function destroy($id)
    {
        $ujian = PencatatanUjian::findOrFail($id);
        $ujian->delete();

        return redirect()->route('pencatatan-ujian.index')
                         ->with('success', 'Data ujian berhasil dihapus');
    }
}
