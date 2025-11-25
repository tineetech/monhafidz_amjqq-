<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanUjian extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_ujian';

    protected $fillable = [
        'jadwal_ujian_id',
        'ustadzah_id',
        'tanggal',
        'nilai_ujian',
        'nilai_tajwid',
        'nilai_kelancaran',
        'kesalahan',
        'nilai_akhir',
        'status_ujian',
    ];
    // Relasi ke JadwalUjian
    public function jadwalUjian()
    {
        return $this->belongsTo(JadwalUjian::class);
    }

    // Relasi ke Ustadzah (penilai)
    public function ustadzah()
    {
        return $this->belongsTo(Ustadzah::class);
    }
}