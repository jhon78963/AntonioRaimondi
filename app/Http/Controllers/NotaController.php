<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nota;
use App\Models\AlumnoSeccion;
use App\Models\Aula;
use App\Models\Curso;
use App\Models\NotaSemanal;
use DB;

class NotaController extends Controller
{
    public function listarAlumnos($csec_id, $doce_id)
    {
        $lista_alumnos = DB::table('alumnos_secciones as as')->join('docentes_secciones as ds', 'ds.aula_id', 'as.aula_id')
                ->join('notas as n', 'as.asec_id', 'n.asec_id')
                ->join('alumnos as a', 'a.alum_id', 'as.alum_id')
                ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                ->where('d.doce_id', $doce_id)
                ->where('n.csec_id', $csec_id)
                ->where('a.alum_estado', '1')
                ->where('n.nota_estado', '1')
                ->select('as.asec_id', 'as.alum_id', 'a.alum_primerNombre', 'a.alum_otrosNombres', 'a.alum_apellidoPaterno', 'a.alum_apellidoMaterno', 'n.nota_id', 'n.nota_primera_unidad', 'n.nota_segundad_unidad', 'n.nota_tercera_unidad')
                ->orderBy('a.alum_apellidoPaterno','ASC')->orderBy('a.alum_apellidoMaterno','ASC')->orderBy('a.alum_primerNombre','ASC')->orderBy('a.alum_otrosNombres','ASC')
                ->get();
        return $lista_alumnos;
    }

    public function listarNotas($csec_id, $alum_id)
    {
        $lista_notas = DB::table('alumnos_secciones as as')->join('docentes_secciones as ds', 'ds.aula_id', 'as.aula_id')
                ->join('notas as n', 'as.asec_id', 'n.asec_id')
                ->join('alumnos as a', 'a.alum_id', 'as.alum_id')
                ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                ->where('a.alum_id', $alum_id)
                ->where('n.csec_id', $csec_id)
                ->where('a.alum_estado', '1')
                ->where('n.nota_estado', '1')
                ->select('as.asec_id', 'as.alum_id', 'a.alum_primerNombre', 'a.alum_otrosNombres', 'a.alum_apellidoPaterno', 'a.alum_apellidoMaterno', 'n.nota_id', 'n.nota_primera_unidad', 'n.nota_segundad_unidad', 'n.nota_tercera_unidad')
                ->orderBy('a.alum_apellidoPaterno','ASC')->orderBy('a.alum_apellidoMaterno','ASC')->orderBy('a.alum_primerNombre','ASC')->orderBy('a.alum_otrosNombres','ASC')
                ->get();
        return $lista_notas;
    }

    public function listarNotaSemanal($csec_id, $doce_id, $bimestre)
    {
        $notas_semanal = DB::table('alumnos_secciones as as')->join('docentes_secciones as ds', 'ds.aula_id', 'as.aula_id')
                ->join('notas as n', 'as.asec_id', 'n.asec_id')
                ->join('notas_semanas as ns', 'n.nota_id', 'ns.nota_id')
                ->join('alumnos as a', 'a.alum_id', 'as.alum_id')
                ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                ->where('d.doce_id', $doce_id)
                ->where('n.csec_id', $csec_id)
                ->where('ns.nsem_bimestre', $bimestre)
                ->where('a.alum_estado', '1')
                ->where('n.nota_estado', '1')
                ->where('ns.nsem_estado', '1')
                ->select('as.asec_id', 'n.nota_id','as.alum_id', 'a.alum_primerNombre', 'a.alum_otrosNombres', 'a.alum_apellidoPaterno', 'a.alum_apellidoMaterno', 'ns.nsem_id', 'ns.nsem_primera_semana', 'ns.nsem_segunda_semana', 'ns.nsem_tercera_semana', 'ns.nsem_cuarta_semana', 'ns.nsem_quinta_semana', 'ns.nsem_sexta_semana', 'ns.nsem_septima_semana', 'ns.nsem_octava_semana')
                ->orderBy('a.alum_apellidoPaterno','ASC')->orderBy('a.alum_apellidoMaterno','ASC')->orderBy('a.alum_primerNombre','ASC')->orderBy('a.alum_otrosNombres','ASC')
                ->get();
            return $notas_semanal;
    }

