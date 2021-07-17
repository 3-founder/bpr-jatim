<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmBinaan extends Model
{
    use HasFactory;
    protected $table = 'umkm_binaan';

    protected $fillable = [
        'nama',
        'id_kota',
        'jenis_usaha',
        'alamat',
        'no_telp',
        'deskripsi',
        'foto'
    ];
}
