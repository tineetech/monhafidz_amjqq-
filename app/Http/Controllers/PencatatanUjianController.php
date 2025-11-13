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

        $ujian = PencatatanUjian::with(['jadwalUjian.semester', 'ustadzah', 'jadwalUjian.santri'])
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
            ->when(Auth::user()->role === 'santri', function ($q) {
                $q->whereHas('jadwalUjian', function ($q2) {
                    $q2->where('santri_id', Auth::user()->santri->id ?? 0);
                });
            })
            ->when(Auth::user()->role === 'walisantri', function ($q) {
                $q->whereHas('jadwalUjian', function ($q2) {
                    $walisantri = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
                    $santri = $walisantri->santri;
                    $q2->where('santri_id', $santri->id ?? 0);
                });
            })
            ->get();

        $jadwal = \App\Models\JadwalUjian::with('semester')
            ->when($filter, function ($q) use ($filter) {
                $q->where('semester_id', $filter);
            })
            ->when(Auth::user()->role === 'santri', function ($q) {
                $q->where('santri_id', Auth::user()->santri->id ?? 0);
            })
            ->when(Auth::user()->role === 'walisantri', function ($q) {
                $walisantri = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
                $santri = $walisantri->santri;
                $q->where('santri_id', $santri->id ?? 0);
            })
            ->get();

        $groupJadwal = $jadwal->groupBy('semester_id');

        foreach ($groupJadwal as $semesterId => $jadwalSemesterIni) {

            $groupJenis = $jadwalSemesterIni->groupBy('jenis_ujian');

            foreach ($groupJenis as $jenis => $jadwalJenisIni) {

                $totalPeserta = $jadwalJenisIni->count();

                $pencatatanJenisIni = $ujian->filter(function ($item) use ($semesterId, $jenis) {
                    return $item->jadwalUjian 
                        && $item->jadwalUjian->semester_id == $semesterId
                        && $item->jadwalUjian->jenis_ujian == $jenis;
                });

                $sudahUjian = $pencatatanJenisIni->count();

                $sorted = $pencatatanJenisIni->sortByDesc('nilai_ujian')->values();
                $rank = 1;

                if ($totalPeserta == 0 || $sudahUjian < $totalPeserta) {
                    foreach ($sorted as $item) {
                        $item->rank = 'null';
                    }
                    continue;
                }

                // ✅ Jika lengkap → beri ranking
                foreach ($sorted as $item) {
                    $item->rank = $rank++;
                }
            }
        }

        $orderJenis = [
            'tasmi' => 1,
            'ujian_akhir' => 2,
            'ziyadah' => 3,
            'murajaah' => 4
        ];

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
            'jadwal_ujian_id'    => 'required|exists:jadwal_ujian,id',
            'ustadzah_id'  => 'nullable|exists:ustadzah,id',
            'nilai_ujian'  => 'nullable|numeric|min:0|max:100',
            'status_ujian' => 'required|in:belum_diuji,lulus',
        ]);


        PencatatanUjian::create($request->all());

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
            'jadwal_ujian_id'  => 'nullable|exists:jadwal_ujian,id',
            'ustadzah_id'  => 'nullable|exists:ustadzah,id',
            'nilai_ujian'  => 'nullable|numeric|min:0|max:100',
            'status_ujian' => 'required|in:belum_diuji,lulus',
        ]);

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
