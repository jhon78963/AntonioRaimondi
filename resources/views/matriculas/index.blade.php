@extends('layout.template')

@section('title')
    <title>AR | Matricula</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-10"></div>
        <div class="col-2"><input type="text" class="form-control text-center" name="primera_fecha"
                value="{{ $hoy }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <!-- Button trigger modal crear -->

                <div class="row mt-4">
                    <div class="col-6">
                        <a href="{{ route('matriculas.create') }}"
                            class="btn btn-primary btn-a-circle btn-a-xl mb-4">Registrar</a>
                    </div>
                    <div class="col-6">
                        <form class="form-group">
                            <div class="row">
                                <div class="col-10">
                                    <input name="buscarpor" class="form-control" type="search"
                                        placeholder="Buscar por alumno" value="{{ $buscarpor }}">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-success" type="submit">Buscar</button>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>

                @if (session('datos'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('datos') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Alumno</th>
                                <th class="text-center" scope="col">Grado</th>
                                <th class="text-center" scope="col">Sección</th>
                                <th class="text-center" scope="col">Estado</th>
                                <th class="text-center" scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($matriculas->count())
                                @foreach ($matriculas as $matricula)
                                    <tr>
                                        <td class="text-center">{{ $matricula->matr_id }}</td>
                                        <td class="text-center">{{ $matricula->alumnos->alum_primerNombre }}
                                            {{ $matricula->alumnos->alum_otrosNombres }}
                                            {{ $matricula->alumnos->alum_apellidoPaterno }}
                                            {{ $matricula->alumnos->alum_apellidoMaterno }}</td>
                                        <td class="text-center">{{ $matricula->aulas->grados->grado_descripcion }}</td>
                                        <td class="text-center">{{ $matricula->aulas->secciones->secc_descripcion }}
                                        </td>
                                        <td class="text-center">
                                            @if ($matricula->matr_estado == 0)
                                                Anulada
                                            @else
                                                Activa
                                            @endif

                                        </td>
                                        <td>
                                            <div class="text-center">
                                                @if ($matricula->matr_estado != 0)
                                                    <!-- Button trigger modal ver -->
                                                    <button type="button" class="btn btn-secondary btn-circle btn-md"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#vermatricula{{ $matricula->matr_id }}">
                                                        Ver
                                                    </button>


                                                    <!-- Button trigger modal cambiar aula -->
                                                    <button type="button" class="btn btn-info btn-circle btn-md"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#cambiaraula{{ $matricula->matr_id }}">
                                                        Editar
                                                    </button>

                                                    <!-- Button trigger modal anular -->
                                                    <button type="button" class="btn btn-danger btn-circle btn-md"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#anularmatricula{{ $matricula->matr_id }}">
                                                        Anular
                                                    </button>

                                                    <!-- Button descarga-->
                                                    <a href="{{ route('matriculas.pdf', [$matricula->matr_id, $hoy]) }}"
                                                        class="btn btn-dark btn-circle btn-md" target=”_blank”>Descargar
                                                    </a>
                                                @else
                                                    <!-- Button trigger modal ver -->
                                                    <button type="button" class="btn btn-secondary btn-circle btn-md"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#vermatricula{{ $matricula->matr_id }}">
                                                        Ver
                                                    </button>
                                                @endif
                                            </div>

                                            <!-- Modal Ver -->

                                            <div class="modal fade" id="vermatricula{{ $matricula->matr_id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ver
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('matriculas.update', $matricula->matr_id) }}">
                                                                @method('put')
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                        </div>
                                                                        <div class="col-4">
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <div class="form-group mb-2">
                                                                                <label for="nombres">Fecha
                                                                                    Registro</label>
                                                                                <input type="text"
                                                                                    class="form-control text-center"
                                                                                    value="{{ $matricula->matr_fecha }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mb-2">
                                                                        <label for="nombres">Año Académico </label>
                                                                        <input type="text" name="matr_año_ingreso"
                                                                            id="matr_año_ingreso"
                                                                            class="form-control text-center"
                                                                            value="{{ $matricula->matr_año_ingreso }}"
                                                                            readonly>
                                                                    </div>



                                                                    <div class="form-group mb-2">
                                                                        <label for="nombres">Alumno </label>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <input type="text"
                                                                                    name="alum_primerNombre"
                                                                                    class="form-control text-center"
                                                                                    value="{{ $matricula->alumnos->alum_primerNombre }} {{ $matricula->alumnos->alum_otrosNombres }} {{ $matricula->alumnos->alum_apellidoPaterno }} {{ $matricula->alumnos->alum_apellidoMaterno }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="nombres">Grado y Sección: </label>
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-sm mt-2">
                                                                                <input type="text" name="grado_id"
                                                                                    id="grado_id"
                                                                                    class="form-control text-center"
                                                                                    value="{{ $matricula->aulas->grados->grado_descripcion }}"
                                                                                    readonly>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm mt-2">
                                                                                <input type="text" name="grado_id"
                                                                                    id="grado_id"
                                                                                    class="form-control text-center"
                                                                                    value="{{ $matricula->aulas->secciones->secc_descripcion }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Editar -->
                                            <div class="modal fade" id="cambiaraula{{ $matricula->matr_id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form method="POST"
                                                            action="{{ route('matriculas.update', $matricula->matr_id) }}">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                    Cambiar Aula</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <div class="col-4">
                                                                    </div>
                                                                    <div class="col-4">
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group mb-2">
                                                                            <label for="nombres">Fecha Registro</label>
                                                                            <input type="text"
                                                                                class="form-control text-center"
                                                                                value="{{ $matricula->matr_fecha }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group mb-2">
                                                                    <label for="nombres">Codigo: </label>
                                                                    <input type="text" name="alum_id"
                                                                        class="form-control text-center"
                                                                        value="{{ $matricula->matr_id }}" readonly>
                                                                </div>

                                                                <div class="form-group mb-2">
                                                                    <label for="nombres">Año Académico </label>
                                                                    <input type="text" name="matr_año_ingreso"
                                                                        id="matr_año_ingreso"
                                                                        class="form-control text-center"
                                                                        value="{{ $matricula->matr_año_ingreso }}"
                                                                        readonly>
                                                                </div>



                                                                <div class="form-group mb-2">
                                                                    <label for="nombres">Alumno </label>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <input type="text" name="alum_primerNombre"
                                                                                class="form-control text-center"
                                                                                value="{{ $matricula->alumnos->alum_primerNombre }} {{ $matricula->alumnos->alum_otrosNombres }} {{ $matricula->alumnos->alum_apellidoPaterno }} {{ $matricula->alumnos->alum_apellidoMaterno }}"
                                                                                readonly>
                                                                            <input type="text" name="alum_id"
                                                                                id="alum_id"
                                                                                value="{{ $matricula->alumnos->alum_id }}"
                                                                                readonly hidden="true">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="nombres">Grado y Sección: </label>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-sm mt-2">
                                                                            <input type="text" name="grado_id"
                                                                                id="grado_id"
                                                                                class="form-control text-center"
                                                                                value="{{ $matricula->aulas->grados->grado_descripcion }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm mt-2">
                                                                            <select name="secc_id" id="secc_id"
                                                                                class="form-control">
                                                                                <option value="0">Seleccione ...
                                                                                </option>
                                                                                @foreach ($aulas as $aula)
                                                                                    @if ($aula->grado_id == $matricula->aulas->grados->grado_id)
                                                                                        <option
                                                                                            value="{{ $aula->secc_id }}"
                                                                                            {{ $aula->secc_id == $matricula->aulas->secciones->secc_id ? 'selected' : '' }}>
                                                                                            {{ $aula->secciones->secc_descripcion }}
                                                                                        </option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="text" name="aula_id" id="aula_id"
                                                                        class="form-control text-center"
                                                                        required="required" hidden="true" readonly
                                                                        value="{{ $matricula->aula_id }}">
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Guardar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal anular -->
                                            <div class="modal fade" id="anularmatricula{{ $matricula->matr_id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('matriculas.destroy', $matricula->matr_id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Anular
                                                                    Matricula</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h2>¿Estas seguro de anular esta matricula del alumno:
                                                                    {{ $matricula->alumnos->alum_primerNombre }}
                                                                    {{ $matricula->alumnos->alum_apellidoPaterno }}?</h2>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cerrar</button>

                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <input type="submit" value="Eliminar"
                                                                    class="btn btn-danger">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No hay datos</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <h5>{{ $matriculas->links() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
