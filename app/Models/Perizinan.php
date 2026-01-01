<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    protected $table = "perizinan";
    protected $fillable = [
        'santri_id',
        'tanggal',
        'status',
        'alasan',
        'bukti_izin',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relasi ke Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
}
