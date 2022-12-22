<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class PeriodoAcademicoController extends Controller
{
    public function __construct(){
        $this->middleware("can:periodos.index", ['only'=>['index']]);
        $this->middleware("can:periodos.create", ['only'=>['create', 'store']]);
        $this->middleware("can:periodos.edit", ['only'=>['actualizar']]);
        $this->middleware("can:periodos.show", ['only'=>['show']]);
        $this->middleware("can:periodos.delete", ['only'=>['destroy', 'eliminar']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $periodos = DB::table('periodos_academicos as pa')
            ->join('semestres_academicos as sa', 'pa.peri_id', 'sa.peri_id')
            ->select('pa.peri_id', 'pa.peri_descripcion', DB::raw('COUNT(sa.seme_id) as nrosemestres'))->groupBy('pa.peri_id')->get();
            return DataTables::of($periodos)
                ->addColumn('action', function($periodos){
                    $acciones = '<a href="javascript:void(0)" onclick="editPeriodo('.$periodos->peri_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$periodos->peri_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('periodo.periodo');
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