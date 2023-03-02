<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promo';

    protected $fillable = [
        'judul', 'slug', 'cover', 'konten', 'is_shown',
    ];

    protected $casts = [
        'is_shown' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($promo) {
            $promo->slug = Str::slug($promo->judul);
        });
    }
}
