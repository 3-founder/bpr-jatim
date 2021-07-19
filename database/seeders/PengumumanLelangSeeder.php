<?php

namespace Database\Seeders;

use App\Models\PengumumanLelangJaminan;
use Illuminate\Database\Seeder;

class PengumumanLelangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newPengumumanLelang = new PengumumanLelangJaminan;
        $newPengumumanLelang->judul = 'Pengumuman Lelang Jaminan';
        $newPengumumanLelang->konten = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit quos quae dicta, delectus tempora corrupti velit quis totam officia labore obcaecati iure accusamus voluptas eius? Nemo nostrum ullam repellendus voluptas.';
        $newPengumumanLelang->save();
    }
}
