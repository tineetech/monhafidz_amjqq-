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

        if (Auth::user()->role === 'santri') {
            $santri = Auth::user()->santri;

            if ($santri) {
                $jadwalTasmiQuery->where('santri_id', $santri->id);
                

                // Ambil semester aktif/terbaru
                $semesterAktif = Semester::where('id', $santri->semester_id)->first();

                // Hitung total santri berdasarkan gender & semester
                $totalPeserta = PencatatanUjian::where('jenis_ujian', 'Ziyadah')
                    ->where('semester_id', $semesterAktif->id)
                    ->orderBy('nilai_akhir', 'DESC')
                    ->count();

                // Buat ranking berdasarkan total_juz_tercapai
                $rankingList = PencatatanUjian::where('jenis_ujian', 'Ziyadah')
                    ->where('semester_id', $semesterAktif->id)
                    ->orderBy('nilai_akhir', 'DESC')
                    ->get();

                // Tentukan ranking santri
                $ranking = count($rankingList) !== 0 ? $rankingList->search(function($item) use ($santri) {
                    return $item->santri->id == $santri->id;
                }) + 1 : 0;
                $ranking = 0;

                if (count($rankingList) !== 0) {

                    $posisi = $rankingList->search(function($item) use ($santri) {
                        return $item->santri->id == $santri->id;
                    });

                    $ranking = ($posisi === false) ? 0 : ($posisi + 1);
                }

                if ($ranking === 0 ) {
                    $infoRankingZiyadah = null;
                } else {
                    // dd('tes');
                    $infoRankingZiyadah = [
                        'nama'          => $santri->nama_lengkap,
                        'gender'        => $santri->jenis_kelamin == 'Laki-laki' ? 'putra' : 'putri',
                        'ranking'       => $ranking,
                        'total_peserta' => $totalPeserta,
                        'semester'      => $semesterAktif->nama_semester,
                        'kategori'      => 'Ujian Ziyadah',
                    ];
                }

                // Hitung total santri berdasarkan gender & semester
                $totalPesertaMurajaah = PencatatanUjian::where('jenis_ujian', 'Murajaah')
                    ->where('semester_id', $semesterAktif->id)
                    ->orderBy('nilai_akhir', 'DESC')
                    ->count();

                // Buat ranking berdasarkan total_juz_tercapai
                $rankingListMurajaah = PencatatanUjian::where('jenis_ujian', 'Murajaah')
                    ->where('semester_id', $semesterAktif->id)
                    ->with(['santri'])
                    ->orderBy('nilai_akhir', 'DESC')
                    ->get();
                    // dd($rankingListMurajaah);
                    
                // Tentukan ranking santri
                $rankingMurajaah = 0;

                if (count($rankingListMurajaah) !== 0) {

                    $posisi = $rankingListMurajaah->search(function($item) use ($santri) {
                        return $item->santri->id == $santri->id;
                    });

                    $rankingMurajaah = ($posisi === false) ? 0 : ($posisi + 1);
                }
                if ($rankingMurajaah === 0) {
                    $infoRankingMurajaah = null;
                } else {
                    $infoRankingMurajaah = [
                        'nama'          => $santri->nama_lengkap,
                        'gender'        => $santri->jenis_kelamin == 'Laki-laki' ? 'putra' : 'putri',
                        'ranking'       => $rankingMurajaah,
                        'total_peserta' => $totalPesertaMurajaah,
                        'semester'      => $semesterAktif->nama_semester,
                        'kategori'      => 'Ujian Murajaah',
                    ];
                    
                }
            } else {
                $jadwalTasmiQuery->whereNull('id'); // biar hasil kosong kalau belum ada santri
            }
        }
        if (Auth::user()->role === 'walisantri') {
            $walisantri = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
            $santri = $walisantri->santri;

            if ($santri) {
                $jadwalTasmiQuery->where('santri_id', $santri->id);

                // Ambil semester aktif/terbaru
                $semesterAktif = Semester::where('id', $santri->semester_id)->first();

                // Hitung total santri berdasarkan gender & semester
                $totalPeserta = PencatatanUjian::where('jenis_ujian', 'Ziyadah')
                    ->where('semester_id', $semesterAktif->id)
                    ->orderBy('nilai_akhir', 'DESC')
                    ->count();

                // Buat ranking berdasarkan total_juz_tercapai
                $rankingList = PencatatanUjian::where('jenis_ujian', 'Ziyadah')
                    ->where('semester_id', $semesterAktif->id)
                    ->orderBy('nilai_akhir', 'DESC')
                    ->get();

                // Tentukan ranking santri
                $ranking = count($rankingList) !== 0 ? $rankingList->search(function($item) use ($santri) {
                    return $item->santri->id == $santri->id;
                }) + 1 : 0;
                $ranking = 0;

                if (count($rankingList) !== 0) {

                    $posisi = $rankingList->search(function($item) use ($santri) {
                        return $item->santri->id == $santri->id;
                    });

                    $ranking = ($posisi === false) ? 0 : ($posisi + 1);
                }

                if ($ranking === 0 ) {
                    $infoRankingZiyadah = null;
                } else {
                    $infoRankingZiyadah = [
                        'nama'          => $santri->nama_lengkap,
                        'gender'        => $santri->jenis_kelamin == 'Laki-laki' ? 'putra' : 'putri',
                        'ranking'       => $ranking,
                        'total_peserta' => $totalPeserta,
                        'semester'      => $semesterAktif->nama_semester,
                        'kategori'      => 'Ujian Ziyadah',
                    ];
                }

                // Hitung total santri berdasarkan gender & semester
                $totalPesertaMurajaah = PencatatanUjian::where('jenis_ujian', 'Murajaah')
                    ->where('semester_id', $semesterAktif->id)
                    ->orderBy('nilai_akhir', 'DESC')
                    ->count();

                // Buat ranking berdasarkan total_juz_tercapai
                $rankingListMurajaah = PencatatanUjian::where('jenis_ujian', 'Murajaah')
                    ->where('semester_id', $semesterAktif->id)
                    ->with(['santri'])
                    ->orderBy('nilai_akhir', 'DESC')
                    ->get();
                    // dd($rankingListMurajaah);
                    
                // Tentukan ranking santri
                $rankingMurajaah = 0;

                if (count($rankingListMurajaah) !== 0) {

                    $posisi = $rankingListMurajaah->search(function($item) use ($santri) {
                        return $item->santri->id == $santri->id;
                    });

                    $rankingMurajaah = ($posisi === false) ? 0 : ($posisi + 1);
                }
                if ($rankingMurajaah === 0) {
                    $infoRankingMurajaah = null;
                } else {
                    $infoRankingMurajaah = [
                        'nama'          => $santri->nama_lengkap,
                        'gender'        => $santri->jenis_kelamin == 'Laki-laki' ? 'putra' : 'putri',
                        'ranking'       => $rankingMurajaah,
                        'total_peserta' => $totalPesertaMurajaah,
                        'semester'      => $semesterAktif->nama_semester,
                        'kategori'      => 'Ujian Murajaah',
                    ];
                    
                }


            } else {
                $jadwalTasmiQuery->whereNull('id'); // biar hasil kosong kalau belum ada santri
            }
        }

        $jadwal = $jadwalQuery->orderBy('tanggal', 'asc')->get();
        $jadwalTasmi = $jadwalTasmiQuery->orderBy('tanggal', 'asc')->get();

        if (Auth::user()->role === 'santri') {
            $santri_personal = Santri::where('user_id', Auth::id())->first();
            return view('pages.dashboard' , compact('ziyadah', 'infoRankingZiyadah', 'infoRankingMurajaah','semesters', 'jadwal', 'jadwalTasmi', 'murajaah', 'santri', 'santri_personal', 'ustad', 'pencatatan_hafalan', 'santri_lulus'));
        }
        return view('pages.dashboard' , compact('ziyadah', 'infoRankingZiyadah', 'infoRankingMurajaah', 'semesters', 'jadwal', 'walisantri', 'jadwalTasmi', 'murajaah', 'santri_count', 'ustad', 'pencatatan_hafalan', 'santri_lulus'));
    }
}
