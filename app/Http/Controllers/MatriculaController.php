<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Nota;
use App\Models\NotaSemanal;
use App\Models\Asistencia;
use App\Models\Alumno;
use App\Models\AlumnoSeccion;
use App\Models\CursoSeccion;
use App\Models\Aula;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Pais;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use DB;
use PDF;
use DateTime;
use \Auth;

class MatriculaController extends Controller
{
    public function listarSecciones($grado_id){
        $aulas = DB::table('aulas as sg')->join('grados as g', 'g.grado_id', 'sg.grado_id')->join('secciones as s', 's.secc_id', 'sg.secc_id')->where('g.grado_id', $grado_id)
        ->select('sg.aula_id', 'sg.aula_capacidad', 'g.grado_id', 'g.grado_descripcion', 's.secc_id', 's.secc_descripcion')->get();
        return response()->json($aulas);
    }

    public function listarVacantes($grado_id, $secc_id){
        $aulas = DB::table('aulas')->where('grado_id', $grado_id)->where('secc_id', $secc_id)
        ->select('aula_capacidad')->first();
        return $aulas;
    }

    public function listarIdAula($grado_id, $secc_id){
        $aulas = DB::table('aulas')->where('grado_id', $grado_id)->where('secc_id', $secc_id)
        ->select('aula_id')->first();
        return $aulas;
    }

    public function index(Request $request)
    {
        $buscarpor = $request->buscarpor;
        $matriculas = Matricula::join('alumnos as a', 'matriculas.alum_id', 'a.alum_id')
            ->where('a.alum_apellidoPaterno','like','%'.$buscarpor.'%')
            ->orwhere('a.alum_apellidoMaterno','like','%'.$buscarpor.'%')
            ->orwhere('a.alum_primerNombre','like','%'.$buscarpor.'%')
            ->orwhere('a.alum_otrosNombres','like','%'.$buscarpor.'%')
            ->paginate(5);
        $alumnos = Alumno::all();
        $aulas = Aula::all();
        $hoy =  new DateTime();
        $hoy = $hoy->format("Y-m-d H:i:s");
        return view('matriculas.index', compact('matriculas', 'alumnos', 'aulas', 'buscarpor', 'hoy'));
    }

    public function listarPdf($matr_id, $fecha){
        $matriculas = DB::table('matriculas as m')
            ->join('alumnos as a', 'm.alum_id', 'a.alum_id')
            ->join ('paises as p', 'a.pais_id', 'p.pais_id')
            ->join('departamentos as de', 'a.depa_id', 'de.depa_id')
            ->join('provincias as pr', 'a.prov_id', 'pr.prov_id')
            ->join('distritos as di', 'a.dist_id', 'di.dist_id')
            ->join('aulas as sg', 'm.aula_id', 'sg.aula_id')
            ->join('grados as g', 'sg.grado_id', 'g.grado_id')
            ->join('secciones as s', 'sg.secc_id', 's.secc_id')
            ->join('docentes_secciones as ds', 'sg.aula_id', 'ds.aula_id')
            ->join('docentes as d', 'ds.doce_id', 'd.doce_id')
            ->where('m.matr_id', $matr_id)
            ->select('m.matr_id', 'm.created_at', 'g.grado_descripcion', 's.secc_descripcion',
                'a.alum_id', 'a.alum_dni','a.alum_primerNombre', 'a.alum_otrosNombres', 'a.alum_apellidoPaterno', 'a.alum_apellidoMaterno',
                'a.alum_sexo', 'a.alum_fechaNacimiento', 'alum_telefono', 'alum_celular',
                'a.alum_direccion', 'p.pais_nombre', 'de.depa_nombre', 'pr.prov_nombre', 'di.dist_nombre',
                'd.doce_id', 'd.doce_primerNombre', 'd.doce_otrosNombres', 'd.doce_apellidoPaterno', 'd.doce_apellidoMaterno')
            ->get();
        $usuario = Auth::user()->user_name;
        $titulo = "Ficha de Matricula";
        $hoy = new DateTime();
        $hoy = $hoy->format("Y-m-d H:i:s");
        $fecha_anterior = $fecha;
        $pdf = PDF::loadView('matriculas.pdf',compact('matriculas', 'usuario', 'titulo', 'hoy', 'fecha_anterior'));
        return $pdf->stream('fichamatricula'.$hoy.'.pdf');
    }

    public function create()
    {
        $matriculas = Matricula::all();
        $alumnos = Alumno::where('alum_estado', '=' ,'0')->get();
        $grados = Grado::all();
        $secciones = Seccion::all();
        $aulas = Aula::all();
        $paises = Pais::all();
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();
        return view('matriculas.create', compact('matriculas', 'alumnos', 'grados', 'secciones', 'paises', 'departamentos', 'provincias', 'distritos', 'aulas'));
    }

