<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;
use App\Models\Grado;
use App\Models\Seccion;
use Illuminate\Support\Facades\DB;
use DataTables;

class AulaController extends Controller
{
    public function __construct(){
        $this->middleware("can:aulas.index", ['only'=>['index']]);
        $this->middleware("can:aulas.create", ['only'=>['create', 'store']]);
        $this->middleware("can:aulas.edit", ['only'=>['actualizar']]);
        $this->middleware("can:aulas.show", ['only'=>['show']]);
        $this->middleware("can:aulas.delete", ['only'=>['destroy', 'eliminar']]);
        $this->middleware("can:aulas.grado", ['only'=>['grado']]);
        $this->middleware("can:aulas.seccion", ['only'=>['seccion']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $aulas = DB::table('aulas as a')
            ->join('grados as g', 'a.grado_id', 'g.grado_id')
            ->join('secciones as s', 'a.secc_id', 's.secc_id')
            ->select('a.aula_id', 'a.aula_capacidad', 'g.grado_id', 's.secc_id', DB::raw("CONCAT(g.grado_descripcion, ' ', s.secc_descripcion) AS aula_descripcion"))
            ->get();
            return DataTables::of($aulas)
                ->addColumn('action', function($aulas){
                    $acciones = '<a href="javascript:void(0)" onclick="editAula('.$aulas->aula_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$aulas->aula_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $grados = Grado::all();
        $secciones = Seccion::where('aula_estado', '0');

        return view('aula.index', compact('grados', 'secciones'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        request()->validate([
            'grado_id' => ['required'],
            'secc_id' => ['required'],
            'aula_capacidad' => ['required', 'integer'],
        ],
        [
            'grado_id.required'=>'Seleccione grado',
            'secc_id.required'=>'Seleccione sección',
            'aula_capacidad.required'=>'Ingrese la capacidad del aula',
            'aula_capacidad.integer'=>'La capacidad del aula ingresada solo debe contener números enteros',
        ]);

        if (Aula::all()->count()) {
            $last_aula_id = Aula::all()->last()->aula_id+1;
        } else {
            $last_aula_id = 1;
        }

        DB::table('cursos')->insert([
            'aula_id' => $last_aula_id,
            'grado_id' => $request->grado_id,
            'secc_id' => $request->secc_id,
            'aula_nombre' => $request->aula_capacidad,
            'aula_estado' => '0'
        ]);

        return back();
    }

    public function grado(Request $request)
    {
        request()->validate([
            'grado_descripcion' => ['required', 'max:25'],
        ],
        [
            'grado_descripcion.required'=>'Ingrese el grado',
            'grado_descripcion.max'=>'Maximo 25 caracteres permitidos para el campo Grado',
        ]);

        if (Grado::all()->count()) {
            $last_grado_id = Grado::all()->last()->grado_id+1;
        } else {
            $last_grado_id = 1;
        }

        DB::table('grados')->insert([
            'grado_id' => $last_grado_id,
            'grado_descripcion' => $request->grado_descripcion,
        ]);

        return back();
    }

    public function seccion(Request $request)
    {
        request()->validate([
            'secc_descripcion' => ['required', 'max:1'],
        ],
        [
            'secc_descripcion.required'=>'Ingrese la seccion',
            'secc_descripcion.max'=>'Maximo 1 caracteres permitidos para el campo Sección',
        ]);

        if (Seccion::all()->count()) {
            $last_secc_id = Seccion::all()->last()->secc_id+1;
        } else {
            $last_secc_id = 1;
        }

        DB::table('secciones')->insert([
            'secc_id' => $last_secc_id,
            'secc_descripcion' => $request->secc_descripcion,
        ]);

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $aulas = DB::table('aulas')->where('aula_id', $id)->get();
        return response()->json($aulas);
    }

    public function actualizar(Request $request)
    {
        DB::table('aulas')->where('aula_id', $request->aula_id)->update([
            'grado_id' => $request->grado_id,
            'secc_id' => $request->secc_id,
            'aula_nombre' => $request->aula_capacidad,
        ]);

        return back();
    }

    public function eliminar($id)
    {
        DB::table('aulas')->where('aula_id', $id)->delete();
        DB::table('aulas')->where('aula_id', '>', $id)->decrement('aula_id', 1);
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