<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('usuario.login');
})->middleware('guest');

// Login
Route::get('login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.index')->middleware('guest');
Route::post('login/validar', [App\Http\Controllers\LoginController::class, 'validarCredenciales'])->name('login.validar');
Route::get('login/cerrarSesion', [App\Http\Controllers\LoginController::class, 'cerrarSesion'])->name('login.cerrarSesion');

Route::group(['middleware' => 'auth'], function () {
    // Home
    Route::resource('bienvenido', App\Http\Controllers\HomeController::class);
    Route::get('regresar',[App\Http\Controllers\HomeController::class, 'regresar'])->name('home.back');

    // Roles
    Route::post('role/actualizar/', [App\Http\Controllers\RoleController::class, 'actualizar'])->name('roles.actualizar');
    Route::get('role/eliminar/{id}', [App\Http\Controllers\RoleController::class, 'eliminar'])->name('roles.eliminar');
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::any('ajax/roles/list',[App\Http\Controllers\RoleController::class, 'index'])->name('roles.list');

    // Usuarios
    Route::post('user/actualizar', [App\Http\Controllers\UserController::class, 'actualizar'])->name('users.actualizar');
    Route::get('user/eliminar/{id}', [App\Http\Controllers\UserController::class, 'eliminar'])->name('users.eliminar');
    Route::get('user/{id}/assign', [App\Http\Controllers\UserController::class, 'asignar'])->name('users.asignar');
    Route::post('user/guardar', [App\Http\Controllers\UserController::class, 'guardar'])->name('users.guardar');
    Route::resource('users', App\Http\Controllers\UserController::class);

    // Perfil
    Route::resource('profiles', App\Http\Controllers\PerfilController::class);

    // Permisos
    Route::post('permission/actualizar', [App\Http\Controllers\PermissionController::class, 'actualizar'])->name('permission.actualizar');
    Route::get('permission/eliminar/{id}', [App\Http\Controllers\PermissionController::class, 'eliminar'])->name('permission.eliminar');
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('pruebas', App\Http\Controllers\PruebaController::class);

    // Alumno
    Route::post('alumno/actualizar', [App\Http\Controllers\AlumnoController::class, 'actualizar'])->name('alumnos.actualizar');
    Route::get('alumno/eliminar/{id}', [App\Http\Controllers\AlumnoController::class, 'eliminar'])->name('alumnos.eliminar');
    Route::resource('alumnos', App\Http\Controllers\AlumnoController::class);

    // Docente
    Route::post('docente/actualizar', [App\Http\Controllers\DocenteController::class, 'actualizar'])->name('docentes.actualizar');
    Route::get('docente/eliminar/{id}', [App\Http\Controllers\DocenteController::class, 'eliminar'])->name('docentes.eliminar');
    Route::resource('docentes', App\Http\Controllers\DocenteController::class);

    // Secretaria
    Route::post('secretaria/actualizar', [App\Http\Controllers\SecretariaController::class, 'actualizar'])->name('secretarias.actualizar');
    Route::get('secretaria/eliminar/{id}', [App\Http\Controllers\SecretariaController::class, 'eliminar'])->name('secretarias.eliminar');
    Route::resource('secretarias', App\Http\Controllers\SecretariaController::class);

    // Curso
    Route::post('curso/actualizar', [App\Http\Controllers\CursoController::class, 'actualizar'])->name('cursos.actualizar');
    Route::get('curso/eliminar/{id}', [App\Http\Controllers\CursoController::class, 'eliminar'])->name('cursos.eliminar');
    Route::resource('cursos', App\Http\Controllers\CursoController::class);

    // Aulas
    Route::post('aula/actualizar', [App\Http\Controllers\AulaController::class, 'actualizar'])->name('aulas.actualizar');
    Route::get('aula/eliminar/{id}', [App\Http\Controllers\AulaController::class, 'eliminar'])->name('aulas.eliminar');
    Route::post('aula/grado', [App\Http\Controllers\AulaController::class, 'grado'])->name('aulas.grado');
    Route::post('aula/seccion', [App\Http\Controllers\AulaController::class, 'seccion'])->name('aulas.seccion');
    Route::resource('aulas', App\Http\Controllers\AulaController::class);

    // Errors
    Route::get('errors/401',[App\Http\Controllers\RoleController::class, 'error401']);
});


// Route::group(['middleware' => 'admin'], function () {});
// Route::group(['middleware' => 'listar'], function () {});
// Route::group(['middleware' => 'crear'], function () {});
// Route::group(['middleware' => 'editar'], function () {});
// Route::group(['middleware' => 'mostrar'], function () {});
// Route::group(['middleware' => 'eliminar'], function () {});