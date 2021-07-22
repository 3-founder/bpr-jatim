<?php

namespace Database\Seeders;

use App\Models\JenisProdukLayanan;
use Illuminate\Database\Seeder;

class JenisProdukLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newJenis = new JenisProdukLayanan;
        $newJenis->nama_jenis = 'Personal';
        $newJenis->save();

        $newJenis = new JenisProdukLayanan;
        $newJenis->nama_jenis = 'Bisnis';
        $newJenis->save();

        $newJenis = new JenisProdukLayanan;
        $newJenis->nama_jenis = 'Layanan';
        $newJenis->save();
    }
}
