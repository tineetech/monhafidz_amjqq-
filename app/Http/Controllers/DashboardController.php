<?php

namespace App\Http\Controllers;

use App\Models\JadwalHafalan;
use App\Models\JadwalUjian;
use App\Models\JadwalUjianTasmi;
use App\Models\PencatatanHafalan;
use App\Models\PencatatanUjian;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\Ustadzah;
use App\Models\WaliSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    private function hitungRankingDashboard($santri)
    {
        if (!$santri || !$santri->semester_id) {
            return [null, null];
        }

        $semesterAktif = Semester::find($santri->semester_id);
        if (!$semesterAktif) {
            return [null, null];
        }

        $hasil = [
            'Ziyadah'  => null,
            'Murajaah' => null,
        ];

        foreach (['Ziyadah', 'Murajaah'] as $jenisUjian) {

            $ranking = PencatatanUjian::with('santri')
                ->whereHas('santri', function ($q) use ($santri) {
                    $q->where('jenis_kelamin', $santri->jenis_kelamin);
                })
                ->where('semester_id', $semesterAktif->id)
                ->where('jenis_ujian', $jenisUjian)
                ->selectRaw('santri_id, AVG(nilai_akhir) as rata_rata')
                ->groupBy('santri_id')
                ->orderByDesc('rata_rata')
                ->get();

            if ($ranking->isEmpty()) {
                continue;
            }

            $posisi = $ranking->search(fn ($item) => $item->santri_id == $santri->id);

            if ($posisi === false) {
                continue;
            }

            $hasil[$jenisUjian] = [
                'nama'          => $santri->nama_lengkap,
                'gender'        => $santri->jenis_kelamin === 'Laki-laki' ? 'putra' : 'putri',
                'ranking'       => $posisi + 1,
                'total_peserta' => $ranking->count(),
                'semester'      => $semesterAktif->nama_semester,
                'kategori'      => 'Ujian ' . $jenisUjian,
            ];
        }

        return [$hasil['Ziyadah'], $hasil['Murajaah']];
    }

    public function index()
    {

        $ziyadah = JadwalHafalan::where('jenis_hafalan', 'ziyadah')->get();
        $murajaah = JadwalHafalan::where('jenis_hafalan', "murajaah")->get();
        $santri_count = Santri::all()->count();
        $ustad = Ustadzah::all()->count();
        $pencatatan_hafalan = PencatatanHafalan::all()->count();
        $santri_lulus = Santri::all()->where('status_santri', 'Lulus')->count();
        $walisantri = null;
        $infoRankingZiyadah = null;
        $infoRankingMurajaah = null;
        $semesters = Semester::where('jenis_hafalan', 'ziyadah')->get();

        $filter = request('filter_semester');
        $filterJenisUjian = request('filter_jenis_ujian');

        $jadwalQuery = JadwalUjian::with(['santri', 'semester', 'pembimbingPutra', 'pembimbingPutri'])
            // ->when($filter, function ($query) use ($filter) {
            //     $query->where('semester_id', $filter);
            // })
            ->where('jenis_ujian', 'ziyadah')
            ->orWhere('jenis_ujian', 'murajaah')
            ->when($filterJenisUjian, function ($query) use ($filterJenisUjian) {
                $query->where('jenis_ujian', $filterJenisUjian);
            });
        $jadwalTasmiQuery = JadwalUjianTasmi::with(['santri', 'semester', 'pembimbingPutra', 'pembimbingPutri'])
            // ->when($filter, function ($query) use ($filter) {
            //     $query->where('semester_id', $filter);
            // })
            ->when($filterJenisUjian, function ($query) use ($filterJenisUjian) {
                $query->where('jenis_ujian', $filterJenisUjian);
            });

      
        $santri = null;

        if (Auth::user()->role === 'santri') {
            $santri = Auth::user()->santri;
        }

        if (Auth::user()->role === 'walisantri') {
            $walisantri = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
            $santri = $walisantri?->santri;
        }

        if ($santri) {
            $jadwalTasmiQuery->where('santri_id', $santri->id);

            // 🔥 PANGGIL SATU LOGIC SAJA
            [$infoRankingZiyadah, $infoRankingMurajaah] = $this->hitungRankingDashboard($santri);
        } else {
            $jadwalTasmiQuery->whereNull('id');
        }


        $jadwal = $jadwalQuery->orderBy('tanggal', 'asc')->get();
        $jadwalTasmi = $jadwalTasmiQuery->orderBy('tanggal', 'asc')->get();

        if (Auth::user()->role === 'santri') {
            $santri_personal = Santri::where('user_id', Auth::id())->first();
            return view('pages.dashboard' , compact('ziyadah', 'infoRankingZiyadah', 'infoRankingMurajaah','semesters', 'jadwal', 'jadwalTasmi', 'murajaah', 'santri', 'santri_personal', 'santri_count', 'ustad', 'pencatatan_hafalan', 'santri_lulus'));
        }
        return view('pages.dashboard' , compact('ziyadah', 'infoRankingZiyadah', 'infoRankingMurajaah', 'semesters', 'jadwal', 'walisantri', 'jadwalTasmi', 'murajaah', 'santri_count', 'ustad', 'pencatatan_hafalan', 'santri_lulus'));
    }
}
