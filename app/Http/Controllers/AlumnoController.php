<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Alumno;
use App\Models\Pais;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;

class AlumnoController extends Controller
{
    public function __construct(){
        $this->middleware("can:alumnos.index", ['only'=>['index']]);
        $this->middleware("can:alumnos.create", ['only'=>['create', 'store']]);
        $this->middleware("can:alumnos.edit", ['only'=>['edit', 'actualizar']]);
        $this->middleware("can:alumnos.show", ['only'=>['show']]);
        $this->middleware("can:alumnos.delete", ['only'=>['destroy', 'eliminar']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $alumnos = DB::table('alumnos as a')
            ->join('distritos as d', 'a.dist_id', 'd.dist_id')
            ->where('a.alum_estado', '!=', '3')
            ->select('a.alum_id', 'a.alum_dni', DB::raw("CONCAT(a.alum_apellidoPaterno, ' ', a.alum_apellidoMaterno, ' ', a.alum_primerNombre, ' ', a.alum_otrosNombres) AS alum_fullName"), DB::raw("CONCAT(a.alum_direccion, ', ', d.dist_nombre) as alum_fullDireccion"), 'a.alum_celular')
            ->get();
            return DataTables::of($alumnos)
                ->addColumn('action', function($alumnos){
                    $acciones = '<a href="javascript:void(0)" onclick="editAlumno('.$alumnos->alum_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$alumnos->alum_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $paises = Pais::all();
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();
        return view('alumno.index', compact('paises', 'departamentos', 'provincias', 'distritos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (Alumno::all()->count()) {
            $last_alum_id = Alumno::all()->last()->alum_id+1;
        } else {
            $last_alum_id = 1;
        }

        DB::table('alumnos')->insert([
            'alum_id' => $last_alum_id,
            'alum_dni' => $request->alum_dni,
            'alum_apellidoPaterno' => $request->alum_apellidoPaterno,
            'alum_apellidoMaterno' => $request->alum_apellidoMaterno,
            'alum_primerNombre' => $request->alum_primerNombre,
            'alum_otrosNombres' => $request->alum_otrosNombres,
            'alum_sexo' => $request->alum_sexo,
            'alum_fechaNacimiento' => $request->alum_fechaNacimiento,
            'alum_direccion' => $request->alum_direccion,
            'alum_telefono' => $request->alum_telefono,
            'alum_celular' => $request->alum_celular,
            'alum_estado' => '0',
            'pais_id' => $request->pais_id,
            'depa_id' => $request->depa_id,
            'prov_id' => $request->prov_id,
            'dist_id' => $request->dist_id
        ]);

        $pais = DB::table('paises')->where('pais_id', $request->pais_id)->first();
        $provincia = DB::table('provincias')->where('prov_id', $request->prov_id)->first();
        $distrito = DB::table('distritos')->where('dist_id', $request->dist_id)->first();

        if (User::all()->count()) {
            $last_user_id = User::all()->last()->user_id+1;
        } else {
            $last_role_id = 1;
        }

        DB::table('users')->insert([
            'user_id' => $last_user_id,
            'user_name' => $request->alum_dni,
            'user_password' => Hash::make($request->input('alum_dni')),
            'user_state' => '1',
            'role_id' => '3',
        ]);

        DB::table('user_profiles')->insert([
            'upro_id' => $last_user_id,
            'upro_company' => 'AntonioRaimondi',
            'upro_firstName' => $request->alum_primerNombre,
            'upro_lastName' => $request->alum_apellidoPaterno.' '.$request->alum_apellidoMaterno,
            'upro_phoneNumber' => $request->alum_celular,
            'upro_address' =>  $request->alum_direccion.', '.$distrito->dist_nombre,
            'upro_city' => $provincia->prov_nombre,
            'upro_country' => $pais->pais_nombre,
            'upro_image' => '/img/fotoperfil/user.png',
            'upro_aboutMe' => 'Estudiante',
            'user_id' => $last_user_id
        ]);

        $user = User::find($last_user_id);
        $user->assignRole('alumno');

        $permissions = DB::table('model_has_roles as mr')
            ->join('role_has_permissions as rp', 'mr.role_id', 'rp.role_id')
            ->join('permissions as p', 'rp.permission_id', 'p.id')
            ->where('mr.model_id', $last_user_id)
            ->get('p.name');


        for($i=0;$i<count($permissions);$i++){
            $user->givePermissionTo($permissions[$i]->name);
        }

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $alumnos = DB::table('alumnos')->where('alum_id', $id)->get();
        return response()->json($alumnos);
    }

    public function actualizar(Request $request)
    {
        DB::table('alumnos')->where('alum_id', $request->alum_id)->update([
            'alum_dni' => $request->alum_dni,
            'alum_apellidoPaterno' => $request->alum_apellidoPaterno,
            'alum_apellidoMaterno' => $request->alum_apellidoMaterno,
            'alum_primerNombre' => $request->alum_primerNombre,
            'alum_otrosNombres' => $request->alum_otrosNombres,
            'alum_sexo' => $request->alum_sexo,
            'alum_fechaNacimiento' => $request->alum_fechaNacimiento,
            'alum_direccion' => $request->alum_direccion,
            'alum_telefono' => $request->alum_telefono,
            'alum_celular' => $request->alum_celular,
            'pais_id' => $request->pais_id,
            'depa_id' => $request->depa_id,
            'prov_id' => $request->prov_id,
            'dist_id' => $request->dist_id
        ]);

        return back();
    }

    public function eliminar($id)
    {
        DB::table('alumnos')->where('alum_id', $id)->update(['alum_estado' => '3']);
        $alumno = Alumno::find($id);
        DB::table('users')->where('user_name', $alumno->alum_dni)->update(['user_state'=> '0']);

        return back();
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