    public function listarNotaSemanalAlumno($csec_id, $alum_id, $bimestre)
    {
        $notas_semanal = DB::table('alumnos_secciones as as')->join('docentes_secciones as ds', 'ds.aula_id', 'as.aula_id')
                ->join('notas as n', 'as.asec_id', 'n.asec_id')
                ->join('notas_semanas as ns', 'n.nota_id', 'ns.nota_id')
                ->join('alumnos as a', 'a.alum_id', 'as.alum_id')
                ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                ->where('a.alum_id', $alum_id)
                ->where('n.csec_id', $csec_id)
                ->where('ns.nsem_bimestre', $bimestre)
                ->where('a.alum_estado', '1')
                ->where('n.nota_estado', '1')
                ->where('ns.nsem_estado', '1')
                ->select('as.asec_id', 'n.nota_id','as.alum_id', 'a.alum_primerNombre', 'a.alum_otrosNombres', 'a.alum_apellidoPaterno', 'a.alum_apellidoMaterno', 'ns.nsem_id', 'ns.nsem_primera_semana', 'ns.nsem_segunda_semana', 'ns.nsem_tercera_semana', 'ns.nsem_cuarta_semana', 'ns.nsem_quinta_semana', 'ns.nsem_sexta_semana', 'ns.nsem_septima_semana', 'ns.nsem_octava_semana')
                ->orderBy('a.alum_apellidoPaterno','ASC')->orderBy('a.alum_apellidoMaterno','ASC')->orderBy('a.alum_primerNombre','ASC')->orderBy('a.alum_otrosNombres','ASC')
                ->get();
            return $notas_semanal;
    }

    public function listarDocentes($aula_id)
    {
        $docentes = DB::table('docentes_secciones as ds')->join('aulas as sg', 'sg.aula_id', 'ds.aula_id')
            ->join('grados as g', 'g.grado_id', 'sg.grado_id')
            ->join('secciones as s', 's.secc_id', 'sg.secc_id')
            ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
            ->where('ds.aula_id', $aula_id)
            ->select('d.doce_id', 'd.doce_primerNombre', 'd.doce_otrosNombres', 'd.doce_apellidoPaterno', 'd.doce_apellidoMaterno', 'd.doce_dni')->get();
        return $docentes;
    }

    public function listarCursos($doce_id)
    {
        $lista_cursos = DB::table('cursos as c')->join('cursos_secciones as cs', 'cs.curso_id', 'c.curso_id')
            ->join('docentes_secciones as ds', 'ds.aula_id', 'cs.aula_id')
            ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
            ->where('d.doce_id', $doce_id)
            ->select('c.curso_id', 'c.curso_nombre', 'd.doce_id')
            ->get();
        return $lista_cursos;
    }

