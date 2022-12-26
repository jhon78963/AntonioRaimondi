@extends('layout.template')

@section('title')
    <title>AR | Asistencia</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
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

                <h1 id="titulo" class="text-center mb-2">Asistencia del Aula </h1>
                <h2 class="text-center mb-2">
                    @foreach ($aulas as $aula)
                        {{ $aula->grado_descripcion }} "{{ $aula->secc_descripcion }}"
                    @endforeach
                </h2>
                <?php $i = 1; ?>
                @if ($nueva_lista_alumnos->count())
                    <form method="POST" action="{{ route('asistencias.store') }}">
                        @csrf
                        <div class="table-responsive">

                            <table class=" table" style="width:40%; margin: 0 auto;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Alumno</th>
                                        <th class="text-center" scope="col">Asistencia</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($nueva_lista_alumnos as $lista_alumno)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}
                                                <input type="text" name="asec_ids[]" value="{{ $lista_alumno->asec_id }}"
                                                    hidden="true">
                                            </td>
                                            <td class="text-center">{{ $lista_alumno->alum_apellidoPaterno }}
                                                {{ $lista_alumno->alum_apellidoMaterno }}
                                                {{ $lista_alumno->alum_primerNombre }}
                                                {{ $lista_alumno->alum_otrosNombres }}
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <select name="asistencias[]" class="form-control">
                                                        <option value="Asistencia ...">Asistencia ...</option>
                                                        <option value="1">Presente</option>
                                                        <option value="0">Falta</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                <button type="submit" class="btn btn-success mt-4" id="boton"> <i
                                        class="fa fa-save"></i>
                                    Guardar</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('asistencias.store') }}">
                        @csrf
                        <div class="table-responsive">

                            <table class=" table" style="width:40%; margin: 0 auto;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Alumno</th>
                                        <th class="text-center" scope="col">Asistencia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista_alumnos as $lista_alumno)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}
                                                <input type="text" name="asec_ids[]"
                                                    value="{{ $lista_alumno->asec_id }}" hidden="true">
                                                <input type="text" name="asis_ids[]"
                                                    value="{{ $lista_alumno->asis_id }}" hidden="true">
                                            </td>
                                            <td class="text-center">{{ $lista_alumno->alum_apellidoPaterno }}
                                                {{ $lista_alumno->alum_apellidoMaterno }}
                                                {{ $lista_alumno->alum_primerNombre }}
                                                {{ $lista_alumno->alum_otrosNombres }}
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <select name="asistencias[]" class="form-control">
                                                        <option value="Asistencia ...">Asistencia ...</option>
                                                        <option value="1"
                                                            {{ '1' == $lista_alumno->asis_estado ? 'selected' : '' }}>
                                                            Presente</option>
                                                        <option value="0"
                                                            {{ '0' == $lista_alumno->asis_estado ? 'selected' : '' }}>
                                                            Falta</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                <button type="submit" class="btn btn-success mt-4" id="boton"> <i
                                        class="fa fa-save"></i>
                                    Actualizar</button>
                            </div>
                        </div>
                    </form>

                @endif

            </div>
        </div>
    </div>
@stop
