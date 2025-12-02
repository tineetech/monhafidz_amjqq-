<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Services\MpwaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotifikasiController extends Controller
{
    public function wablast(Request $request)
    {
        $request->validate([
            'id_santri'     => 'required|integer',
            'no_template'   => 'required|in:1,2,3',
            'tujuan'        => 'required|in:santri,ortu'
        ]);

        // Ambil data santri
        $santri = Santri::with('wali')->find($request->id_santri);

        if (!$santri) {
            return response()->json(['status' => false, 'msg' => 'Santri tidak ditemukan'], 404);
        }

        // Tentukan nomor tujuan
        if ($request->tujuan == 'santri') {
            $phone = $santri->no_hp;
            $nama  = $santri->nama_lengkap;
        } else {
            if ($santri->wali && $santri->wali->no_hp) {
                $phone = $santri->wali->no_hp;
                $nama  = $santri->wali->nama_lengkap;
            } else {
                // fallback ke nomor santri
                $phone = $santri->no_hp;
                $nama  = $santri->nama_ortu ?? "Bapak/Ibu";
            }

            $subjek = 'Anak ibu/bapak';
        }

        if (!$phone) {
            return response()->json(['status' => false, 'msg' => 'Nomor tujuan tidak tersedia'], 422);
        }

        $subjek = $request->tujuan == 'santri' ? 'Kamu' : 'Anak ibu/bapak';

        // Template pesan
        $templateList = [
            1 => "Assalamu’alaikum, {nama}. Pada semester ini, Anda belum mencapai target ziyadah yang ditentukan. Target per semester adalah 5 juz. Mohon memperbanyak setoran supaya target tercapai. Jika perlu bantuan, hubungi ustadz pembimbing.",
            
            2 => "Assalamu’alaikum, {nama}. Pada semester ini, Anda belum mencapai target muroja’ah yang ditentukan. Diharapkan untuk lebih rutin mengulang hafalan. Target muroja’ah per semester adalah 10 juz. Mohon terus bersemangat.",
            
            3 => "Assalamu’alaikum, {nama}. Alhamdulillah, Anda telah mencapai target muroja’ah/ziyadah semester ini. Terus pertahankan hafalannya. Semoga Allah memberikan keberkahan."
        ];

        $text = str_replace('{nama}', $nama, $templateList[$request->no_template]);

        // Kirim WA
        try {
            MpwaService::sendMessage($phone, $text);

            return response()->json([
                'status' => true,
                'msg' => "Pesan berhasil dikirim",
                'nomor' => $phone,
                'isi'   => $text
            ]);

        } catch (\Exception $e) {
            Log::error("Gagal kirim WA ke $phone: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'msg' => "Gagal mengirim pesan",
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