    public function index()
    {
        $user_id = Auth::user()->user_name;

        $hoy = date("Y-m-d");

         if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){
            $aulas = DB::table('docentes_secciones as ds')->join('aulas as sg', 'sg.aula_id', 'ds.aula_id')
                ->join('grados as g', 'g.grado_id', 'sg.grado_id')
                ->join('secciones as s', 's.secc_id', 'sg.secc_id')
                ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                ->select('sg.aula_id', 'g.grado_id', 'g.grado_descripcion', 's.secc_id', 's.secc_descripcion', 'd.doce_dni')->get();

            return view('administrador.notas', compact('aulas', 'hoy'));

        }
        else if(Auth::user()->role_id == '2'){
            $aulas = DB::table('docentes_secciones as ds')->join('aulas as sg', 'sg.aula_id', 'ds.aula_id')
                ->join('grados as g', 'g.grado_id', 'sg.grado_id')
                ->join('secciones as s', 's.secc_id', 'sg.secc_id')
                ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                ->select('g.grado_id','g.grado_descripcion', 's.secc_id','s.secc_descripcion', 'd.doce_dni')->where('d.doce_dni', $user_id)->get();

            $lista_cursos = DB::table('cursos as c')->join('cursos_secciones as cs', 'cs.curso_id', 'c.curso_id')
                ->join('docentes_secciones as ds', 'ds.aula_id', 'cs.aula_id')
                ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                ->where('d.doce_dni', $user_id)
                ->select('c.curso_id', 'c.curso_nombre', 'd.doce_id')
                ->get();

            return view('docente.notas', compact('aulas', 'hoy', 'lista_cursos'));
        }else{
            $aulas = DB::table('alumnos_secciones as as')->join('aulas as sg', 'sg.aula_id', 'as.aula_id')
                ->join('grados as g', 'g.grado_id', 'sg.grado_id')
                ->join('secciones as s', 's.secc_id', 'sg.secc_id')
                ->join('alumnos as a', 'a.alum_id', 'as.alum_id')
                ->select('g.grado_id','g.grado_descripcion', 's.secc_id','s.secc_descripcion', 'a.alum_dni', 'a.alum_apellidoPaterno', 'a.alum_apellidoMaterno', 'a.alum_primerNombre', 'a.alum_otrosNombres')->where('a.alum_dni', $user_id)->get();

            $lista_cursos = DB::table('cursos as c')->join('cursos_secciones as cs', 'cs.curso_id', 'c.curso_id')
                ->join('alumnos_secciones as as', 'as.aula_id', 'cs.aula_id')
                ->join('alumnos as a', 'a.alum_id', 'as.alum_id')
                ->where('a.alum_dni', $user_id)
                ->select('c.curso_id', 'c.curso_nombre', 'a.alum_id')
                ->get();
            return view('alumnos.notas', compact('aulas', 'hoy', 'lista_cursos'));
            //return dd($lista_cursos);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $nrobimestre = $request->nrobimestre;
        $notas_id = $request->idnotas;
        $asecs_id = $request->idasecs;
        $nsems_id = $request->idnsems;
        $promedios_semanales = $request->promedio_semanal;
        $notas_primer_bimestre = $request->notas_primerbimestre;
        $notas_segundo_bimestre = $request->notas_segundobimestre;
        $notas_tercer_bimestre = $request->notas_tercerbimestre;
        $notas_cuarto_bimestre = $request->notas_cuartobimestre;
        $notas_primerasemana = $request->notas_primerasemana;
        $notas_segundasemana = $request->notas_segundasemana;
        $notas_tercerasemana = $request->notas_tercerasemana;
        $notas_cuartasemana = $request->notas_cuartasemana;
        $notas_quintasemana = $request->notas_quintasemana;
        $notas_sextasemana = $request->notas_sextasemana;
        $notas_septimasemana = $request->notas_septimasemana;
        $notas_octavasemana = $request->notas_octavasemana;


        for($i=0;$i<count($nsems_id);$i++){

            // notas semanales
            $notas_semanal = NotaSemanal::findOrFail($request->idnsems[$i]);
            $notas_semanal->nsem_primera_semana = $request->notas_primerasemana[$i];
            $notas_semanal->nsem_segunda_semana = $request->notas_segundasemana[$i];
            $notas_semanal->nsem_tercera_semana = $request->notas_tercerasemana[$i];
            $notas_semanal->nsem_cuarta_semana = $request->notas_cuartasemana[$i];
            $notas_semanal->nsem_quinta_semana = $request->notas_quintasemana[$i];
            $notas_semanal->nsem_sexta_semana = $request->notas_sextasemana[$i];
            $notas_semanal->nsem_septima_semana = $request->notas_septimasemana[$i];
            $notas_semanal->nsem_octava_semana = $request->notas_octavasemana[$i];
            $notas_semanal->save();

            // notas bimestral
            $notas_bimestral = Nota::findOrFail($request->idnotas[$i]);
            if($nrobimestre = '1'){
                $notas_bimestral->nota_primera_unidad = ($request->notas_primerasemana[$i] + $request->notas_segundasemana[$i] +$request->notas_tercerasemana[$i] + $request->notas_cuartasemana[$i] + $request->notas_quintasemana[$i] + $request->notas_sextasemana[$i] + $request->notas_septimasemana[$i] + $request->notas_octavasemana[$i]) / 8;
                $notas_bimestral->save();
            }else if($nrobimestre = '2'){
                $notas_bimestral->nota_segundad_unidad = ($request->notas_primerasemana[$i] + $request->notas_segundasemana[$i] +$request->notas_tercerasemana[$i] + $request->notas_cuartasemana[$i] + $request->notas_quintasemana[$i] + $request->notas_sextasemana[$i] + $request->notas_septimasemana[$i] + $request->notas_octavasemana[$i]) / 8;
                $notas_bimestral->save();
            }else if($nrobimestre = '3'){
                $notas_bimestral->nota_tercera_unidad = ($request->notas_primerasemana[$i] + $request->notas_segundasemana[$i] +$request->notas_tercerasemana[$i] + $request->notas_cuartasemana[$i] + $request->notas_quintasemana[$i] + $request->notas_sextasemana[$i] + $request->notas_septimasemana[$i] + $request->notas_octavasemana[$i]) / 8;
                $notas_bimestral->save();
            }
        }


        return redirect()->route('notas.index')->with('datos', 'Notas actualizadas con exito ...!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}