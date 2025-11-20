<?php

namespace App\Http\Controllers;

use App\Models\JadwalUjian;
use App\Models\Santri;
use App\Models\UjianTasmi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    
    public function generate30Juz(Request $request)
    {
        $request->validate([
            'id_santri' => 'required|string',
            'nama_ustad' => 'nullable|string',
        ]);

        $idSantri = $request->query('id_santri');
        $santri = Santri::where('id', $idSantri)->where('total_juz_tercapai', '>=', 30)->firstOrFail();
        $jadwalUjianTasmi = JadwalUjian::where('santri_id', $idSantri)->where('jenis_ujian', 'tasmi')->first();
        $findSantriInUjianTasmi = UjianTasmi::where('jadwal_ujian_id', $jadwalUjianTasmi->id)->where('status_ujian', 'selesai')->first();

        if (!$findSantriInUjianTasmi) {
            // dd('woi gaboleh');
            return abort(404, 'belum ada akses');            
        }

        $namaSantri = $santri->nama_lengkap;
        $tanggal    = now()->format('d F Y');
        $namaUstad  = $request->query('nama_ustad') ?? 'Ust. Sabiq Mujahid N';

        $pdf = Pdf::loadView('pdf.tahfidz30juz', compact(
            'namaSantri', 'tanggal', 'namaUstad'
        ))->setPaper('legal', 'landscape')
          ->setOption(['chroot' => public_path(), 'isFontSubsettingEnabled' => true, 'fontCache' => public_path('fonts')]);

        return $pdf->stream("Sertifikat-$namaSantri.pdf");
    }
    
    public function generateSertifikatKelulusan(Request $request)
    {
        $request->validate([
            'id_santri' => 'required|string',
        ]);

        $idSantri = $request->query('id_santri');

        $santri = Santri::where('id', $idSantri)
        ->where('status_santri', 'Lulus')
        ->whereHas('jadwalUjian', function ($q) {
            $q->where('jenis_ujian', 'ujian_akhir')
            ->whereHas('pencatatanUjian', function ($q2) {
                $q2->where('status_ujian', 'lulus');
            });
        })
        ->first();

        if (!$santri) {
            abort(404, 'Santri tidak memenuhi syarat untuk mendapatkan sertifikat kelulusan.');
        }


        $namaSantri = $santri->nama_lengkap;
        $tanggal    = now()->format('d-m-Y');

        $pdf = Pdf::loadView('pdf.kelulusan', compact('namaSantri', 'tanggal'))
            ->setPaper('legal', 'landscape')
            ->setOption([
                'chroot' => public_path(),
                'isFontSubsettingEnabled' => true,
                'fontCache' => public_path('fonts')
            ]);

        return $pdf->stream("SertifikatKelulusan-$namaSantri.pdf");
    }


    public function generateSertifikatPeringkat(Request $request)
    {
        $request->validate([
            'id_ujian' => 'required|string',
        ]);

        $idUjian = $request->query('id_ujian');

        // ambil data ujian ini
        $pencatatanUjian = \App\Models\PencatatanUjian::with([
            'jadwalUjian.santri',
            'jadwalUjian.semester'
        ])->findOrFail($idUjian);

        $semesterId = $pencatatanUjian->jadwalUjian->semester_id;
        $jenis = $pencatatanUjian->jadwalUjian->jenis_ujian;

        // ✅ ambil semua pencatatan pada semester & jenis yang sama
        $group = \App\Models\PencatatanUjian::with(['jadwalUjian.santri'])
            ->whereHas('jadwalUjian', function ($q) use ($semesterId, $jenis) {
                $q->where('semester_id', $semesterId)
                ->where('jenis_ujian', $jenis);
            })
            ->orderBy('nilai_ujian', 'DESC')
            ->get();

        // ✅ Tetapkan ranking
        $rank = 1;
        foreach ($group as $item) {
            if ($item->id == $pencatatanUjian->id) {
                $pencatatanUjian->rank = $rank;
                break;
            }
            $rank++;
        }

        // ✅ Batasi hanya top 3 yang boleh cetak
        if ($pencatatanUjian->rank > 3) {
            return back()->with('error', 'Maaf, hanya Peringkat 1-3 yang mendapat sertifikat.');
        }

        $namaSantri = $pencatatanUjian->jadwalUjian->santri->nama_lengkap;
        $nilai = $pencatatanUjian->nilai_ujian;
        $tanggal = Carbon::parse($pencatatanUjian->jadwalUjian->tanggal)->format('d-m-Y');
        $semester = ucfirst($pencatatanUjian->jadwalUjian->semester->nama_semester);

        // ✅ Render ke PDF
        $pdf = Pdf::loadView('pdf.sertifikat_peringkat', compact(
            'namaSantri',
            'nilai',
            'tanggal',
            'semester',
            'jenis',
            'pencatatanUjian'
        ))->setPaper('legal', 'landscape');

        return $pdf->stream("Sertifikat-{$namaSantri}-peringkat{$pencatatanUjian->rank}-ujian{$pencatatanUjian->jadwalUjian->jenis_ujian}-{$semester}.pdf");
    }

}
