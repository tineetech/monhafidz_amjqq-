<?php

namespace App\Http\Controllers;

use App\Models\JadwalHafalan;
use App\Models\PencatatanHafalan;
use App\Models\PencatatanUjian;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\Ustadzah;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // ==============================================
        // BAGIAN 1. DATA STATISTIK BERANDA
        // ==============================================
        $santri = Santri::count();
        $ustad = Ustadzah::count();
        $pencatatan_hafalan = PencatatanHafalan::count();
        $santri_lulus = Santri::where('status_santri', 'Lulus')->count();
        $wisudawan_tahfidz = Santri::where('status_santri', 'Lulus')->get();


        // ==============================================
        // BAGIAN 2. AMBIL SEMESTER TERBARU
        // Berdasarkan periode_mulai paling besar
        // ==============================================
        $now = date('Y-m-d');
        $semesterTerbaru =  Semester::where('periode_mulai', '<=', $now)
                            ->where('periode_selesai', '>=', $now)
                            ->first();
        // dd($semesterTerbaru);

        if (!$semesterTerbaru) {
            // dd('tes');
            return view('beranda', compact(
                'santri','ustad','pencatatan_hafalan',
                'santri_lulus','wisudawan_tahfidz'
            ));
        }


        // ==============================================
        // BAGIAN 3. AMBIL SEMUA UJIAN DI SEMESTER TERBARU
        // ==============================================
        $ujian = PencatatanUjian::with(['jadwalUjian.santri', 'jadwalUjian.semester'])
            ->whereHas('jadwalUjian', function ($q) use ($semesterTerbaru) {
                $q->where('semester_id', $semesterTerbaru->id);
            })
            ->get();


        // ==============================================
        // BAGIAN 4. LOGIC RANKING (SEPERTI YANG SUDAH KAMU BUAT)
        // ==============================================
        $groupSemester = $ujian->groupBy('jadwalUjian.semester_id');

        foreach ($groupSemester as $semesterId => $dataSemester) {

            $groupJenis = $dataSemester->groupBy('jadwalUjian.jenis_ujian');

            foreach ($groupJenis as $jenis => $dataJenis) {

                $totalPeserta = $dataJenis->count();
                $sudahUjian = $dataJenis->whereNotNull('nilai_ujian')->count();

                $sorted = $dataJenis->sortByDesc('nilai_ujian')->values();
                $rank = 1;

                // Belum lengkap = ranking null
                if ($totalPeserta == 0 || $sudahUjian < $totalPeserta) {
                    foreach ($sorted as $item) {
                        $item->rank = null;
                    }
                    continue;
                }

                // Jika lengkap → beri ranking
                foreach ($sorted as $item) {
                    $item->rank = $rank++;
                }
            }
        }

        // Filter hanya yang sudah rank
        $rankingFinal = $ujian->filter(fn($x) => $x->rank !== null);

        // dd($rankingFinal);
        // ==============================================
        // BAGIAN 5. KELOMPOKKAN BERDASARKAN JENIS UJIAN & GENDER
        // ==============================================
        $kelompokRanking = [
            'murajaah' => [
                'laki-laki' => [],
                'perempuan' => [],
            ],
            'ziyadah' => [
                'laki-laki' => [],
                'perempuan' => [],
            ],
            'ujian_akhir' => [
                'laki-laki' => [],
                'perempuan' => [],
            ],
        ];

        foreach ($rankingFinal as $item) {

            $jenis = $item->jadwalUjian->jenis_ujian;
            $gender = strtolower($item->jadwalUjian->santri->jenis_kelamin); // putra/putri

            if (!isset($kelompokRanking[$jenis])) continue;

            $kelompokRanking[$jenis][$gender][] = $item;
        }


        // ==============================================
        // BAGIAN 6. AMBIL TOP 3 SETIAP KATEGORI
        // ==============================================
        foreach ($kelompokRanking as $jenis => $genderGroup) {
            usort($genderGroup['laki-laki'], function ($a, $b) {
             return $b->nilai_ujian <=> $a->nilai_ujian;
            });

            usort($genderGroup['perempuan'], function ($a, $b) {
             return $b->nilai_ujian <=> $a->nilai_ujian;
            });

            // Ambil Top 3 setelah sorting
            $kelompokRanking[$jenis]['laki-laki'] = array_slice($genderGroup['laki-laki'], 0, 3);
            $kelompokRanking[$jenis]['perempuan'] = array_slice($genderGroup['perempuan'], 0, 3);
        }
        // dd($kelompokRanking);

        // ==============================================
        // BAGIAN 7. RETURN KE BERANDA
        // ==============================================
        return view('beranda', compact(
            'santri',
            'ustad',
            'pencatatan_hafalan',
            'santri_lulus',
            'wisudawan_tahfidz',
            'kelompokRanking',
            'semesterTerbaru'
        ));
    }

}
