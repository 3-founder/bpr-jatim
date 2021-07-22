<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->name = 'Administrator';
        $administrator->email = 'administrator@mail.com';
        $administrator->password = \Hash::make('mwb546hs51');
        $administrator->role = 'admin';
        $administrator->save();

        $administrator = new \App\Models\User;
        $administrator->name = 'Admin Produk & Layanan';
        $administrator->email = 'produklayanan@mail.com';
        $administrator->password = \Hash::make('12345678');
        $administrator->role = 'produklayanan';
        $administrator->save();

        $administrator = new \App\Models\User;
        $administrator->name = 'Admin Berita';
        $administrator->email = 'berita@mail.com';
        $administrator->password = \Hash::make('12345678');
        $administrator->role = 'berita';
        $administrator->save();

        $administrator = new \App\Models\User;
        $administrator->name = 'Admin Umkm Binaan';
        $administrator->email = 'umkmbinaan@mail.com';
        $administrator->password = \Hash::make('12345678');
        $administrator->role = 'umkmbinaan';
        $administrator->save();
    }
}
