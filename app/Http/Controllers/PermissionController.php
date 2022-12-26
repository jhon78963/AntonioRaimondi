<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserProfile;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;

class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware("can:permissions.index", ['only'=>['index']]);
        $this->middleware("can:permissions.create", ['only'=>['create', 'store']]);
        $this->middleware("can:permissions.edit", ['only'=>['actualizar']]);
        $this->middleware("can:permissions.show", ['only'=>['show']]);
        $this->middleware("can:permissions.delete", ['only'=>['eliminar']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $permissions = DB::table('permissions')->get();
            return DataTables::of($permissions)
                ->addColumn('action', function($permissions){
                    $acciones = '<a href="javascript:void(0)" onclick="editPermission('.$permissions->id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$permissions->id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $roles = Role::all();
        return view('usuario.permiso', compact('roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        request()->validate([
            'perm_name' => ['required', 'max:25'],
        ],
        [
            'perm_name.required'=>'Ingrese nombre del permiso',
            'perm_name.alpha'=>'El nombre del permiso solo debe contener letras',
            'perm_name.max'=>'Maximo 25 caracteres permitidos para el nombre del permiso',
        ]);

        if (Permission::all()->count()) {
            $last_perm_id = Permission::all()->last()->id+1;
        } else {
            $last_perm_id = 1;
        }

        Permission::create([
            'id' => $last_perm_id,
            'name' => $request->perm_name,
            'guard_name' => 'web'
        ]);

        $roles = $request->role;
        $roles_name = $request->role_name;

        if($roles != null){
            for($i=0;$i<count($roles);$i++){
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $last_perm_id,
                    'role_id' => $roles[$i]
                ]);

                $users = User::where('user_state','1')->get();
                for($j=0;$j<count($users);$j++){
                    if($users[$j]->role_id == $roles[$i]){
                        $users[$j]->assignRole($roles_name[$i]);
                    }
                }
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
        $permission = DB::table('permissions')->where('id', $id)->get();
        return response()->json($permission);
    }

    public function actualizar(Request $request)
    {
        DB::table('permissions')->where('id', $request->perm_id)->update([
            'name' => $request->perm_name
        ]);

        DB::table('role_has_permissions')->where('permission_id', $request->perm_id)->delete();

        $roles = $request->role_edit;
        $roles_name = $request->role_name_update;

        if($roles != null){
            for($i=0;$i<count($roles);$i++){
                DB::table('role_has_permissions')->insert([
                    'role_id' => $request->role_edit[$i],
                    'permission_id' => $request->perm_id
                ]);

                $users = User::where('user_state','1')->get();
                for($j=0;$j<count($users);$j++){
                    if($users[$j]->role_id == $roles[$i]){
                        $users[$j]->assignRole($roles_name[$i]);
                    }
                }
            }
        }

        return back();
    }

    public function eliminar($id)
    {
        DB::table('permissions')->where('id', $id)->delete();
        DB::table('permissions')->where('id', '>', $id)->decrement('id', 1);
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