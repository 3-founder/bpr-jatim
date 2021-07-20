<?php

namespace Database\Seeders;

use App\Models\Karier;
use Illuminate\Database\Seeder;

class KarierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newKarier = new Karier;
        $newKarier->judul = 'Karier BPR Jawa Timur';
        $newKarier->konten = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui tempora, inventore saepe ab voluptas placeat sapiente dignissimos officiis, laudantium hic eius maxime dolor asperiores perferendis consequuntur distinctio ut. Praesentium, aliquid.';
        $newKarier->save();
    }
}
