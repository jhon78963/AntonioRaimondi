<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_profiles')->insert([
            'upro_id' => '1',
            'upro_company' => 'ZeroGROUPS',
            'upro_email' => 'jhonlivias3@gmail.com',
            'upro_firstName' => 'Jhon',
            'upro_lastName' => 'Livias',
            'upro_address' => 'Manuel Arevalo, La Esperanza',
            'upro_city' => 'Trujillo',
            'upro_phoneNumber' => '973835639',
            'upro_country' => 'Perú',
            'upro_postalCode' => '13002',
            'upro_image' => '/img/fotoperfil/Administrator.jpg',
            'upro_aboutMe' => 'Desarollador',
            'user_id' => '1'
        ]);

        DB::table('user_profiles')->insert([
            'upro_id' => '2',
            'user_id' => '2'
        ]);

        DB::table('user_profiles')->insert([
            'upro_id' => '3',
            'user_id' => '3'
        ]);

        DB::table('user_profiles')->insert([
            'upro_id' => '4',
            'user_id' => '4'
        ]);

        DB::table('user_profiles')->insert([
            'upro_id' => '5',
            'user_id' => '5'
        ]);

    }
}