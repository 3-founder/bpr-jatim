<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newTenor = new \App\Models\Tenor;
        $newTenor->tenor = 1;
        $newTenor->save();

        $newTenor = new \App\Models\Tenor;
        $newTenor->tenor = 2;
        $newTenor->save();

        $newTenor = new \App\Models\Tenor;
        $newTenor->tenor = 3;
        $newTenor->save();
        
        $newTenor = new \App\Models\Tenor;
        $newTenor->tenor = 4;
        $newTenor->save();
    }
}
