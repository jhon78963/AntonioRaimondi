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
        //
    }

    public function destroy($id)
    {
        //
    }
}