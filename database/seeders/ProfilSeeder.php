<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profil = new \App\Models\Profil;
        $profil->kantor_pusat = 'Jl. Ciliwung Nomor 11<br>Surabaya 60241 <br>Indonesia';
        $profil->facebook = 'https://www.facebook.com/PT-BPR-Jatim-Bank-UMKM-Jawa-Timur-370913480017654/';
        $profil->instagram = 'https://www.instagram.com/bank_bpr_jatim/';
        $profil->youtube = 'https://www.youtube.com/channel/UC1j5a6fMJUuI3Ed_kIWTJqg';
        $profil->email = 'info@bprjatim.co.id';
        $profil->telepon1 = '031-5677844';
        $profil->telepon2 = '031-5688542-45';
        $profil->telepon3 = '031-5681037';
        $profil->save();
    }
}
