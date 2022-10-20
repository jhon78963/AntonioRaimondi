<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class EliminarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $permissions = DB::table('roles_permissions')->where('role_id', Auth::user()->role_id)->get();
        $permiso = false;
        foreach ($permissions as $permission) {
            if ($permission->perm_id == '5') {
                $permiso = true;
            }
        }

        if(Auth::check() && $permiso == true){
            return $next($request);
        }
        abort(401);
    }
}