<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomposisiSahamModel extends Model
{
    use HasFactory;

    protected $table = 'komposisi_saham';
    protected $fillable = [
        'pemilik_saham',
        'jenis',
        'lembar',
        'nominal',
        'created_at',
        'updated_at',
    ];
}
