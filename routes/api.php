<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/role/{id}/permission', function($role_id){
    return DB::table('role_has_permissions')
        ->where('role_id', $role_id)
        ->select('role_id', 'permission_id')
        ->get();
});

Route::get('/permission/{id}/role', function($perm_id){
    return DB::table('role_has_permissions')
        ->where('permission_id', $perm_id)
        ->select('role_id', 'permission_id')
        ->get();
});

Route::get('pais/{id}/departamentos', function($id) {
    return Departamento::where('pais_id',$id)->get();
});

Route::get('departamento/{id}/provincias', function($id) {
    return Provincia::where('depa_id',$id)->get();
});

Route::get('provincia/{id}/distritos', function($id) {
    return Distrito::where('prov_id',$id)->get();
});