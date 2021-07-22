<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JaringanKantor extends Model
{
    use HasFactory;
    protected $table = 'kantor_kas';

    public function kota()
    {
        return $this->belongsTo('\App\Models\Kota', 'id_kota');
    }
}
