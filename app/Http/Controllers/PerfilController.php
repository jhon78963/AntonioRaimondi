<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function __construct(){
        $this->middleware("can:users.profile", ['only'=>['index', 'update']]);
    }

    public function index()
    {
        $usuario = UserProfile::find(auth()->user()->user_id);
        return view('usuario.perfil')->with(compact('usuario'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        if($request->user_name!=null){
            $usuario->user_name = $request->user_name;
            $usuario->save();
        }

        $usuario_perfil = UserProfile::findOrFail($id);
        $usuario_perfil->upro_email = $request->upro_email;
        $usuario_perfil->upro_firstName = $request->upro_firstName;
        $usuario_perfil->upro_lastName = $request->upro_lastName;
        $usuario_perfil->upro_address = $request->upro_address;
        $usuario_perfil->upro_city = $request->upro_city;
        $usuario_perfil->upro_country = $request->upro_country;
        $usuario_perfil->upro_postalCode = $request->upro_postalCode;
        $usuario_perfil->upro_phoneNumber = $request->upro_phoneNumber;
        $usuario_perfil->save();


        $respuesta = [];
        $respuesta["error"] = false;
        $respuesta["mensaje"] = "Perfil de Usuario actualizado con exito!!!.";

        if ($request->hasFile('upro_image'))
        {
            $user = UserProfile::findOrFail($id);
            $file = $request->file('upro_image');
            $destinationPath = 'img/fotoperfil/';
            $filename = time(). '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('upro_image')->move($destinationPath, $filename);
            $user->upro_image = '/'.$destinationPath.$filename;
            $user->save();
            $respuesta["photo"] = $user->upro_image;
        }

        return \Response::json($respuesta);
    }

    public function destroy($id)
    {
        //
    }
}