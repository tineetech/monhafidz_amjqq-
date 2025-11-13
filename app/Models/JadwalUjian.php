<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    use HasFactory;

    protected $table = "jadwal_ujian";
    protected $fillable = [
        'santri_id',
        'semester_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'pembimbing_putra_id',
        'pembimbing_putri_id',
        'jenis_ujian',
    ];

    public function pencatatanUjian()
    {
        return $this->hasMany(PencatatanUjian::class);
    }

    public function ujianTasmi()
    {
        return $this->hasMany(UjianTasmi::class);
    }

    // Relasi ke Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    
    // Relasi ke Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Relasi ke pembimbing putra
    public function pembimbingPutra()
    {
        return $this->belongsTo(Ustadzah::class, 'pembimbing_putra_id');
    }

    // Relasi ke pembimbing putri
    public function pembimbingPutri()
    {
        return $this->belongsTo(Ustadzah::class, 'pembimbing_putri_id');
    }
}