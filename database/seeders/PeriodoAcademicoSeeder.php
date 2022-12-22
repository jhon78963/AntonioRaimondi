<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PeriodoAcademico;

class PeriodoAcademicoSeeder extends Seeder
{
    public function run()
    {
        PeriodoAcademico::create([
            'peri_descripcion' => 'PER-2022',
            'peri_estado' => '1'
        ]);
    }
}