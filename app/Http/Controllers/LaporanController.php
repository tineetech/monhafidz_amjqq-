<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\PencatatanHafalan;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\Ustadzah;
use App\Models\WaliSantri;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $role = Auth::check() ? Auth::user()->role : null;
        $userId = Auth::check() ? Auth::id() : null;

        // Default query santri
        $santriQuery = Santri::query();

        if ($role === 'santri' && $userId) {

            // Santri hanya lihat dirinya
            $santri = Santri::where('user_id', $userId)->get();

        } else if ($role === 'walisantri' && $userId) {

            // Walisantri hanya lihat anaknya
            $walisantri = WaliSantri::where('user_id', $userId)->first();
            $santri = Santri::where('id', $walisantri->santri_id)->get();

        } else if ($role === 'ustad') {

            // Ustad hanya melihat santri berdasarkan jenis kelamin yang sama
            $ustad = Auth::user()->ustad;

            if ($ustad) {
                $santri = $santriQuery
                    ->where('jenis_kelamin', $ustad->jenis_kelamin)
                    ->orderBy('nama_lengkap', 'asc')
                    ->get();
            } else {
                // Jika relasi ustad tidak ditemukan → kosongkan
                $santri = collect([]);
            }

        } else {

            // Role admin atau lainnya → melihat semua santri
            $santri = Santri::all();
        }

        $semesters = Semester::where('jenis_hafalan', 'ziyadah')->get();

        return view('pages.laporan.index', compact('santri', 'semesters'));
    }

    public function chartZiyadah(Request $request)
    {
        $role = $request->get('role', 'admin'); // default admin
        $userId = $request->get('user_id');     // id user jika role santri

        $semesters = Semester::orderBy('id')->where('jenis_hafalan', 'ziyadah')->get();

        if ($role === 'santri' && $userId) {
            $santri = Santri::where('user_id', $userId)->get();
        } else if ($role === 'walisantri' && $userId) {
            $walisantri = WaliSantri::where('user_id', $userId)->first();
            $santri = Santri::where('id', $walisantri->santri_id)->get();
        } else {
            $santri = Santri::all();
        }

        $datasets = [];

        foreach ($santri as $s) {
            $data = [];

            foreach ($semesters as $semester) {
                $total = $s->pencatatanHafalan()
                    ->where('semester_id', $semester->id)
                    ->where('jenis_hafalan', 'ziyadah')
                    ->sum('juz_tercapai');

                $data[] = $total;
            }

            $datasets[] = [
                'label' => $s->nama_lengkap,
                'data'  => $data,
                'borderColor' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
                'fill'  => false,
                'tension' => 0.3
            ];
        }

        // --- DISTRIBUSI JUZ --- //
        $totalSantri = $santri->count();
        $distribusi = array_fill(1, 30, 0); // juz 1–30, default 0

        foreach ($santri as $s) {

            // total juz hafalan santri ini
            $total = $s->pencatatanHafalan()
                ->where('jenis_hafalan', 'ziyadah')
                ->sum('juz_tercapai');

            // posisi juz saat ini (dibulatkan ke bawah)
            $posisi = floor($total);

            if ($posisi < 1) $posisi = 1;
            if ($posisi > 30) $posisi = 30;

            // tambahkan ke distribusi
            $distribusi[$posisi]++;
        }

        // ubah jadi persentase
        $persentaseJuz = [];
        foreach ($distribusi as $juz => $jumlah) {
            $persentase = $totalSantri > 0 ? ($jumlah / $totalSantri * 100) : 0;
            $persentaseJuz[] = round($persentase, 2);
        }

        return response()->json([
            'labels'         => $semesters->pluck('nama_semester'),
            'datasets'       => $datasets,
            'donut_labels'   => range(1, 30), // label DONUT = juz 1 - juz 30
            'donut_dataset'  => $persentaseJuz
        ]);
    }

    // public function getLaporanHafalan(Request $request)
    // {
    //     $santri = Santri::find($request->santri_id);
    //     if (!$santri) {
    //         return response()->json(['message' => 'Santri tidak ditemukan'], 404);
    //     }
        
    //     $jenis_hafalan = $request->jenis_hafalan;
    //     $target = $jenis_hafalan === 'Ziyadah' ? 5 : 10;

    //     $pembimbing = Ustadzah::where('nama_lengkap', $santri->jenis_kelamin == 'Laki-laki' ? 'Ustadz Sabiq mujahid' : 'Ustadzah Nuraisyah')->first();
    //     // Ambil semester
    //     $semester = Semester::where('nama_semester', $request->semester)->first();
    //     if (!$semester) {
    //         return response()->json(['message' => 'Semester tidak ditemukan'], 404);
    //     }

    //     // generate bulan dari periode_mulai → periode_selesai
    //     $start = \Carbon\Carbon::parse($semester->periode_mulai)->startOfMonth();
    //     $end   = \Carbon\Carbon::parse($semester->periode_selesai)->startOfMonth();

    //     $months = [];
    //     while ($start <= $end) {
    //         $months[] = $start->translatedFormat('F Y'); // Contoh: Januari 2025
    //         $start->addMonth();
    //     }

    //     // Ambil hafalan bulan per bulan
    //     $data = [];
    //     foreach ($months as $m) {
    //         $bulan = \Carbon\Carbon::parse($m)->month;
    //         $tahun = \Carbon\Carbon::parse($m)->year;

    //         // contoh: ambil data hafalan santri per bulan
    //         $result = PencatatanHafalan::where('santri_id', $santri->id)
    //             ->whereYear('tanggal', $tahun)
    //             ->whereMonth('tanggal', $bulan)
    //             ->where('jenis_hafalan', $request->jenis_hafalan)
    //             ->get();

    //         $resultAll = PencatatanHafalan::where('santri_id', $santri->id)
    //             ->where('jenis_hafalan', $request->jenis_hafalan)
    //             ->get();

    //         $jumlahJuz = $result->sum('juz_tercapai');
    //         $jumlahJuzAll = $resultAll->sum('juz_tercapai');

    //         $data[] = [
    //             'bulan' => $m,
    //             'surah_juz' => $result->pluck('surah_ayat')->implode(', ') ?: '-',
    //             'jumlah_juz' => $jumlahJuz,
    //             'target' => $target ?: 0,
    //             'persentase' => $jumlahJuz && $target
    //                 ? round(($jumlahJuz / $target) * 100, 2)
    //                 : 0,
    //             'persentase_all' => $jumlahJuzAll && $target
    //                 ? round(($jumlahJuzAll / $target) * 100, 2)
    //                 : 0,
    //             'nilai' => ($result->avg('nilai_tajwid') + $result->avg('nilai_kelancaran')) / 2 ?: '-',
    //             'keterangan' => $result->pluck('keterangan')->implode(', ') ?: '-',
    //         ];
    //     }

    //     return response()->json([
    //         'santri' => $santri,
    //         'pembimbing' => $pembimbing ? $pembimbing->nama_lengkap : 'Tidak ada pembimbing',
    //         'semester' => $request->semester,
    //         'jenis_hafalan' => $request->jenis_hafalan,
    //         'periode' => $semester->periode_mulai . ' s/d ' . $semester->periode_selesai,
    //         'data' => $data
    //     ]);
    // }

    public function chartAbsensi(Request $request)
    {
        $role = $request->get('role');
        $userId = $request->get('user_id');

        // Ambil data absensi
        $absensiQuery = Absensi::query();

        // Jika santri login → filter hanya santri itu
        if ($role === 'santri') {
            $santri = Santri::where('user_id', $userId)->first();
            if ($santri) {
                $absensiQuery->where('santri_id', $santri->id);
            }
        }

        // Jika wali santri login
        if ($role === 'walisantri') {
            $wali = WaliSantri::where('user_id', $userId)->first();
            if ($wali) {
                $absensiQuery->where('santri_id', $wali->santri_id);
            }
        }

        // Hitung total status absensi
        $hadir = (clone $absensiQuery)->where('status', 'Hadir')->count();
        $izin = (clone $absensiQuery)->where('status', 'Izin')->count();
        $alpha = (clone $absensiQuery)->where('status', 'Alpha')->count();

        return response()->json([
            'labels' => ['Hadir', 'Izin', 'Alpha'],
            'dataset' => [$hadir, $izin, $alpha],
            'colors' => ['#2ecc71', '#f1c40f', '#e74c3c'] // hijau, kuning, merah
        ]);
    }

    
    public function getLaporanHafalan(Request $request)
    {
        $santri = Santri::find($request->santri_id);
        if (!$santri) {
            return response()->json(['message' => 'Santri tidak ditemukan'], 404);
        }

        $jenis_hafalan = $request->jenis_hafalan;
        $target = $jenis_hafalan === 'Ziyadah' ? 5 : 10;

        $pembimbing = Ustadzah::where('nama_lengkap', $santri->jenis_kelamin == 'Laki-laki'
            ? 'Ustadz Sabiq Mujahid'
            : 'Ustadzah Nuraisyah')->first();

        // Ambil semester
        $semester = Semester::where('nama_semester', $request->semester)->first();
        if (!$semester) {
            return response()->json(['message' => 'Semester tidak ditemukan'], 404);
        }

        // =====================================================
        // 📊 Tambahkan Ranking Berdasarkan PencatatanUjian
        // =====================================================
        $jenis_kelamin = $santri->jenis_kelamin;

        $ranking = \App\Models\PencatatanUjian::with(['santri'])
            ->whereHas('santri', function ($q) use ($jenis_kelamin) {
                $q->where('jenis_kelamin', $jenis_kelamin);
            })
            ->where('semester_id', $semester->id)
            ->where('jenis_ujian', $jenis_hafalan)
            ->selectRaw('santri_id, AVG(nilai_akhir) as rata_rata')
            ->groupBy('santri_id')
            ->orderByDesc('rata_rata')
            ->get();


        // Ambil nama santri juara 1, 2, 3
        $juara1 = $ranking->get(0) ? Santri::find($ranking->get(0)->santri_id)->nama_lengkap : '-';
        $juara2 = $ranking->get(1) ? Santri::find($ranking->get(1)->santri_id)->nama_lengkap : '-';
        $juara3 = $ranking->get(2) ? Santri::find($ranking->get(2)->santri_id)->nama_lengkap : '-';

        // =====================================================
        // 📅 Generate data hafalan bulanan (seperti semula)
        // =====================================================
        $start = \Carbon\Carbon::parse($semester->periode_mulai)->startOfMonth();
        $end   = \Carbon\Carbon::parse($semester->periode_selesai)->startOfMonth();

        $months = [];
        while ($start <= $end) {
            $months[] = $start->translatedFormat('F Y');
            $start->addMonth();
        }

        $data = [];
        foreach ($months as $m) {
            $bulan = \Carbon\Carbon::parse($m)->month;
            $tahun = \Carbon\Carbon::parse($m)->year;

            $result = \App\Models\PencatatanHafalan::where('santri_id', $santri->id)
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->where('jenis_hafalan', $jenis_hafalan)
                ->get();

            $resultAll = \App\Models\PencatatanHafalan::where('santri_id', $santri->id)
                ->where('jenis_hafalan', $jenis_hafalan)
                ->whereBetween('tanggal', [
                    $semester->periode_mulai,
                    $semester->periode_selesai
                ])
                ->get();

            $jumlahJuz = $result->sum('juz_tercapai');
            $jumlahJuzAll = $resultAll->sum('juz_tercapai');

            $data[] = [
                'bulan' => $m,
                'surah_juz' => $result->pluck('surah_ayat')->implode(', ') ?: '-',
                'jumlah_juz' => $jumlahJuz,
                'target' => $target ?: 0,
                'persentase' => $jumlahJuz && $target
                    ? round(($jumlahJuz / $target) * 100, 2)
                    : 0,
                'persentase_all' => $jumlahJuzAll && $target
                    ? round(($jumlahJuzAll / $target) * 100, 2)
                    : 0,
                'nilai' => ($result->avg('nilai_tajwid') + $result->avg('nilai_kelancaran')) / 2 ?: '-',
                'keterangan' => $result->pluck('keterangan')->implode(', ') ?: '-',
            ];
        }

        // =====================================================
        // 📤 Return response ke frontend
        // =====================================================
        return response()->json([
            'santri' => $santri,
            'pembimbing' => $pembimbing ? $pembimbing->nama_lengkap : 'Tidak ada pembimbing',
            'semester' => $request->semester,
            'jenis_hafalan' => $jenis_hafalan,
            'periode' => $semester->periode_mulai . ' s/d ' . $semester->periode_selesai,
            'juara1' => $juara1,
            'juara2' => $juara2,
            'juara3' => $juara3,
            'data' => $data
        ]);
    }

    public function exportPdf(Request $request)
    {
        $santri = Santri::find($request->santri_id);
        if (!$santri) return abort(404, "Santri tidak ditemukan");

        $jenis_hafalan = $request->jenis_hafalan;
        $target = $jenis_hafalan === 'Ziyadah' ? 5 : 10;

        $semester = Semester::where('nama_semester', $request->semester)->first();
        if (!$semester) return abort(404, "Semester tidak ditemukan");

        $pembimbing = Ustadzah::where(
            'nama_lengkap',
            $santri->jenis_kelamin == 'Laki-laki'
                ? 'Ustadz Sabiq Mujahid'
                : 'Ustadzah Nuraisyah'
        )->first();

        // =====================================================
        // 📊 Ranking sama dengan getLaporanHafalan()
        // =====================================================
        $jenis_kelamin = $santri->jenis_kelamin;

        $ranking = \App\Models\PencatatanUjian::with(['santri'])
            ->whereHas('santri', function ($q) use ($jenis_kelamin) {
                $q->where('jenis_kelamin', $jenis_kelamin);
            })
            ->where('semester_id', $semester->id)
            ->where('jenis_ujian', $jenis_hafalan)
            ->selectRaw('santri_id, AVG(nilai_ujian) as rata_rata')
            ->groupBy('santri_id')
            ->orderByDesc('rata_rata')
            ->get();

        $juara1 = $ranking->get(0) ? Santri::find($ranking->get(0)->santri_id)->nama_lengkap : '-';
        $juara2 = $ranking->get(1) ? Santri::find($ranking->get(1)->santri_id)->nama_lengkap : '-';
        $juara3 = $ranking->get(2) ? Santri::find($ranking->get(2)->santri_id)->nama_lengkap : '-';


        // =====================================================
        // 📅 Generate Data Hafalan Bulanan
        // =====================================================
        $start = \Carbon\Carbon::parse($semester->periode_mulai)->startOfMonth();
        $end   = \Carbon\Carbon::parse($semester->periode_selesai)->startOfMonth();

        $months = [];
        while ($start <= $end) {
            $months[] = $start->translatedFormat('F Y');
            $start->addMonth();
        }

        $data = [];
        foreach ($months as $m) {
            $bulan = \Carbon\Carbon::parse($m)->month;
            $tahun = \Carbon\Carbon::parse($m)->year;

            $result = \App\Models\PencatatanHafalan::where('santri_id', $santri->id)
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->where('jenis_hafalan', $jenis_hafalan)
                ->get();

            $resultAll = \App\Models\PencatatanHafalan::where('santri_id', $santri->id)
                ->where('jenis_hafalan', $jenis_hafalan)
                ->get();

            $jumlahJuz = $result->sum('juz_tercapai');
            $jumlahJuzAll = $resultAll->sum('juz_tercapai');

            $data[] = [
                'bulan' => $m,
                'surah_juz' => $result->pluck('surah_ayat')->implode(', ') ?: '-',
                'jumlah_juz' => $jumlahJuz,
                'persentase' => $jumlahJuz && $target ? round(($jumlahJuz / $target) * 100, 2) : 0,
                'persentase_all' => $jumlahJuzAll && $target ? round(($jumlahJuzAll / $target) * 100, 2) : 0,
                'nilai' => ($result->avg('nilai_tajwid') + $result->avg('nilai_kelancaran')) / 2 ?: '-',
                'keterangan' => $result->pluck('keterangan')->implode(', ') ?: '-',
            ];
        }

        // =====================================================
        // 🧾 Generate PDF
        // =====================================================
        $pdf = Pdf::loadView('pdf.laporan-hafalan', [
            'santri' => $santri,
            'jenis_hafalan' => $jenis_hafalan,
            'semester' => $semester,
            'pembimbing' => $pembimbing ? $pembimbing->nama_lengkap : '-',
            'data' => $data,
            'target' => $target,
            'juara1' => $juara1,
            'juara2' => $juara2,
            'juara3' => $juara3,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream("Laporan Hafalan - {$santri->nama_lengkap}.pdf");
    }

    public function laporanAbsensi(Request $request)
    {
        $request->validate([
            'santri_id' => 'required',
            'semester_id' => 'required',
        ]);

        $santri = Santri::find($request->santri_id);
        if (!$santri) {
            return response()->json(['error' => 'Santri tidak ditemukan'], 404);
        }

        $semester = Semester::find($request->semester_id);
        if (!$semester) {
            return response()->json(['error' => 'Semester tidak ditemukan'], 404);
        }

        // Ambil periode semester
        $start = Carbon::parse($semester->periode_mulai)->startOfDay();
        $end   = Carbon::parse($semester->periode_selesai)->endOfDay();

        // Buat semua tanggal antara periode semester
        $rangeTanggal = [];
        for ($date = $start->copy(); $date <= $end; $date->addDay()) {
            $rangeTanggal[] = $date->format('Y-m-d');
        }

        // Ambil absensi dari DB sesuai semester
        $absensiDB = Absensi::where('santri_id', $santri->id)
            ->whereBetween('tanggal', [$start, $end])
            ->get()
            ->keyBy(function ($item) {
                return Carbon::parse($item->tanggal)->format('Y-m-d');
            });

        // Susun laporan
        $absensi = [];
        foreach ($rangeTanggal as $tgl) {

            $record = $absensiDB->get($tgl);

            $absensi[] = [
                'tanggal'    => Carbon::parse($tgl)->format('d-m-Y'),
                'bulan'      => Carbon::parse($tgl)->format('F'),
                'hadir'      => $record && $record->status == 'Hadir' ? 1 : 0,
                'izin'       => $record && $record->status == 'Izin' ? 1 : 0,
                'sakit'      => $record && $record->status == 'Sakit' ? 1 : 0,
                'alpa'       => $record && $record->status == 'Alpa' ? 1 : 0,
                'keterangan' => $record ? $record->catatan : null,
            ];
        }

        return response()->json([
            'santri' => [
                'nama_lengkap' => $santri->nama_lengkap
            ],
            'periode' => $semester->nama_semester . " (" .
                        Carbon::parse($semester->periode_mulai)->format('d M Y') . " - " .
                        Carbon::parse($semester->periode_selesai)->format('d M Y') . ")",
            'pembimbing' => $santri->pembimbing ?? '-',
            'data' => $absensi
        ]);
    }

     
    public function exportPdfAbsensi(Request $request)
    {
        $request->validate([
            'santri_id' => 'required',
            'semester_id' => 'required'
        ]);

        $santri = Santri::find($request->santri_id);
        if (!$santri) {
            abort(404, "Santri tidak ditemukan");
        }

        // Ambil semester berdasarkan semester_id
        $semester = Semester::find($request->semester_id);
        if (!$semester) {
            abort(404, "Semester tidak ditemukan");
        }

        // =============================
        // 📅 Generate bulan dalam semester
        // =============================
        $start = Carbon::parse($semester->periode_mulai)->startOfMonth();
        $end   = Carbon::parse($semester->periode_selesai)->startOfMonth();

        $allMonths = [];
        while ($start <= $end) {
            $allMonths[] = $start->copy();
            $start->addMonth();
        }

        $absensiSemester = [];

        foreach ($allMonths as $bulan) {

            $jumlahHari = $bulan->daysInMonth;

            // Semua tanggal dalam bulan itu
            $rangeTanggal = collect(range(1, $jumlahHari))
                ->map(fn($d) => $bulan->format("Y-m-") . str_pad($d, 2, "0", STR_PAD_LEFT));

            // Absensi bulan itu dari DB
            $absensiDB = Absensi::where('santri_id', $santri->id)
                ->whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->select(
                    DB::raw("DATE(tanggal) AS tgl_key"),
                    'status',
                    'catatan'
                )
                ->get()
                ->keyBy('tgl_key');

            foreach ($rangeTanggal as $tgl) {
                $row = $absensiDB->get($tgl);

                $absensiSemester[] = [
                    'tanggal' => Carbon::parse($tgl)->format('d-m-Y'),
                    'bulan'   => $bulan->translatedFormat('F Y'),
                    'hadir'   => $row && $row->status == 'Hadir' ? 1 : 0,
                    'izin'    => $row && $row->status == 'Izin' ? 1 : 0,
                    'sakit'   => $row && $row->status == 'Sakit' ? 1 : 0,
                    'alpa'    => $row && $row->status == 'Alpa' ? 1 : 0,
                    'keterangan' => $row->catatan ?? null,
                ];
            }
        }

        // =============================
        // 📊 Hitung total seluruh semester
        // =============================
        $totalHadir = collect($absensiSemester)->sum('hadir');
        $totalIzin  = collect($absensiSemester)->sum('izin');
        $totalSakit = collect($absensiSemester)->sum('sakit');
        $totalAlpa  = collect($absensiSemester)->sum('alpa');

        $totalPertemuan = $totalHadir + $totalIzin + $totalSakit + $totalAlpa;
        $persenHadir = $totalPertemuan > 0 ? round(($totalHadir / $totalPertemuan) * 100) : 0;
        $persenAlpa  = $totalPertemuan > 0 ? round(($totalAlpa / $totalPertemuan) * 100) : 0;

        // =============================
        // 🖨️ Generate PDF
        // =============================
        $pdf = PDF::loadView('pdf.laporan_absensi', [
            'santri' => $santri,
            'periode' => $semester->periode_mulai . " s/d " . $semester->periode_selesai,
            'pembimbing' => $santri->pembimbing ?? '-',
            'data' => $absensiSemester,
            'totalHadir' => $totalHadir,
            'totalIzin' => $totalIzin,
            'totalSakit' => $totalSakit,
            'totalAlpa' => $totalAlpa,
            'persenHadir' => $persenHadir,
            'persenAlpa' => $persenAlpa,
        ])->setPaper('a4');

        return $pdf->stream("Laporan-Absensi-{$santri->nama_lengkap}-Semester.pdf");
    }

}
