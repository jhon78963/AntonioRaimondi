<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:bienvenido.index", ['only'=>['index']]);
    }

    public function index()
    {
        // $usuario = UserProfile::find(auth()->user()->user_id);
        // $usuario_count = User::all()->count();
        // $producto_count = Product::all()->count();
        // $sale_count = Sale::all()->count();
        // $order_count = Order::all()->count();
        // $latest_members = User::where('user_state', '1')->where('created_at','>=',Carbon::now()->subdays(15))->get();
        // $count_members = User::where('user_state', '1')->where('created_at','>=',Carbon::now()->subdays(15))->count();

        // $users_roles = Role::join('users as u', 'roles.role_id', 'u.role_id')
        //     ->select(DB::raw("COUNT(u.user_id) AS cantidad, roles.role_description"))
        //     ->groupBy('roles.role_description')
        //     ->get();

        // $last_sessions = [];
        // foreach($latest_members as $user)
        // {
        //     $fechaActual = Carbon::now();
        //     $fechaVigencia = Carbon::parse($user->user_lastLogin);
        //     $last_sessions[] = $fechaVigencia->diff($fechaActual);
        // }
        // , compact('usuario', 'usuario_count', 'latest_members', 'count_members', 'last_sessions', 'users_roles', 'producto_count', 'sale_count', 'order_count')

        return view('welcome');
    }
}