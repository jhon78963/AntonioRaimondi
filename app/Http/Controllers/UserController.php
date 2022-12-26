<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; //trabajar con base de datos utilizando procedimientos almacenados
use App\Models\User;
use App\Models\UserProfile;
use Spatie\Permission\Models\Role;
use DataTables;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware("can:users.index", ['only'=>['index']]);
        $this->middleware("can:users.create", ['only'=>['create', 'store']]);
        $this->middleware("can:users.edit", ['only'=>['actualizar']]);
        $this->middleware("can:users.show", ['only'=>['show']]);
        $this->middleware("can:users.delete", ['only'=>['eliminar']]);
        $this->middleware("can:users.profile", ['only'=>['profile', 'update']]);
        $this->middleware("can:users.assign", ['only'=>['guardar']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $users = DB::table('users as u')
                        ->join('user_profiles as up', 'u.user_id', 'up.user_id')
                        ->where('u.user_state', '1')
                        ->select(DB::raw("CONCAT(up.upro_firstName, ' ', up.upro_lastName) AS upro_fullName"), 'u.user_id', 'u.user_name', 'up.upro_email')
                        ->get();
            return DataTables::of($users)
                ->addColumn('action', function($users){
                    $acciones = '<a href="javascript:void(0)" onclick="editUser('.$users->user_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<a href="javascript:void(0)" onclick="assignUser('.$users->user_id.')" class="btn btn-warning btn-sm"> Asignar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$users->user_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $usuario = UserProfile::find(auth()->user()->user_id);
        $roles = Role::all();
        return view('usuario.usuario', compact('usuario', 'roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        request()->validate([
            'user_name' => ['required',  'unique:users','max:8', 'min:8'],
            'user_password' => ['required', 'max:25', 'min:8'],
        ],
        [
            'user_name.required'=>'Ingrese el usuario',
            'user_name.max'=>'Maximo 25 caracteres permitidos para el usuario',
            'user_name.unique'=>'El usuario ingresado ya se ha registrado en el sistema',
            'user_password.required'=>'Ingrese la contraseña del usuario',
            'user_password.min'=> 'Mínimo 8 caracteres permitidos para el password del usuario',
            'user_password.max'=> 'Maximo 25 caracteres permitidos para el password del usuario',
        ]);

        if (User::all()->count()) {
            $last_user_id = User::all()->last()->user_id+1;
        } else {
            $last_role_id = 1;
        }

        if (UserProfile::all()->count()) {
            $last_upro_id = UserProfile::all()->last()->upro_id+1;
        } else {
            $last_upro_id = 1;
        }

        DB::table('users')->insert([
            'user_id' => $last_user_id,
            'user_name' => $request->user_name,
            'user_password' => Hash::make($request->input('user_password')),
            'user_state' => '1',
            'role_id' => '1'
        ]);

        DB::table('user_profiles')->insert([
            'upro_id' => $last_user_id,
            'user_id' => $last_user_id
        ]);

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $user = DB::table('users')->where('user_id', $id)->get();
        return response()->json($user);
    }

    public function actualizar(Request $request)
    {
        $usuario = User::findOrFail($request->user_id);

        if($request->user_password !=null){
            $request->merge([
                'user_password' => Hash::make($request->input('user_password'))
            ]);

            User::findOrFail($request->user_id)->update($request->all());
        }


        DB::table('users')->where('user_id', $request->user_id)->update([
            'user_name' => $request->user_name,
        ]);

        return back();
    }

    public function asignar($id)
    {
        $user = DB::table('users')->where('user_id', $id)->get();
        return response()->json($user);
    }

    public function guardar(Request $request)
    {
        request()->validate([
            'role_id' => ['required'],
        ],
        [
            'role_id.required'=>'Seleccione rol',
        ]);

        if ($request->role_id != null){
            DB::table('model_has_permissions as mp')->join('model_has_roles as mr', 'mp.model_id', 'mr.model_id')->where('mr.role_id', $request->role_id)->delete();
            DB::table('model_has_roles')->where('role_id', $request->role_id)->delete();

            $user = User::find($request->user_id);
            $rol = Role::find($request->role_id);

            $user->assignRole($rol->name);

            $permissions = DB::table('role_has_permissions as rp')
                ->join('permissions as p', 'rp.permission_id', 'p.id')
                ->where('rp.role_id', $request->role_id)
                ->get('p.name');


            for($i=0;$i<count($permissions);$i++){
                $user->givePermissionTo($permissions[$i]->name);
            }
        }

        return back();
    }

    public function eliminar($id)
    {
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        DB::table('model_has_roles')->where('model_id', '>', $id)->decrement('model_id', 1);
        DB::table('model_has_permissions')->where('model_id', $id)->delete();
        DB::table('model_has_permissions')->where('model_id', '>', $id)->decrement('model_id', 1);
        DB::table('user_profiles')->where('upro_id', $id)->delete();
        DB::table('user_profiles')->where('upro_id', '>', $id)->decrement('upro_id', 1);
        DB::table('users')->where('user_id', $id)->delete();
        DB::table('users')->where('user_id', '>', $id)->decrement('user_id', 1);
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