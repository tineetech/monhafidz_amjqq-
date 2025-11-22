<?php

namespace App\Http\Controllers;

use App\Models\JadwalHafalan;
use App\Models\JadwalUjian;
use App\Models\PencatatanHafalan;
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
        // dd($murajaah);
        // dd(Auth::user()->santri);
        $semesters = Semester::where('jenis_hafalan', 'ziyadah')->get();

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

        if (Auth::user()->role === 'santri') {
            $santri_personal = Santri::where('user_id', Auth::id())->first();
            return view('pages.dashboard' , compact('ziyadah','semesters', 'jadwal', 'murajaah', 'santri', 'santri_personal', 'ustad', 'pencatatan_hafalan', 'santri_lulus'));
        }
        return view('pages.dashboard' , compact('ziyadah', 'semesters', 'jadwal', 'murajaah', 'santri_count', 'ustad', 'pencatatan_hafalan', 'santri_lulus'));
    }
}
