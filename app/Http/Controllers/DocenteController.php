<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Docente;
use App\Models\Pais;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;

class DocenteController extends Controller
{
    public function __construct(){
        $this->middleware("can:docentes.index", ['only'=>['index']]);
        $this->middleware("can:docentes.create", ['only'=>['create', 'store']]);
        $this->middleware("can:docentes.edit", ['only'=>['edit', 'actualizar']]);
        $this->middleware("can:docentes.show", ['only'=>['show']]);
        $this->middleware("can:docentes.delete", ['only'=>['destroy', 'eliminar']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $docentes = DB::table('docentes as do')
            ->join('distritos as d', 'do.dist_id', 'd.dist_id')
            ->where('do.doce_estado', '!=', '3')
            ->select('do.doce_id', 'do.doce_dni', DB::raw("CONCAT(do.doce_apellidoPaterno, ' ', do.doce_apellidoMaterno, ' ', do.doce_primerNombre, ' ', do.doce_otrosNombres) AS doce_fullName"), DB::raw("CONCAT(do.doce_direccion, ', ', d.dist_nombre) as doce_fullDireccion"), 'do.doce_celular')
            ->get();
            return DataTables::of($docentes)
                ->addColumn('action', function($docentes){
                    $acciones = '<a href="javascript:void(0)" onclick="editDocente('.$docentes->doce_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$docentes->doce_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $paises = Pais::all();
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();
        return view('docente.index', compact('paises', 'departamentos', 'provincias', 'distritos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (Docente::all()->count()) {
            $last_doce_id = Docente::all()->last()->doce_id+1;
        } else {
            $last_doce_id = 1;
        }

        DB::table('docentes')->insert([
            'doce_id' => $last_doce_id,
            'doce_dni' => $request->doce_dni,
            'doce_apellidoPaterno' => $request->doce_apellidoPaterno,
            'doce_apellidoMaterno' => $request->doce_apellidoMaterno,
            'doce_primerNombre' => $request->doce_primerNombre,
            'doce_otrosNombres' => $request->doce_otrosNombres,
            'doce_sexo' => $request->doce_sexo,
            'doce_direccion' => $request->doce_direccion,
            'doce_telefono' => $request->doce_telefono,
            'doce_celular' => $request->doce_celular,
            'doce_fechaIngreso' => $request->doce_fechaIngreso,
            'doce_estado' => '0',
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
            'user_name' => $request->doce_dni,
            'user_password' => Hash::make($request->input('doce_dni')),
            'user_state' => '1',
            'role_id' => '3',
        ]);

        DB::table('user_profiles')->insert([
            'upro_id' => $last_user_id,
            'upro_company' => 'AntonioRaimondi',
            'upro_firstName' => $request->doce_primerNombre,
            'upro_lastName' => $request->doce_apellidoPaterno.' '.$request->doce_apellidoMaterno,
            'upro_phoneNumber' => $request->doce_celular,
            'upro_address' =>  $request->doce_direccion.', '.$distrito->dist_nombre,
            'upro_city' => $provincia->prov_nombre,
            'upro_country' => $pais->pais_nombre,
            'upro_image' => '/img/fotoperfil/user.png',
            'upro_aboutMe' => 'Docente',
            'user_id' => $last_user_id
        ]);

        $user = User::find($last_user_id);
        $user->assignRole('docente');

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
        $docentes = DB::table('docentes')->where('doce_id', $id)->get();
        return response()->json($docentes);
    }

    public function actualizar(Request $request)
    {
        DB::table('docentes')->where('doce_id', $request->doce_id)->update([
            'doce_dni' => $request->doce_dni,
            'doce_apellidoPaterno' => $request->doce_apellidoPaterno,
            'doce_apellidoMaterno' => $request->doce_apellidoMaterno,
            'doce_primerNombre' => $request->doce_primerNombre,
            'doce_otrosNombres' => $request->doce_otrosNombres,
            'doce_sexo' => $request->doce_sexo,
            'doce_direccion' => $request->doce_direccion,
            'doce_telefono' => $request->doce_telefono,
            'doce_celular' => $request->doce_celular,
            'doce_fechaIngreso' => $request->doce_fechaIngreso,
            'pais_id' => $request->pais_id,
            'depa_id' => $request->depa_id,
            'prov_id' => $request->prov_id,
            'dist_id' => $request->dist_id
        ]);

        return back();
    }

    public function eliminar($id)
    {
        DB::table('docentes')->where('doce_id', $id)->update(['doce_estado' => '3']);
        $docente = Docente::find($id);
        DB::table('users')->where('user_name', $docente->doce_dni)->update(['user_state'=> '0']);

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