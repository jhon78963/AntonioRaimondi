@extends('layout.template')

@section('title')
    <title>AR | Asistencia</title>
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{ session('datos') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-2 text-center" style="width:40%; margin: 0 auto; float: right;">
            <input type="text" class="form-control input-sm text-center" id="periodo_fecha" name="periodo_fecha"
                value="{{ Carbon\Carbon::parse($hoy)->format('d M, Y') }}" readonly>
        </div>

        <h1 id="titulo" class="text-center mb-4">Asistencias </h1>
        <div class="text-center justify-content-center mb-3">
            <div class="row">
                <div class="col-3">
                    <select name="aula_id" id="select-aula_id_admin" class="form-control col-2 mr-2 text-center">
                        <option value="0">Seleccione aula ...</option>
                        @foreach ($aulas as $aula)
                            <option value="{{ $aula->aula_id }}">{{ $aula->grado_descripcion }}
                                "{{ $aula->secc_descripcion }}"
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control col-6 text-center" placeholder="Nombre del Docente"
                        id="nombre_docente"><br>
                    <input type="hidden" class="form-control col-6 text-center" id="docente_id">
                </div>

            </div>
        </div>
        <div class="text-center ">
            <div class="col-2">
                <input type="date" class="form-control text-center" id="select-fecha">
            </div>
        </div>

        <div class="table-responsive mt-4">
            <table class="table" style="width:50%; margin: 0 auto;" id="asistencia">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Alumno</th>
                        <th class="text-center" scope="col">Asistencia</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('js/aula_select.js') }}"></script>
@stop
