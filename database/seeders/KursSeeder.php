<?php

namespace Database\Seeders;

use App\Models\Kurs;
use Illuminate\Database\Seeder;

class KursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newKurs = new Kurs;
        $newKurs->nama = 'GBP';
        $newKurs->harga_beli = 19768;
        $newKurs->temp_harga_beli = 19768;
        $newKurs->harga_jual = 20547;
        $newKurs->temp_harga_jual = 20547;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'BND';
        $newKurs->harga_beli = 10671;
        $newKurs->temp_harga_beli = 10671;
        $newKurs->harga_jual = 10881;
        $newKurs->temp_harga_jual = 10881;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'KRW';
        $newKurs->harga_beli = 12;
        $newKurs->temp_harga_beli = 12;
        $newKurs->harga_jual = 14;
        $newKurs->temp_harga_jual = 14;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'THB';
        $newKurs->harga_beli = 382;
        $newKurs->temp_harga_beli = 382;
        $newKurs->harga_jual = 472;
        $newKurs->temp_harga_jual = 472;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'SAR';
        $newKurs->harga_beli = 3573;
        $newKurs->temp_harga_beli = 3573;
        $newKurs->harga_jual = 4126;
        $newKurs->temp_harga_jual = 4126;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'JPY';
        $newKurs->harga_beli = 125;
        $newKurs->temp_harga_beli = 125;
        $newKurs->harga_jual = 135;
        $newKurs->temp_harga_jual = 135;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'HKD';
        $newKurs->harga_beli = 1675;
        $newKurs->temp_harga_beli = 1675;
        $newKurs->harga_jual = 1961;
        $newKurs->temp_harga_jual = 1961;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'CNY';
        $newKurs->harga_beli = 2075;
        $newKurs->temp_harga_beli = 2075;
        $newKurs->harga_jual = 2349;
        $newKurs->temp_harga_jual = 2349;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'MYR';
        $newKurs->harga_beli = 3363;
        $newKurs->temp_harga_beli = 3363;
        $newKurs->harga_jual = 3562;
        $newKurs->temp_harga_jual = 3562;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'SGD';
        $newKurs->harga_beli = 10507;
        $newKurs->temp_harga_beli = 10507;
        $newKurs->harga_jual = 11014;
        $newKurs->temp_harga_jual = 11014;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'AUD';
        $newKurs->harga_beli = 10748;
        $newKurs->temp_harga_beli = 10748;
        $newKurs->harga_jual = 11309;
        $newKurs->temp_harga_jual = 11309;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'EUR';
        $newKurs->harga_beli = 17004;
        $newKurs->temp_harga_beli = 17004;
        $newKurs->harga_jual = 17686;
        $newKurs->temp_harga_jual = 17686;
        $newKurs->save();

        $newKurs = new Kurs;
        $newKurs->nama = 'USD';
        $newKurs->harga_beli = 14025;
        $newKurs->temp_harga_beli = 14025;
        $newKurs->harga_jual = 14475;
        $newKurs->temp_harga_jual = 14475;
        $newKurs->save();
    }
}
