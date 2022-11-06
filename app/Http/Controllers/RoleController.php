<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Role;
use App\Models\UserProfile;
use App\Models\User;
// use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use DataTables;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware("can:roles.index", ['only'=>['index']]);
        $this->middleware("can:roles.create", ['only'=>['create', 'store']]);
        $this->middleware("can:roles.edit", ['only'=>['actualizar']]);
        $this->middleware("can:roles.show", ['only'=>['show']]);
        $this->middleware("can:roles.delete", ['only'=>['eliminar']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $roles = DB::table('roles')->get();
            return DataTables::of($roles)
                ->addColumn('action', function($roles){
                    $acciones = '<a href="javascript:void(0)" onclick="editRole('.$roles->id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$roles->id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $permissions = Permission::all();
        return view('usuario.role', compact('permissions'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        request()->validate([
            'role_name' => ['required', 'string', 'max:25'],
        ],
        [
            'role_name.required'=>'Ingrese nombre del rol',
            'role_name.alpha'=>'El nombre del rol solo debe contener letras',
            'role_name.max'=>'Maximo 25 caracteres permitidos para el nombre del rol',
        ]);

        if (Role::all()->count()) {
            $last_role_id = Role::all()->last()->id+1;
        } else {
            $last_role_id = 1;
        }

        DB::table('roles')->insert([
            'id' => $last_role_id,
            'name' =>$request->role_name,
            'guard_name' => 'web'
        ]);

        $permisos = $request->permission;

        if ($permisos != null){
            for($i=0;$i<count($permisos);$i++){
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permisos[$i],
                    'role_id' => $last_role_id
                ]);
            }
        }


        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $rol = DB::table('roles')->where('id', $id)->get();
        return response()->json($rol);
    }

    public function actualizar(Request $request)
    {
        DB::table('roles')->where('id', $request->role_id)->update([
            'name' => $request->role_name
        ]);

        DB::table('role_has_permissions')->where('role_id', $request->role_id)->delete();

        $permisos = $request->permission_edit;


        if($permisos != null){
            for($i=0;$i<count($permisos);$i++){
                DB::table('role_has_permissions')->insert([
                    'role_id' => $request->role_id,
                    'permission_id' => $request->permission_edit[$i]
                ]);
            }
        }

        return back();
    }

    public function eliminar($id)
    {
        DB::table('roles')->where('id', $id)->delete();
        DB::table('roles')->where('id', '>', $id)->decrement('id', 1);
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