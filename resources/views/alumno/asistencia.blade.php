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

        @foreach ($aulas as $aula)
            <div class="row">
                <h1 id="titulo" class="text-center mb-2">Asistencia del Alumno: </h1>
                <h1 class="text-center mb-2" id="nombreAlumno">
                    {{ $aula->alum_primerNombre }}
                    {{ $aula->alum_otrosNombres }} {{ $aula->alum_apellidoPaterno }} {{ $aula->alum_apellidoMaterno }}
                </h1>
            </div>
            <h2 class="text-center mb-2">
                {{ $aula->grado_descripcion }} "{{ $aula->secc_descripcion }}"
            </h2>

            <input type="hidden" value="{{ $aula->alum_id }}" id="alumno_id">
        @endforeach

        <div class="col-md-2">
            <input type="date" class="form-control text-center" id="select-fecha_alum">
        </div>

        <div class="table-responsive mt-4">
            <table class="table" style="width:40%; margin: 0 auto;" id="asistencia">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">Fecha</th>
                        <th class="text-center" scope="col">Asistencia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asistencias as $asistencia)
                        <tr>
                            <td class="text-center">
                                {{ Carbon\Carbon::parse($asistencia->asis_fecha)->format('d M, Y') }}</td>
                            @if ($asistencia->asis_estado == 1)
                                <td class="text-center">Presente</td>
                            @else
                                <td class="text-center">Falta</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <h5 id="paginate">{{ $asistencias->links() }}</h5>
                <a href="{{ route('asistencias.index') }}" id="button" class="btn btn-secondary"
                    style="position: relative; z-index: 100; display: none;">
                    Mostrar</a>
            </div>
        </div>
    </div>

    <div class="text-center xyz" style="margin-left: 97em; margin-top:27em;">
        <button type="button" class="btn btn-warning btn-circle btn-xl mb-4" data-toggle="modal" data-target="#ayuda"><i
                class="fa fa-question"></i> </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ayuda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Guia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <img class="img-responsive avatar-view text-center"
                        src="{{ auth()->user()->user_imagen_ruta }}{{ auth()->user()->user_imagen_nombre }}"
                        alt="Avatar" title="Change the avatar">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"></i>
                        Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/aula_select.js') }}"></script>
@stop
