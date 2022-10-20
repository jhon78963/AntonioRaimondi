<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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