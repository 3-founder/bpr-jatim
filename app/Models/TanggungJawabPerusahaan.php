<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggungJawabPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'tanggung_jawab_perusahaan';

    protected $guarded = [];
}
