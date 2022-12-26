<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Aula;
use DB;

class GraficaController extends Controller
{
    public function administracion()
    {
        $alumnos = Alumno::where('alum_estado', '1')->count();
        $docentes = Docente::count();
        $cursos = Curso::where('curso_estado', '1')->count();
        $matriculas = Matricula::where('matr_estado', '1')->count();
        $aulas = DB::select('call alumnosxaula()');
        return view('graficas.administracion',compact('alumnos', 'docentes', 'cursos', 'matriculas', 'aulas'));
    }
}