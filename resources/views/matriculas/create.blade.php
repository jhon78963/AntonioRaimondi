@extends('layout.template')

@section('title')
    <title>AR | Matricula</title>
@endsection

@section('content')
    <div class="container-fluid">
        <form method="POST" action="{{ route('matriculas.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Alumno</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="form-group">
                                <label for="alum_id">Alumno</label>
                                <select class="form-control select2 select2-hidden-accessible selectpicker"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                                    data-live-search="true" name="alum_id" id="select-alum_id">
                                    <option value="0">Nuevo alumno</option>
                                    @foreach ($alumnos as $alumno)
                                        <option value="{{ $alumno->alum_id }}">
                                            {{ $alumno->alum_primerNombre }}
                                            {{ $alumno->alum_otrosNombres }}
                                            {{ $alumno->alum_apellidoPaterno }} {{ $alumno->alum_apellidoMaterno }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group mb-2">
                                        <label for="nombres">DNI: </label>
                                        <input type="text" name="alum_dni" id="alum_dni" class="form-control"
                                            placeholder="nro dni" required="required">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-2">
                                        <label for="nombres">Sexo: </label>
                                        <select name="alum_sexo" id="alum_sexo" class="form-control" required="required">
                                            <option value="0">Seleccione el sexo</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Masculino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-2">
                                        <label for="nombres">Fecha Nacimiento: </label>
                                        <input type="date" name="alum_fechaNacimiento" id="alum_fechaNacimiento"
                                            class="form-control" placeholder="nro celular" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="nombres">Nombres: </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" name="alum_primerNombre" id="alum_primerNombre"
                                            class="form-control" placeholder="primer nombre" required="required">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="alum_otrosNombres" id="alum_otrosNombres"
                                            class="form-control" placeholder="otros nombres" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="apellidos">Apellidos: </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" name="alum_apellidoPaterno" id="alum_apellidoPaterno"
                                            class="form-control" placeholder="apellido paterno" required="required">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="alum_apellidoMaterno" id="alum_apellidoMaterno"
                                            class="form-control" placeholder="apellido materno" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Dirección: </label>
                                <div class="row">
                                    <div class="col-md-3 col-sm mt-2">
                                        <select name="pais_id" id="pais_id" class="form-control">
                                            <option value="0">Seleccione ...</option>
                                            @foreach ($paises as $pais)
                                                <option value="{{ $pais->pais_id }}">{{ $pais->pais_nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm mt-2">
                                        <select name="depa_id" id="depa_id" class="form-control">
                                            <option value="0">Seleccione ...</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm mt-2">
                                        <select name="prov_id" id="prov_id" class="form-control">
                                            <option value="0">Seleccione ...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm mt-2">
                                        <select name="dist_id" id="dist_id" class="form-control">
                                            <option value="0">Seleccione ...</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="text" name="alum_direccion" id="alum_direccion"
                                    class="form-control mt-2" placeholder="dirección" required="required">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-2">
                                        <label for="nombres">Telefono: </label>
                                        <input type="text" name="alum_telefono" id="alum_telefono"
                                            class="form-control" placeholder="nro telefono" required="required">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-2">
                                        <label for="nombres">Celuar: </label>
                                        <input type="text" name="alum_celular" id="alum_celular" class="form-control"
                                            placeholder="nro celular" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <h2 class="text-center">(*) Alumno nuevo llenar manualmente</h2>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Matricula</h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">

                            <div class="form-group mb-2">
                                <label for="nombres">Año Académico: </label>
                                <input type="text" name="matr_año_ingreso" id="matr_año_ingreso"
                                    class="form-control text-center" placeholder="año academico" value="2022"
                                    required="required" readonly>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Grado y Sección: </label>
                                <div class="row">
                                    <div class="col-md-6 col-sm mt-2">
                                        <select name="grado_id" id="grado_id" class="form-control">
                                            <option value="0">Seleccione ...</option>
                                            @foreach ($grados as $grado)
                                                <option value="{{ $grado->grado_id }}">{{ $grado->grado_descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm mt-2">
                                        <select name="secc_id" id="secc_id" class="form-control">
                                            <option value="0">Seleccione ...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="aula_id" id="aula_id" class="form-control text-center"
                                    required="required" hidden="true" readonly>
                            </div>

                            <div class="form-group">
                                <input type="text" name="alum_id" id="alum_id" class="form-control text-center"
                                    required="required" hidden="true" readonly>
                            </div>

                            <div class="form-group mb-2">
                                <label for="nombres">Vacantes: </label>
                                <input type="text" id="aula_capacidad" class="form-control text-center"
                                    required="required" readonly>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('matriculas.index') }}" class="btn btn-secondary"> Regresar</a>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/alum_direccion.js') }}"></script>
    <script src="{{ asset('js/alum_select.js') }}"></script>
    <script src="{{ asset('js/grado_select.js') }}"></script>
@stop
