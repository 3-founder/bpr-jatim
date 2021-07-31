<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';

    public function kategori()
    {
        return $this->belongsTo('\App\Models\KategoriBerita', 'id_kategori');
    }
}
