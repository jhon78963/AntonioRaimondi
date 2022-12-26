@extends('layout.template')

@section('title')
    <title>AR | Notas</title>
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

        <h1 id="titulo" class="text-center mb-2">Notas del Aula </h1>
        <div class="text-center justify-content-center mb-3">
            <div class="row" id="centrar">
                <select name="aula_id" id="select-aula_id" class="form-control col-2 mr-2 text-center">
                    <option value="0">Seleccione ...</option>
                    @foreach ($aulas as $aula)
                        <option value="{{ $aula->aula_id }}">{{ $aula->grado_descripcion }}
                            "{{ $aula->secc_descripcion }}"
                        </option>
                    @endforeach
                </select>
                <input type="text" class="form-control col-6 text-center" id="nombre_docente"><br>
            </div>
        </div>
        <input type="hidden" class="form-control" id="doce_id">


        <?php $i = 1; ?>
        <form method="POST" action="{{ route('notas.store') }}">
            @csrf
            <div class="text-center justify-content-center mb-3">
                <div class="col-12">
                    <select name="curso_id" id="select-curso_id" class="form-control mx-auto text-center"
                        style="width: 300px;">
                        <option value="0">Seleccione ...</option>
                    </select>
                </div>
                <input type="hidden" class="form-control" name="nrobimestre" id="nrobimestre">
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="card card-primary" style="width:100%; height: 500px;">
                        <div class="card-header">
                            <h3 class="card-title">Notas</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="text-center justify-content-center mb-3">
                                <div class="col-12">
                                    <select name="bimestre" id="select-bimestre" class="form-control mx-auto text-center"
                                        style="width: 250px;" data-default="0">
                                        <option value="0">Seleccione Bimestre</option>
                                        <option value="1">1er Bimestre</option>
                                        <option value="2">2do Bimestre</option>
                                        <option value="3">3er Bimestre</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class=" table" style="width:100%; margin: 0 auto;" id="notas">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center" scope="col" width="50px">#</th>
                                            <th class="text-center" scope="col" width="700px">Alumno</th>
                                            <th class="text-center" scope="col" width="100px">1ra Sem</th>
                                            <th class="text-center" scope="col" width="100px">2da Sem</th>
                                            <th class="text-center" scope="col" width="100px">3ra Sem</th>
                                            <th class="text-center" scope="col" width="100px">4ta Sem</th>
                                            <th class="text-center" scope="col" width="100px">5ta Sema</th>
                                            <th class="text-center" scope="col" width="100px">6ta Sem</th>
                                            <th class="text-center" scope="col" width="100px">7ma Sem</th>
                                            <th class="text-center" scope="col" width="100px">8va Sem</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-notas">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-success"
                                style="position: relative; z-index: 100">Guardar</button>
                        </div>
                    </div>
                </div>


                <div class="col-md-5">
                    <div class="card card-success" style="width:100%; height: 500px;">
                        <div class="card-header">
                            <h3 class="card-title">Promedio Final</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class=" table" style="width:100%; margin: 0 auto;" id="promedio">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center" scope="col" width="50px">#</th>
                                            <th class="text-center" scope="col" width="700px">Alumno</th>
                                            <th class="text-center" scope="col" width="100px">1er Bim</th>
                                            <th class="text-center" scope="col" width="100px">2do Bim</th>
                                            <th class="text-center" scope="col" width="100px">3ro Bim</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-promedio">

                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/curs_select.js') }}"></script>
    <script src="{{ asset('js/bime_select.js') }}"></script>
    <script src="{{ asset('js/aula_select.js') }}"></script>
@stop
