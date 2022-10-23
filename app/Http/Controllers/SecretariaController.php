<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Secretaria;
use App\Models\Pais;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;

class SecretariaController extends Controller
{
    public function __construct(){
        $this->middleware("can:secretarias.index", ['only'=>['index']]);
        $this->middleware("can:secretarias.create", ['only'=>['create', 'store']]);
        $this->middleware("can:secretarias.edit", ['only'=>['edit', 'actualizar']]);
        $this->middleware("can:secretarias.show", ['only'=>['show']]);
        $this->middleware("can:secretarias.delete", ['only'=>['destroy', 'eliminar']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $secretarias = DB::table('secretarias as s')
            ->join('distritos as d', 's.dist_id', 'd.dist_id')
            ->where('s.secre_estado', '!=', '3')
            ->select('s.secre_id', 's.secre_dni', DB::raw("CONCAT(s.secre_apellidoPaterno, ' ', s.secre_apellidoMaterno, ' ', s.secre_primerNombre, ' ', s.secre_otrosNombres) AS secre_fullName"), DB::raw("CONCAT(s.secre_direccion, ', ', d.dist_nombre) as secre_fullDireccion"), 's.secre_celular')
            ->get();
            return DataTables::of($secretarias)
                ->addColumn('action', function($secretarias){
                    $acciones = '<a href="javascript:void(0)" onclick="editSecretaria('.$secretarias->secre_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$secretarias->secre_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $paises = Pais::all();
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();
        return view('secretaria.index', compact('paises', 'departamentos', 'provincias', 'distritos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (Secretaria::all()->count()) {
            $last_secre_id = Secretaria::all()->last()->secre_id+1;
        } else {
            $last_secre_id = 1;
        }

        DB::table('secretarias')->insert([
            'secre_id' => $last_secre_id,
            'secre_dni' => $request->secre_dni,
            'secre_apellidoPaterno' => $request->secre_apellidoPaterno,
            'secre_apellidoMaterno' => $request->secre_apellidoMaterno,
            'secre_primerNombre' => $request->secre_primerNombre,
            'secre_otrosNombres' => $request->secre_otrosNombres,
            'secre_sexo' => $request->secre_sexo,
            'secre_direccion' => $request->secre_direccion,
            'secre_telefono' => $request->secre_telefono,
            'secre_celular' => $request->secre_celular,
            'secre_fechaIngreso' => $request->secre_fechaIngreso,
            'secre_estado' => '1',
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
            'user_name' => $request->secre_dni,
            'user_password' => Hash::make($request->input('secre_dni')),
            'user_state' => '1',
            'role_id' => '4',
        ]);

        DB::table('user_profiles')->insert([
            'upro_id' => $last_user_id,
            'upro_company' => 'AntonioRaimondi',
            'upro_firstName' => $request->secre_primerNombre,
            'upro_lastName' => $request->secre_apellidoPaterno.' '.$request->secre_apellidoMaterno,
            'upro_phoneNumber' => $request->secre_celular,
            'upro_address' =>  $request->secre_direccion.', '.$distrito->dist_nombre,
            'upro_city' => $provincia->prov_nombre,
            'upro_country' => $pais->pais_nombre,
            'upro_image' => '/img/fotoperfil/user.png',
            'upro_aboutMe' => 'Secretaria',
            'user_id' => $last_user_id
        ]);

        $user = User::find($last_user_id);
        $user->assignRole('secretaria');

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
        $secretarias = DB::table('secretarias')->where('secre_id', $id)->get();
        return response()->json($secretarias);
    }

    public function actualizar(Request $request)
    {
        DB::table('secretarias')->where('secre_id', $request->secre_id)->update([
            'secre_dni' => $request->secre_dni,
            'secre_apellidoPaterno' => $request->secre_apellidoPaterno,
            'secre_apellidoMaterno' => $request->secre_apellidoMaterno,
            'secre_primerNombre' => $request->secre_primerNombre,
            'secre_otrosNombres' => $request->secre_otrosNombres,
            'secre_sexo' => $request->secre_sexo,
            'secre_direccion' => $request->secre_direccion,
            'secre_telefono' => $request->secre_telefono,
            'secre_celular' => $request->secre_celular,
            'secre_fechaIngreso' => $request->secre_fechaIngreso,
            'pais_id' => $request->pais_id,
            'depa_id' => $request->depa_id,
            'prov_id' => $request->prov_id,
            'dist_id' => $request->dist_id
        ]);

        return back();
    }

    public function eliminar($id)
    {
        DB::table('secretarias')->where('secre_id', $id)->update(['secre_estado' => '3']);
        $secretaria = Secretaria::find($id);
        DB::table('users')->where('user_name', $secretaria->secre_dni)->update(['user_state'=> '0']);

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