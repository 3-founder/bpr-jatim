<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KomposisiSahamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pemilik = [
            'Pemerintah Propinsi Jatim',
            'Pemerintah Kota Surabaya',
            'Pemerintah Kabupaten Pacitan',
            'Pemerintah Kota Probolinggo',
            'Pemerintah Kabupaten Magetan',
            'Pemerintah Kota Pasuruan',
            'Pemerintah Kabupaten Pasuruan',
            'Pemerintah Kota Kediri',
            'Pemerintah Kabupaten Trenggalek',
            'Pemerintah Kabupaten Gresik',
            'Pemerintah Kabupaten Blitar',
            'Dana Pensiun Pegawai Bank Jatim',
            'Pemerintah Kabupaten Bangkalan',
            'Pemerintah Kabupaten Lumajang',
            'Pemerintah Kabupaten Banyuwangi',
            'Pemerintah Kabupaten Nganjuk',
            'Pemerintah Kabupaten Tulungagung',
            'Pemerintah Kabupaten Ngawi',
            'Pemerintah Kabupaten Parnekasan',
            'Pemerintah Kabupaten Probolinggo',
            'Pemerintah Kabupaten Ponorogo',
            'Pemerintah Kabupaten Bojonegoro',
        ];

        $lembar = [
            3603803,
            198,
            3825,
            15,
            2196,
            32686,
            56,
            325,
            4,
            201,
            15,
            1151,
            229,
            149,
            80009,
            10649,
            6,
            983,
            40,
            22,
            833,
            180,
        ];

        $nominal = [
            360380300,
            198,
            3825000,
            1500000,
            2196000,
            3268600,
            560,
            325,
            400,
            201,
            1500000,
            1151000,
            2290000,
            1490000,
            8000900,
            1064900,
            600,
            983,
            4000000,
            2200,
            833,
            18000000,
        ];

        for ($i=0; $i < count($pemilik); $i++) { 
            $jenis = 'kota/kab';
            if ($pemilik == 'Pemerintah Propinsi Jatim')
                $jenis = 'pemprov';
            if ($pemilik == 'Dana Pensiun Pegawai Bank Jatim')
                $jenis = 'dpd';

            DB::table('komposisi_saham')->insert([
                'pemilik_saham' => $pemilik[$i],
                'jenis' => $jenis,
                'lembar' => $lembar[$i],
                'nominal' => $nominal[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
