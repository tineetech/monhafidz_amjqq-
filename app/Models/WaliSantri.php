<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliSantri extends Model
{
    use HasFactory;

    protected $table = 'wali_santri';

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'nik',
        'tanggal_lahir',
        'wali_sebagai',
        'santri_id',
        'alamat_lengkap',
        'no_hp',
        'status_wali',
        'user_id',
    ];

    protected $dates = ['tanggal_lahir'];

    /**
     * Relasi ke model Santri
     */
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
}