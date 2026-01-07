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
        $santri = Santri::where('id', $idSantri)->where('total_juz_tercapai', '>=', 30)->first();
        if (!$santri) {
            // abort(404, 'Santri tidak memenuhi syarat untuk mendapatkan sertifikat 30 Juz.');
            return view('pdf.belum-ada-akses')->with('message', 'Santri tidak memenuhi syarat untuk mendapatkan sertifikat 30 Juz.');
        }
        // $jadwalUjianTasmi = JadwalUjian::where('santri_id', $idSantri)->where('jenis_ujian', 'tasmi')->first();
        // if (!$jadwalUjianTasmi) {
        //     // dd('woi gaboleh');
        //     return view('pdf.belum-ada-akses')->with('message', 'Santri tidak memenuhi syarat untuk mendapatkan sertifikat 30 Juz.');
        //     // return abort(404, 'belum ada akses');
        // }
        
        // $findSantriInUjianTasmi = UjianTasmi::where('santri_id', $idSantri)->where('status_ujian', 'selesai')->first();
        // if (!$findSantriInUjianTasmi) {
        //     // dd('woi gaboleh');
        //     return view('pdf.belum-ada-akses')->with('message', 'Santri tidak memenuhi syarat untuk mendapatkan sertifikat 30 Juz.');
        //     // return abort(404, 'belum ada akses');
        // }

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
        // ->where('status_santri', 'Lulus')
        ->whereHas('ujianTasmi', function ($q) {
            $q->where('status_ujian', 'selesai');
        })
            // ->whereHas('pencatatanUjian', function ($q2) {
            //     $q2->where('status_ujian', 'lulus');
            // });
        // })
        ->first();

        if (!$santri) {
            return view('pdf.belum-ada-akses')->with('message', 'Santri tidak memenuhi syarat untuk mendapatkan sertifikat kelulusan.');
            // abort(404, 'Santri tidak memenuhi syarat untuk mendapatkan sertifikat kelulusan.');
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

        // Ambil data ujian
        $pencatatanUjian = \App\Models\PencatatanUjian::with([
            'santri', 'semester'
        ])->findOrFail($idUjian);

        $semesterId = $pencatatanUjian->semester_id;
        $jenis = $pencatatanUjian->jenis_ujian;
        $gender = $pencatatanUjian->santri->jenis_kelamin;

        // ===============================================================
        // 1) Ambil semua pencatatan ujian semester ini + jenis ini + gender sama
        // ===============================================================
        $group = \App\Models\PencatatanUjian::with(['santri', 'semester'])
            ->where('semester_id', $semesterId)
            ->where('jenis_ujian', $jenis)
            ->whereHas('santri', function ($q) use ($gender) {
                $q->where('jenis_kelamin', $gender);
            })
            ->get();

        // ===============================================================
        // 2) Hitung total peserta gender ini
        // ===============================================================
        $totalPeserta = \App\Models\PencatatanUjian::where('semester_id', $semesterId)
            ->where('jenis_ujian', $jenis)
            ->whereHas('santri', function ($q) use ($gender) {
                $q->where('jenis_kelamin', $gender);
            })
            ->distinct('santri_id')
            ->count('santri_id');

        // Sudah ikut ujian
        $sudahUjian = $group->count();

        // ===============================================================
        // 3) Sorting nilai akhir desc
        // ===============================================================
        $sorted = $group->sortByDesc('nilai_akhir')->values();

        // ===============================================================
        // 4) Cek kelengkapan peserta per gender
        // ===============================================================
        if ($totalPeserta == 0 || $sudahUjian < $totalPeserta) {
            $pencatatanUjian->rank = null;

            return back()->with(
                'error',
                'Ranking belum dapat ditentukan karena peserta ujian (berdasarkan gender) belum lengkap.'
            );
        }

        // ===============================================================
        // 5) Tetapkan ranking
        // ===============================================================
        $rank = 1;
        foreach ($sorted as $item) {
            if ($item->id == $pencatatanUjian->id) {
                $pencatatanUjian->rank = $rank;
                break;
            }
            $rank++;
        }

        // ===============================================================
        // 6) Batasi hanya peringkat 1–3 yang boleh cetak sertifikat
        // ===============================================================
        if (!$pencatatanUjian->rank || $pencatatanUjian->rank > 3) {
            return back()->with('error', 'Maaf, hanya Peringkat 1-3 dalam kelompok gender yang mendapat sertifikat.');
        }

        // ===============================================================
        // 7) Generate PDF
        // ===============================================================
        $namaSantri = $pencatatanUjian->santri->nama_lengkap;
        $nilai = $pencatatanUjian->nilai_ujian;
        $tanggal = \Carbon\Carbon::parse($pencatatanUjian->tanggal)->format('d-m-Y');
        $semester = ucfirst($pencatatanUjian->semester->nama_semester);

        $pdf = Pdf::loadView('pdf.sertifikat_peringkat', compact(
            'namaSantri',
            'nilai',
            'tanggal',
            'semester',
            'jenis',
            'pencatatanUjian'
        ))->setPaper('legal', 'landscape');

        return $pdf->stream("Sertifikat-{$namaSantri}-peringkat{$pencatatanUjian->rank}-{$jenis}-{$semester}.pdf");
    }

}
