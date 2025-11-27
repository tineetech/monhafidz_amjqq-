<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUjianTasmi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ujian_tasmi';

    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'jenis_ujian',
        'tempat',
        'santri_id',
        'semester_id',
        'pembimbing_putra_id',
        'pembimbing_putri_id',
        'is_bertahap',
        'tahap',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_bertahap' => 'boolean',
    ];

    // ============================
    //          RELASI
    // ============================

    /** relasi ke tabel santri */
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    /** relasi ke tabel semester */
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    /** relasi ke ustadz/ustadzah pembimbing putra */
    public function pembimbingPutra()
    {
        return $this->belongsTo(Ustadzah::class, 'pembimbing_putra_id');
    }

    /** relasi ke ustadzah pembimbing putri */
    public function pembimbingPutri()
    {
        return $this->belongsTo(Ustadzah::class, 'pembimbing_putri_id');
    }

    /** jika ada relasi ke ujian tasmi */
    public function ujianTasmi()
    {
        return $this->hasMany(UjianTasmi::class);
    }
}
