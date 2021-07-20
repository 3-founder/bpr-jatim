<?php

namespace Database\Seeders;

use App\Models\Bunga;
use Illuminate\Database\Seeder;

class BungaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newBunga = new Bunga;
        $newBunga->bunga = 0.83;
        $newBunga->save();
    }
}