    public function store(Request $request)
    {
        $matricula = new Matricula();

        if ($request->alum_id != null){
            if(Matricula::all()->count()){
                $last_matr_id=Matricula::all()->last()->matr_id+1;
            }
            else{
                $last_matr_id=1;
            }
            $matricula->matr_id = $last_matr_id;
            $matricula->alum_id = $request->alum_id;
            $matricula->aula_id = $request->aula_id;
            $matricula->matr_año_ingreso = $request->matr_año_ingreso;
            $matricula->matr_estado = '1';
            $matricula->save();

            $alumno = Alumno::Find($request->alum_id);
            $alumno->alum_estado = '1';
            $alumno->update();

            $aula = Aula::Find($request->aula_id);
            $aula->aula_capacidad -= 1;
            $aula->update();

            if(AlumnoSeccion::all()->count()){
                $last_asec_id=AlumnoSeccion::all()->last()->asec_id+1;
            }
            else{
                $last_asec_id=1;
            }

            $alumno_seccion = new AlumnoSeccion();
            $alumno_seccion->asec_id = $last_asec_id;
            $alumno_seccion->alum_id = $request->alum_id;
            $alumno_seccion->aula_id = $request->aula_id;
            $alumno_seccion->save();

             $curso_secciones = DB::table('cursos_secciones')->where('aula_id', $request->aula_id)->get();

            foreach ($curso_secciones as $curso_seccion){

                if(Nota::all()->count()){
                    $last_nota_id = Nota::all()->last()->nota_id+1;
                }else{
                    $last_nota_id = 1;
                }

                $nota = new Nota();
                $nota->nota_id = $last_nota_id;
                $nota->asec_id = $last_asec_id;
                $nota->csec_id = $curso_seccion->csec_id;
                $nota->save();

                for($j=0;$j<4;$j++) {
                    if(NotaSemanal::all()->count()){
                        $last_nsem_id = NotaSemanal::all()->last()->nsem_id+1;
                    }else{
                        $last_nsem_id = 1;
                    }

                    $nota_semana = new NotaSemanal();
                    $nota_semana->nsem_id = $last_nsem_id;
                    $nota_semana->nota_id = $last_nota_id;
                    $nota_semana->nsem_bimestre = ($j+1);
                    $nota_semana->nsem_estado = '1';
                    $nota_semana->save();
                }
            }

            return redirect()->route('matriculas.index')->with('datos','Matricula Registrada ...!');
        }else
        {

            if(Alumno::all()->count()){
                $last_alum_id=Alumno::all()->last()->alum_id+1;
            }
            else{
                $last_alum_id=1;
            }

            $alumno = new Alumno();
            $alumno->alum_id = $last_alum_id;
            $alumno->alum_dni = $request->alum_dni;
            $alumno->alum_primerNombre = $request->alum_primerNombre;
            $alumno->alum_otrosNombres = $request->alum_otrosNombres;
            $alumno->alum_apellidoPaterno = $request->alum_apellidoPaterno;
            $alumno->alum_apellidoMaterno = $request->alum_apellidoMaterno;
            $alumno->alum_fechaNacimiento = $request->alum_fechaNacimiento;
            $alumno->alum_sexo = $request->alum_sexo;
            $alumno->alum_direccion = $request->alum_direccion;
            $alumno->alum_telefono = $request->alum_telefono;
            $alumno->alum_celular = $request->alum_celular;
            $alumno->alum_estado = '1';
            $alumno->pais_id = $request->pais_id;
            $alumno->depa_id = $request->depa_id;
            $alumno->prov_id = $request->prov_id;
            $alumno->dist_id = $request->dist_id;
            $alumno->save();

            if(User::all()->count()){
                $last_user_id=User::all()->last()->id+1;
            }
            else{
                $last_user_id=1;
            }

            $user = new User();
            $user->id = $last_user_id;
            $user->user_nombre = $request->alum_primerNombre;
            $user->user_otros_nombres = $request->alum_otrosNombres;
            $user->user_apellido_paterno = $request->alum_apellidoPaterno;
            $user->user_apellido_materno = $request->alum_apellidoMaterno;
            $user->email= strtolower($request->alum_primerNombre).strtolower($request->alum_apellidoPaterno).$last_user_id.'@libertad.edu.pe';
            $user->username = $request->alum_dni;
            $user->password=Hash::make($request->alum_dni);
            $user->user_direccion = $request->alum_direccion;
            $user->user_estado='1';
            $user->user_imagen_ruta = '/img/fotoperfil/';
            $user->user_imagen_nombre = 'user.png';
            $user->role_id = '4';
            $user->save();

            if(Matricula::all()->count()){
                $last_matr_id=Matricula::all()->last()->matr_id+1;
            }
            else{
                $last_matr_id=1;
            }

            $matricula->matr_id = $last_matr_id;
            $matricula->alum_id = $last_alum_id;
            $matricula->aula_id = $request->aula_id;
            $matricula->matr_año_ingreso = $request->matr_año_ingreso;
            $matricula->matr_estado = '1';
            $matricula->save();

            $aula = Aula::Find($request->aula_id);
            $aula->aula_capacidad -= 1;
            $aula->update();

            if(AlumnoSeccion::all()->count()){
                $last_asec_id=AlumnoSeccion::all()->last()->asec_id+1;
            }
            else{
                $last_asec_id=1;
            }

            $alumno_seccion = new AlumnoSeccion();
            $alumno_seccion->asec_id = $last_asec_id;
            $alumno_seccion->alum_id = $last_alum_id;
            $alumno_seccion->aula_id = $request->aula_id;
            $alumno_seccion->save();

            $curso_secciones = DB::table('cursos_secciones')->where('aula_id', $request->aula_id)->get();

            foreach ($curso_secciones as $curso_seccion){

                if(Nota::all()->count()){
                    $last_nota_id = Nota::all()->last()->nota_id+1;
                }else{
                    $last_nota_id = 1;
                }

                $nota = new Nota();
                $nota->nota_id = $last_nota_id;
                $nota->asec_id = $last_asec_id;
                $nota->csec_id = $curso_seccion->csec_id;
                $nota->save();

                for($j=0;$j<4;$j++) {
                    if(NotaSemanal::all()->count()){
                        $last_nsem_id = NotaSemanal::all()->last()->nsem_id+1;
                    }else{
                        $last_nsem_id = 1;
                    }

                    $nota_semana = new NotaSemanal();
                    $nota_semana->nsem_id = $last_nsem_id;
                    $nota_semana->nota_id = $last_nota_id;
                    $nota_semana->nsem_bimestre = ($j+1);
                    $nota_semana->nsem_estado = '1';
                    $nota_semana->save();
                }
            }

            return redirect()->route('matriculas.index')->with('datos','Matricula Registrada ...!');

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
        $matricula = Matricula::find($id);

        $aula_anterior = Aula::find($request->aula_id);
        $aula_anterior->aula_capacidad += 1;
        $aula_anterior->update();


        $aulas = DB::table('aulas')->where('grado_id', $request->grado_id)->where('secc_id', $request->secc_id)
        ->select('aula_id', 'aula_capacidad')->first();


        $aula_nueva = Aula::find($aulas->aula_id);
        $aula_nueva->aula_capacidad -= 1;
        $aula_nueva->update();

        $aula_seccion = AlumnoSeccion::find($request->alum_id);
        $aula_seccion->aula_id = $aula_nueva->aula_id;
        $aula_seccion->update();

        $matricula->aula_id = $aulas->aula_id;
        $matricula->update();

        return redirect()->route('matriculas.index')->with('datos','Aula cambiada con exito ...!');
    }

    public function destroy($id)
    {
        $matricula = Matricula::find($id);
        $matricula->matr_estado = '0';
        $matricula->save();

        $alumno = Alumno::find($matricula->alum_id);
        $alumno->alum_estado = '0';
        $alumno->save();

        $aula = Aula::find($matricula->aula_id);
        $aula->aula_capacidad += 1;
        $aula->save();

        $alumno_seccion = AlumnoSeccion::find($matricula->alum_id);
        $alumno_seccion->asec_estado = '0';
        $alumno_seccion->save();


        $alumnos_asistencia = Asistencia::where('asec_id', '=',$alumno_seccion->asec_id)->get();

        for($i=0;$i<count($alumnos_asistencia);$i++){
            $alumno_asistencia = Asistencia::findOrFail($alumnos_asistencia[$i]->asis_id);
            $alumno_asistencia->asis_alum_estado = '0';
            $alumno_asistencia->save();
        }

        $alumnos_nota = Nota::where('asec_id', '=', $alumno_seccion->asec_id)->get();

        for($i=0;$i<count($alumnos_nota);$i++){
            $alumno_nota = Nota::findOrFail($alumnos_nota[$i]->nota_id);
            $alumno_nota->nota_estado = '0';
            $alumno_nota->save();
        }

        for($i=0;$i<count($alumnos_nota);$i++){
            $alumnos_nota_semanal = NotaSemanal::where('nota_id', '=', $alumnos_nota[$i]->nota_id)->get();

            for($j=0;$j<4;$j++) {
                DB::table('notas_semanas')->where('nsem_id', $alumnos_nota_semanal[$j]->nsem_id)->update([
                    'nsem_estado' => '0'
                ]);
            }

        }

        return redirect()->route('matriculas.index')->with('datos','Matricula anulada con exito ...!');
    }
}