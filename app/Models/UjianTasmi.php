<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UjianTasmi extends Model
{
    protected $table = 'ujian_tasmi';

    protected $fillable = [
        'jadwal_ujian_id',
        'santri_id',
        'semester_id',
        'tanggal',
        'ustadzah_id',
        'tanggal_tasmi',
        'juz_yang_ditasmi',
        'status_ujian',
        'catatan',
    ];
    // Relasi ke JadwalUjian
    public function jadwalUjian()
    {
        return $this->belongsTo(JadwalUjian::class);
    }
    
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
    
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Relasi ke Ustadzah (penilai)
    public function ustadzah()
    {
        return $this->belongsTo(Ustadzah::class);
    }
}
