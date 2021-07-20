<?php

namespace Database\Seeders;

use App\Models\TipsKeamananInfoTerkini;
use Illuminate\Database\Seeder;

class TipsKeamananInfoTerkiniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newData = new TipsKeamananInfoTerkini;
        $newData->judul_tips_keamanan = 'Tips Keamanan';
        $newData->konten_tips_keamanan = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora vero dolore ullam facilis reprehenderit minima excepturi. Quibusdam quam officiis esse libero perferendis similique quo dolores natus, incidunt, at, optio ducimus?';
        $newData->judul_info_terkini = 'Info Terkini';
        $newData->konten_info_terkini = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora vero dolore ullam facilis reprehenderit minima excepturi. Quibusdam quam officiis esse libero perferendis similique quo dolores natus, incidunt, at, optio ducimus?';
        $newData->save();
    }
}
