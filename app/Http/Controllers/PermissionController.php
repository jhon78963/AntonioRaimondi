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
        $this->middleware("can:permissions.edit", ['only'=>['edit', 'actualizar']]);
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
        if (Permission::all()->count()) {
            $last_perm_id = Permission::all()->last()->id+1;
        } else {
            $last_perm_id = 1;
        }

        DB::table('permissions')->insert([
            'id' => $last_perm_id,
            'name' => $request->perm_name
        ]);


        $roles = $request->role;

        if($roles != null){
            for($i=0;$i<count($roles);$i++){
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $last_perm_id,
                    'role_id' => $roles[$i]
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
        $permission = DB::table('permissions')->where('id', $id)->get();
        return response()->json($permission);
    }

    public function actualizar(Request $request)
    {
        DB::table('permissions')->where('id', $request->perm_id)->update([
            'name' => $request->perm_name
        ]);

        return back();

        // DB::table('role_has_permissions')->where('permission_id', $request->perm_id)->delete();

        // $roles = $request->role_edit;

        // if($roles != null){
        //     for($i=0;$i<count($roles);$i++){
        //         DB::table('role_has_permissions')->insert([
        //             'role_id' => $request->role_edit[$i],
        //             'permission_id' => $request->perm_id
        //         ]);
        //     }
        // }

        // $perm_roles = DB::table('model_has_permissions as mp')
        //     ->join('model_has_roles as mr', 'mp.model_id', 'mr.model_id')
        //     ->where('mp.permission_id', $request->perm_id)
        //     ->get();

        // if ($roles == null){
        //     DB::table('model_has_permissions')->where('permission_id', $request->perm_id)->delete();
        // }else{
        //     for($j=0;$j<count($roles);$j++){
        //         for($i=0;$i<count($perm_roles);$i++){
        //             if($roles[$j] != $perm_roles[$i]->role_id){
        //                 DB::table('model_has_permissions as mp')
        //                 ->join('model_has_roles as mr', 'mp.model_id', 'mr.model_id')
        //                 ->where('mr.role_id', $perm_roles[$i]->role_id)
        //                 ->where('mp.permission_id', $request->perm_id)
        //                 ->delete();
        //             }
        //         }
        //     }
        // }

        // $rol_ids = $request->rol_id;
        // $permiso = DB::table('permissions')->where('id', $request->perm_id)->first();
        // $users = User::permission($permiso->name)->get();
        // return dd($perm_roles);
        // return dd($roles);






        // for($j=0;$j<count($roles);$j++){
        //     for($i=0;$i<count($perm_roles);$i++){
        //         if($roles[$j] != $perm_roles[$i]->role_id){
        //             DB::table('model_has_permissions as mp')
        //             ->join('model_has_roles as mr', 'mp.model_id', 'mr.model_id')
        //             ->where('mr.role_id', $perm_roles[$i]->role_id)
        //             ->where('mp.permission_id', $request->perm_id)
        //             ->delete();
        //         }
        //     }
        // }






        // Removemos el permiso a todos los usuarios que tengan dicho permiso
        //

        // Obtenemos los usuarios que tenga el permiso que estamos editando
        // $users = User::permission($permisos->name)->get();




        // if($users != null){
        //     for($i=0;$i<count($users);$i++){

        //     }
        // }

        // for($i=0;$i<count($roles);$i++){

        //     return dd($users_roles[0]);
        // }
        // $users_roles = User::role('admin');
        // return dd($users_roles);


        // Obtenemos los roles que hemos seleccionado
        // $rols = DB::table('role_has_permissions as rp')
        //     ->join('permissions as p', 'rp.permission_id', 'p.id')
        //     ->where('rp.permission_id', $request->perm_id)
        //     ->get('r.name');

        // if($users != null){
        //     for($i=0;$i<count($users);$i++){
        //         $users[$i]->givePermissionTo($permisos->name);
        //     }
        // }

        // return back();
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