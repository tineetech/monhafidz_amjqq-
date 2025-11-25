<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    
    protected $table = 'semester';

    protected $fillable = [
        'nama_semester',
        'tahun_ajaran',
        'periode_mulai',
        'periode_selesai',
        'jenis_hafalan',
        'status',
    ];

    protected $dates = ['periode_mulai', 'periode_selesai'];

    /**
     * Relasi: Satu semester bisa punya banyak santri
     */
    public function santri()
    {
        return $this->hasMany(Santri::class);
    }
    public function pencatatanUjian()
    {
        return $this->hasMany(PencatatanUjian::class);
    }

}