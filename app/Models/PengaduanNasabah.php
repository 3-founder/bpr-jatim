<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanNasabah extends Model
{
    use HasFactory;
    protected $table = 'pengaduan_nasabah';

    protected $fillable = [
        'id_kota',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'jenis_identitas',
        'nomor_identitas',
        'alamat',
        'no_telp',
        'no_hp',
        'no_fax',
        'no_rekening',
        'nama_perwakilan',
        'tempat_lahir_perwakilan',
        'tgl_lahir_perwakilan',
        'jenis_kelamin_perwakilan',
        'jenis_identitas_perwakilan',
        'nomor_identitas_perwakilan',
        'alamat_perwakilan',
        'no_telp_perwakilan',
        'no_hp_perwakilan',
        'no_fax_perwakilan',
        'jenis_rekening',
        'detail_pengaduan',
    ];
}
