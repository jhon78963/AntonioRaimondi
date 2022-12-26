<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_name' => 'zero',
            'user_password' => Hash::make('d1e2y3v4y5'),
            'user_state' => '1',
            'role_id' => '1',
        ])->assignRole('administrador');

        User::create([
            'user_name' => 'docente',
            'user_password' => Hash::make('123456789'),
            'user_state' => '1',
            'role_id' => '2',
        ])->assignRole('docente');

        User::create([
            'user_name' => 'alumno',
            'user_password' => Hash::make('123456789'),
            'user_state' => '1',
            'role_id' => '3',
        ])->assignRole('alumno');

        User::create([
            'user_name' => 'secretaria',
            'user_password' => Hash::make('123456789'),
            'user_state' => '1',
            'role_id' => '4',
        ])->assignRole('secretaria');

        User::create([
            'user_name' => 'uno',
            'user_password' => Hash::make('123456789'),
            'user_state' => '1',
            'role_id' => '5',
        ])->assignRole('invitado');
    }
}