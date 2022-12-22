<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SemestreAcademico;

class SemestreAcademicoSeeder extends Seeder
{
    public function run()
    {
        SemestreAcademico::create([
            'seme_descripcion' => 'SEM-I',
            'seme_estado' => '1',
            'peri_id' => '1'
        ]);

        SemestreAcademico::create([
            'seme_descripcion' => 'SEM-II',
            'seme_estado' => '1',
            'peri_id' => '1'
        ]);

        SemestreAcademico::create([
            'seme_descripcion' => 'SEM-III',
            'seme_estado' => '1',
            'peri_id' => '1'
        ]);

        SemestreAcademico::create([
            'seme_descripcion' => 'SEM-IV',
            'seme_estado' => '1',
            'peri_id' => '1'
        ]);
    }
}