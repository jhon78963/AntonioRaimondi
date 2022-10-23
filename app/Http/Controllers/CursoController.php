<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;
use DataTables;

class CursoController extends Controller
{
    public function __construct(){
        $this->middleware("can:cursos.index", ['only'=>['index']]);
        $this->middleware("can:cursos.create", ['only'=>['create', 'store']]);
        $this->middleware("can:cursos.edit", ['only'=>['edit', 'actualizar']]);
        $this->middleware("can:cursos.show", ['only'=>['show']]);
        $this->middleware("can:cursos.delete", ['only'=>['destroy', 'eliminar']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $cursos = DB::table('cursos')->get();
            return DataTables::of($cursos)
                ->addColumn('action', function($cursos){
                    $acciones = '<a href="javascript:void(0)" onclick="editCurso('.$cursos->curso_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$cursos->curso_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('curso.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (Curso::all()->count()) {
            $last_curso_id = Curso::all()->last()->curso_id+1;
        } else {
            $last_curso_id = 1;
        }

        DB::table('cursos')->insert([
            'curso_id' => $last_curso_id,
            'curso_nombre' => $request->curso_nombre,
            'curso_estado' => '0'
        ]);

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cursos = DB::table('cursos')->where('curso_id', $id)->get();
        return response()->json($cursos);
    }

    public function actualizar(Request $request)
    {
        DB::table('cursos')->where('curso_id', $request->curso_id)->update([
            'curso_nombre' => $request->curso_nombre,
        ]);

        return back();
    }

    public function eliminar($id)
    {
        DB::table('cursos')->where('curso_id', $id)->delete();
        DB::table('cursos')->where('curso_id', '>', $id)->decrement('curso_id', 1);
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