<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Alumno;
use App\Models\Aula;

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

Route::get('pais/{id}/departamentos', function($id) {
    return Departamento::where('pais_id',$id)->get();
});

Route::get('departamento/{id}/provincias', function($id) {
    return Provincia::where('depa_id',$id)->get();
});

Route::get('provincia/{id}/distritos', function($id) {
    return Distrito::where('prov_id',$id)->get();
});


Route::get('alumno/{id}', function($id) {
    return Alumno::find($id);
});

Route::get('grado/{id}/secciones', function($id) {
    return Aula::where('grad_id',$id)->get();
});


Route::get('/aulas/{id}', [App\Http\Controllers\MatriculaController::class, 'listarSecciones']);

Route::get('/vacantes/{grad_id}/{secc_id}', [App\Http\Controllers\MatriculaController::class, 'listarVacantes']);

Route::get('/aulas/{grad_id}/{secc_id}', [App\Http\Controllers\MatriculaController::class, 'listarIdAula']);

Route::get('/alumnos/{csec_id}/{doce_id}', [App\Http\Controllers\NotaController::class, 'listarAlumnos']);

Route::get('/alumno/{csec_id}/{alum_id}', [App\Http\Controllers\NotaController::class, 'listarNotas']);

Route::get('/alumnos/bimestre/{csec_id}/{doce_id}/{bimestre}', [App\Http\Controllers\NotaController::class, 'listarNotaSemanal']);

Route::get('/alumno/bimestre/{csec_id}/{alum_id}/{bimestre}', [App\Http\Controllers\NotaController::class, 'listarNotaSemanalAlumno']);

Route::get('/aula/{gsec_id}/docente', [App\Http\Controllers\NotaController::class, 'listarDocentes']);

Route::get('/docente/{doce_id}/curso', [App\Http\Controllers\NotaController::class, 'listarCursos']);

Route::get('/aula/asistencia/{fecha}/{docente}', [App\Http\Controllers\AsistenciaController::class, 'listaAlumnos']);

Route::get('/asistencia/alumno/{fecha}/{alum_id}', [App\Http\Controllers\AsistenciaController::class, 'listaAsistenciaAlumno']);