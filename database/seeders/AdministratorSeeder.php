<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /**
     * How to run
     *  open terminal `php artisan db:seed --class=AdministratorSeeder`
     */
    public function run()
    {
        // $administrator = new \App\Models\User;
        // $administrator->name = 'Administrator';
        // $administrator->email = 'administrator@mail.com';
        // $administrator->password = \Hash::make('mwb546hs51');
        // $administrator->role = 'admin';
        // $administrator->save();

        User::create([
            'name' => 'Administrator',
            'email' => 'administrator@mail.com',
            'password' => Hash::make('mwb546hs51'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Produk & Layanan',
            'email' => 'produklayanan@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'produklayanan'
        ]);
        User::create([
            'name' => 'Admin Berita',
            'email' => 'berita@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'berita'
        ]);
        User::create([
            'name' => 'Admin Umkm Binaan',
            'email' => 'umkmbinaan@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'umkmbinaan'
        ]);
    }
}
