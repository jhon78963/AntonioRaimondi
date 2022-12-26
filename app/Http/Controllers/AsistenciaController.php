<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\AlumnoSeccion;
use App\Models\Aula;
use DB;


class AsistenciaController extends Controller
{
    public function listaAlumnos($doce_id, $fecha)
    {
        $lista_alumnos = DB::table('asistencias as a')->join('alumnos_secciones as as', 'a.asec_id', 'as.asec_id')
            ->join('alumnos as al', 'as.alum_id', 'al.alum_id')
            ->join('docentes_secciones as ds', 'ds.aula_id', 'as.aula_id')
            ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
            ->where('d.doce_id', $doce_id)
            ->where('a.asis_fecha', $fecha)
            ->select('al.alum_primerNombre', 'al.alum_otrosNombres', 'al.alum_apellidoPaterno', 'al.alum_apellidoMaterno', 'a.asis_estado')
            ->orderBy('al.alum_apellidoPaterno','ASC')
            ->orderBy('al.alum_apellidoMaterno','ASC')
            ->orderBy('al.alum_primerNombre','ASC')
            ->orderBy('al.alum_otrosNombres','ASC')
            ->get();
        return $lista_alumnos;
    }

    public function listaAsistenciaAlumno($alum_id, $fecha)
    {
        $asistencia =  DB::table('asistencias as a')->join('alumnos_secciones as as', 'a.asec_id', 'as.asec_id')
            ->join('alumnos as al', 'as.alum_id', 'al.alum_id')
            ->where('al.alum_id', $alum_id)
            ->where('a.asis_fecha', $fecha)
            ->select('a.asis_fecha', 'a.asis_estado')
            ->orderBy('a.asis_fecha','DESC')
            ->get();
        return $asistencia;
    }

