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
});


// Route::group(['middleware' => 'admin'], function () {});
// Route::group(['middleware' => 'listar'], function () {});
// Route::group(['middleware' => 'crear'], function () {});
// Route::group(['middleware' => 'editar'], function () {});
// Route::group(['middleware' => 'mostrar'], function () {});
// Route::group(['middleware' => 'eliminar'], function () {});