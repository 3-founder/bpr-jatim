<?php

namespace Database\Seeders;

use App\Models\PetaCabang;
use Illuminate\Database\Seeder;

class PetaCabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newPeta = new PetaCabang;
        $newPeta->judul = 'SITEMAP BPR JAWA TIMUR';
        $newPeta->konten = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5428931880892!2d112.73469331477511!3d-7.292732294736431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbeae113fb9f%3A0xe1ce10e6b1a968dc!2sBank%20UMKM%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1626702840004!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        $newPeta->save();
    }
}