    public function index()
    {
        $user_id = Auth::user()->user_name;

        $hoy = date("Y-m-d");
        $aulas = DB::table('docentes_secciones as ds')->join('aulas as sg', 'sg.aula_id', 'ds.aula_id')
            ->join('grados as g', 'g.grado_id', 'sg.grado_id')
            ->join('secciones as s', 's.secc_id', 'sg.secc_id')
            ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
            ->select('g.grado_descripcion', 's.secc_descripcion', 'd.doce_dni')->where('d.doce_dni', $user_id)->get();


        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){

             $aulas = DB::table('docentes_secciones as ds')->join('aulas as sg', 'sg.aula_id', 'ds.aula_id')
                ->join('grados as g', 'g.grado_id', 'sg.grado_id')
                ->join('secciones as s', 's.secc_id', 'sg.secc_id')
                ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                ->select('sg.aula_id', 'g.grado_id', 'g.grado_descripcion', 's.secc_id', 's.secc_descripcion', 'd.doce_dni')->get();

            return view('administrador.asistencia', compact('aulas', 'hoy'));

        }else if(Auth::user()->role_id == '2'){
            if(Asistencia::where('asis_fecha','=',$hoy)->where('doce_id', $user_id)->count())
            {
                $lista_alumnos = DB::table('asistencias as a')->join('alumnos_secciones as as', 'as.asec_id', 'a.asec_id')
                    ->join('docentes_secciones as ds', 'ds.aula_id', 'as.aula_id')
                    ->join('alumnos as al', 'al.alum_id', 'as.alum_id')
                    ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                    ->select('a.asis_id','a.asis_estado','as.asec_id','as.alum_id', 'al.alum_primerNombre', 'al.alum_otrosNombres', 'al.alum_apellidoPaterno', 'al.alum_apellidoMaterno')
                    ->where('d.doce_dni', $user_id)
                    ->where('a.asis_fecha', $hoy)
                    ->orderBy('al.alum_apellidoPaterno','ASC')->orderBy('al.alum_apellidoMaterno','ASC')->orderBy('al.alum_primerNombre','ASC')->orderBy('al.alum_otrosNombres','ASC')
                    ->get();

                $nueva_lista_alumnos  = DB::table('alumnos_secciones as as')->where('as.asec_id', '-1')->get();
                return view('docente.asistencia', compact('lista_alumnos', 'aulas', 'hoy', 'nueva_lista_alumnos'));

            }else{
                $lista_alumnos = DB::table('asistencias as a')->join('alumnos_secciones as as', 'as.asec_id', 'a.asec_id')
                    ->join('docentes_secciones as ds', 'ds.aula_id', 'as.aula_id')
                    ->join('alumnos as al', 'al.alum_id', 'as.alum_id')
                    ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                    ->select('a.asis_id','a.asis_estado','as.asec_id','as.alum_id', 'al.alum_primerNombre', 'al.alum_otrosNombres', 'al.alum_apellidoPaterno', 'al.alum_apellidoMaterno')
                    ->where('d.doce_dni', $user_id)
                    ->where('a.asis_fecha', $hoy)
                    ->orderBy('al.alum_apellidoPaterno','ASC')->orderBy('al.alum_apellidoMaterno','ASC')->orderBy('al.alum_primerNombre','ASC')->orderBy('al.alum_otrosNombres','ASC')
                    ->get();

                $nueva_lista_alumnos = DB::table('alumnos_secciones as as')->join('docentes_secciones as ds', 'ds.aula_id', 'as.aula_id')
                ->join('alumnos as a', 'a.alum_id', 'as.alum_id')
                ->join('docentes as d', 'd.doce_id', 'ds.doce_id')
                ->where('as.asec_estado', '1')
                ->select('as.asec_id','as.alum_id', 'a.alum_primerNombre', 'a.alum_otrosNombres', 'a.alum_apellidoPaterno', 'a.alum_apellidoMaterno')->where('d.doce_dni', $user_id)
                ->orderBy('a.alum_apellidoPaterno','ASC')->orderBy('a.alum_apellidoMaterno','ASC')->orderBy('a.alum_primerNombre','ASC')->orderBy('a.alum_otrosNombres','ASC')
                ->get();
                return view('docente.asistencia', compact('lista_alumnos', 'aulas', 'hoy', 'nueva_lista_alumnos'));
            }

        }else{

                $aulas = DB::table('alumnos_secciones as as')->join('aulas as sg', 'sg.aula_id', 'as.aula_id')
                ->join('grados as g', 'g.grado_id', 'sg.grado_id')
                ->join('secciones as s', 's.secc_id', 'sg.secc_id')
                ->join('alumnos as a', 'a.alum_id', 'as.alum_id')
                ->where('a.alum_dni', $user_id)
                ->select('g.grado_id','g.grado_descripcion', 's.secc_id','s.secc_descripcion', 'a.alum_id', 'a.alum_apellidoPaterno', 'a.alum_apellidoMaterno', 'a.alum_primerNombre', 'a.alum_otrosNombres')
                ->get();

                $asistencias =  DB::table('asistencias as a')->join('alumnos_secciones as as', 'a.asec_id', 'as.asec_id')
                    ->join('alumnos as al', 'as.alum_id', 'al.alum_id')
                    ->where('al.alum_dni', $user_id)
                    ->select('a.asis_fecha', 'a.asis_estado')
                    ->orderBy('a.asis_fecha','DESC')
                    ->paginate(5);

                return view('alumnos.asistencia', compact('aulas', 'hoy', 'asistencias'));

        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->user_name;
        $asec_ids = $request->asec_ids;
        $asistencias = $request->asistencias;
        $asis_ids = $request->asis_ids;

        if($asis_ids != null){
            for($i=0;$i<count($asec_ids);$i++){

                $asistencia = Asistencia::find($request->asis_ids[$i]);
                $asistencia->asis_estado = $request->asistencias[$i];
                $asistencia->save();
            }

            //return dd($asistencia->asis_id);
            return redirect()->route('asistencias.index')->with('datos', 'Asistencia Actualizada con exito ...!');
        }else{
            for($i=0;$i<count($asec_ids);$i++){

                if (Asistencia::all()->count()) {
                    $last_asis_id = Asistencia::all()->last()->asis_id+1;
                } else {
                    $last_asis_id = 1;
                }

                $asistencia = new Asistencia();

                $asistencia->asis_id = $last_asis_id;

                $asistencia->asis_estado = $request->asistencias[$i];

                $asistencia->asec_id = $request->asec_ids[$i];

                $asistencia->doce_id = $user_id;

                $asistencia->save();

            }
            return redirect()->route('asistencias.index')->with('datos', 'Asistencia registrada con exito ...!');
        }
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