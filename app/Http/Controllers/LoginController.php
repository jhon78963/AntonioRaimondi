<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('usuario.login');
    }

    public function validarCredenciales(Request $request)
    {
        request()->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'user_password' => ['required', 'string', 'max:255', 'min:8'],
        ],
        [
            'user_name.required'=>'Ingrese usuario',
            'user_name.max'=>'Maximo 20 caracteres para el username del usuario',
            'user_password.required'=>'Ingrese contraseña ',
            'user_password.max'=>'Maximo 20 caracteres permitidos',
            'user_password.min'=>'Mínimo 8 caracteres permitidos',

        ]);

        $usuario = $request->user_name;
        $recuerdame = $request->recuerdame;
        $respuesta = [];

        $usuario_existente = User::where('user_name', $usuario)
            ->where('user_state', '1')
            ->first();

        $usuario_inhabilitado = User::where('user_name', $usuario)
            ->where('user_state', '0')
            ->first();

        if(!empty($usuario_existente)){
            $hashp=$usuario_existente->user_password;
            $password=$request->get('user_password');
            if(password_verify($password,$hashp)){
                $respuesta["error"] = false;
                $respuesta["mensaje"] = "Bienvenido al sistema ";
                $respuesta["user_name"] = $usuario_existente;

                auth()->loginUsingId($usuario_existente->user_id, $recuerdame);
            }else{
                $respuesta["error"] = true;
                $respuesta["mensaje"] = "Contraseña no valida";
            }
        }else{
            $respuesta["error"] = true;
            if(!empty($usuario_inhabilitado)){
                $respuesta["mensaje"] = "Usuario inhabilitado";
            }else{
                $respuesta["mensaje"] = "Usuario no existente";
            }

        }
        return \Response::json($respuesta);
    }

    public function cerrarSesion()
    {
        auth()->logout();
        session()->flush();
        return redirect()->route('login.index');
    }
}