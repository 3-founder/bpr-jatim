<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IntroVidioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $introVidio = new \App\Models\IntroVidio;
        $introVidio->vidio_url = '<iframe width="600" height="400" src="https://www.youtube.com/embed/AcbP83N5RzY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $introVidio->save();
    }
}
