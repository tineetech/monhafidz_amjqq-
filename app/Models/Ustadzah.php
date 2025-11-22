<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ustadzah extends Model
{
    use HasFactory;

    protected $table = 'ustadzah';

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'nik',
        'tanggal_lahir',
        'alamat_lengkap',
        'no_hp',
        'status',
        'user_id',
    ];

    protected $dates = ['tanggal_lahir'];
}