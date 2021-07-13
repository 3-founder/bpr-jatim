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
        $administrator->save();
    }
}
