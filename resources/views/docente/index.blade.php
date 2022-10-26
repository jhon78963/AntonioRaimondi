@extends('layout.template')

@section('title')
    <title>AR | Docente</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Mantenimiento de<b> Docentes</b></h2>
        </div>
        <div class="card-body">
            <div class="container-fluid">

                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                aria-selected="true">
                                Lista de Docentes
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                aria-selected="false">
                                Registrar Docente
                            </button>
                        </li>
                    </ul>
                    <div class="row" id="alertError" style="display: none;">
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <p>Whoops! Ocurrieron algunos errores</p>
                                <ul id="listaErrores">
                                    @error('user_name')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('doce_apellidoPaterno')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('doce_apellidoMaterno')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('doce_primerNombre')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('doce_otrosNombres')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('doce_sexo')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('doce_fechaIngreso')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('doce_direccion')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('doce_telefono')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('doce_celular')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('pais_id')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('depa_id')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('prov_id')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('dist_id')
                                        <li>{{ $message }}</li>
                                    @enderror
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                            <table id="tabla-docente" class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th data-priority="1" class="text-center">DNI</th>
                                        <th data-priority="2" class="text-center">Nombre Completo</th>
                                        <th class="text-center">Dirección</th>
                                        <th class="text-center">Celular</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                            <form id="registro-docente">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">

                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Fecha de Ingreso</label>
                                        <input type="date" class="form-control" id="doce_fechaIngreso"
                                            name="doce_fechaIngreso" placeholder="apellido materno">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">DNI</label>
                                        <input type="number" class="form-control" id="doce_dni" name="user_name"
                                            placeholder="dni">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Sexo</label>
                                        <select id="doce_sexo" name="doce_sexo" class="form-control">
                                            <option value="">Seleccione sexo</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="doce_apellidoPaterno"
                                            name="doce_apellidoPaterno" placeholder="apellido paterno">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Apellido Materno</label>
                                        <input type="text" class="form-control" id="doce_apellidoMaterno"
                                            name="doce_apellidoMaterno" placeholder="apellido materno">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Primer Nombre</label>
                                        <input type="text" class="form-control" id="doce_primerNombre"
                                            name="doce_primerNombre" placeholder="apellido paterno">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Otros Nombres</label>
                                        <input type="text" class="form-control" id="doce_otrosNombres"
                                            name="doce_otrosNombres" placeholder="apellido materno">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Telefono</label>
                                        <input type="number" class="form-control" id="doce_telefono"
                                            name="doce_telefono" placeholder="telefono">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Celular</label>
                                        <input type="number" class="form-control" id="doce_celular" name="doce_celular"
                                            placeholder="celular">
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="form-label" for="update_role_name">Dirección</label>
                                    <div class="mb-3 col-md-3">
                                        <select name="pais_id" id="pais_id" class="form-control">
                                            <option value="">Seleccione País</option>
                                            @foreach ($paises as $pais)
                                                <option value="{{ $pais->pais_id }}">
                                                    {{ $pais->pais_nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <select name="depa_id" id="depa_id" class="form-control">
                                            <option value="">Seleccione Departamento</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <select name="prov_id" id="prov_id" class="form-control">
                                            <option value="">Seleccione Provincia</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <select name="dist_id" id="dist_id" class="form-control">
                                            <option value="">Seleccione Distrito</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <input type="text" class="form-control" id="doce_direccion"
                                            name="doce_direccion" placeholder="dirección">
                                    </div>
                                </div>



                                <button type="submit" class="btn btn-info" id="btn_registrar">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Actualizar -->
                <div class="modal fade" id="docente_edit_modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <form id="docente_edit_form">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Actualizar Docente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="update_doce_id" name="doce_id">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_doce_fechaIngreso">Fecha de
                                                Ingreso</label>
                                            <input type="date" class="form-control" id="update_doce_fechaIngreso"
                                                name="doce_fechaIngreso" placeholder="apellido materno">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_doce_dni">DNI</label>
                                            <input type="number" class="form-control" id="update_doce_dni"
                                                name="doce_dni" placeholder="dni" readonly>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_role_name">Sexo</label>
                                            <select id="update_doce_sexo" name="doce_sexo" class="form-control">
                                                <option value="">Seleccione sexo</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_doce_apellidoPaterno">Apellido
                                                Paterno</label>
                                            <input type="text" class="form-control" id="update_doce_apellidoPaterno"
                                                name="doce_apellidoPaterno" placeholder="apellido paterno">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_doce_apellidoMaterno">Apellido
                                                Materno</label>
                                            <input type="text" class="form-control" id="update_doce_apellidoMaterno"
                                                name="doce_apellidoMaterno" placeholder="apellido materno">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_doce_primerNombre">Primer Nombre</label>
                                            <input type="text" class="form-control" id="update_doce_primerNombre"
                                                name="doce_primerNombre" placeholder="apellido paterno">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_doce_otrosNombres">Otros Nombres</label>
                                            <input type="text" class="form-control" id="update_doce_otrosNombres"
                                                name="doce_otrosNombres" placeholder="apellido materno">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_role_name">Telefono</label>
                                            <input type="number" class="form-control" id="update_doce_telefono"
                                                name="doce_telefono" placeholder="telefono">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_doce_celular">Celular</label>
                                            <input type="number" class="form-control" id="update_doce_celular"
                                                name="doce_celular" placeholder="celular">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="form-label" for="update_doce_direccion">Dirección</label>
                                        <div class="mb-3 col-md-3">
                                            <select name="pais_id" id="update_pais_id" class="form-control">
                                                <option value="">Seleccione País</option>
                                                @foreach ($paises as $pais)
                                                    <option value="{{ $pais->pais_id }}">
                                                        {{ $pais->pais_nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <select name="depa_id" id="update_depa_id" class="form-control">
                                                <option value="">Seleccione Departamento</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <select name="prov_id" id="update_prov_id" class="form-control">
                                                <option value="">Seleccione Provincia</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <select name="dist_id" id="update_dist_id" class="form-control">
                                                <option value="">Seleccione Distrito</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <input type="text" class="form-control" id="update_doce_direccion"
                                                name="doce_direccion" placeholder="dirección">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-info" id="btnActualizar">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Eliminar -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Confirmación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Desea eliminar el registro seleccionado?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-danger" id="btnEliminar"
                                    name="btnEliminar">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--fin container-->
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        #tabla-docente thead th {
            text-align: center;
            color: white;
        }

        #tabla-docente tbody td:eq(0) {
            text-align: left;
        }

        #tabla-docente tbody td {
            text-align: center;
            color: dark;
        }

        #tabla-permisos thead th {
            text-align: center;
            color: white;
        }

        #tabla-permisos tbody td {
            text-align: center;
            color: dark;
        }
    </style>
@endsection
@section('js')
    <script src="{{ asset('js/doce_direccion.js') }}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-docente').DataTable({
                serverSide: true,
                responsive: true,
                "language": {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad",
                        "collection": "Colección",
                        "colvisRestore": "Restaurar visibilidad",
                        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                        "copySuccess": {
                            "1": "Copiada 1 fila al portapapeles",
                            "_": "Copiadas %ds fila al portapapeles"
                        },
                        "copyTitle": "Copiar al portapapeles",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todas las filas",
                            "_": "Mostrar %d filas"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir",
                        "renameState": "Cambiar nombre",
                        "updateState": "Actualizar",
                        "createState": "Crear Estado",
                        "removeAllStates": "Remover Estados",
                        "removeState": "Remover",
                        "savedStates": "Estados Guardados",
                        "stateRestore": "Estado %d"
                    },
                    "autoFill": {
                        "cancel": "Cancelar",
                        "fill": "Rellene todas las celdas con <i>%d<\/i>",
                        "fillHorizontal": "Rellenar celdas horizontalmente",
                        "fillVertical": "Rellenar celdas verticalmentemente"
                    },
                    "decimal": ",",
                    "searchBuilder": {
                        "add": "Añadir condición",
                        "button": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "clearAll": "Borrar todo",
                        "condition": "Condición",
                        "conditions": {
                            "date": {
                                "after": "Despues",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vacío",
                                "equals": "Igual a",
                                "notBetween": "No entre",
                                "notEmpty": "No Vacio",
                                "not": "Diferente de"
                            },
                            "number": {
                                "between": "Entre",
                                "empty": "Vacio",
                                "equals": "Igual a",
                                "gt": "Mayor a",
                                "gte": "Mayor o igual a",
                                "lt": "Menor que",
                                "lte": "Menor o igual que",
                                "notBetween": "No entre",
                                "notEmpty": "No vacío",
                                "not": "Diferente de"
                            },
                            "string": {
                                "contains": "Contiene",
                                "empty": "Vacío",
                                "endsWith": "Termina en",
                                "equals": "Igual a",
                                "notEmpty": "No Vacio",
                                "startsWith": "Empieza con",
                                "not": "Diferente de",
                                "notContains": "No Contiene",
                                "notStarts": "No empieza con",
                                "notEnds": "No termina con"
                            },
                            "array": {
                                "not": "Diferente de",
                                "equals": "Igual",
                                "empty": "Vacío",
                                "contains": "Contiene",
                                "notEmpty": "No Vacío",
                                "without": "Sin"
                            }
                        },
                        "data": "Data",
                        "deleteTitle": "Eliminar regla de filtrado",
                        "leftTitle": "Criterios anulados",
                        "logicAnd": "Y",
                        "logicOr": "O",
                        "rightTitle": "Criterios de sangría",
                        "title": {
                            "0": "Constructor de búsqueda",
                            "_": "Constructor de búsqueda (%d)"
                        },
                        "value": "Valor"
                    },
                    "searchPanes": {
                        "clearMessage": "Borrar todo",
                        "collapse": {
                            "0": "Paneles de búsqueda",
                            "_": "Paneles de búsqueda (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Sin paneles de búsqueda",
                        "loadMessage": "Cargando paneles de búsqueda",
                        "title": "Filtros Activos - %d",
                        "showMessage": "Mostrar Todo",
                        "collapseMessage": "Colapsar Todo"
                    },
                    "select": {
                        "cells": {
                            "1": "1 celda seleccionada",
                            "_": "%d celdas seleccionadas"
                        },
                        "columns": {
                            "1": "1 columna seleccionada",
                            "_": "%d columnas seleccionadas"
                        },
                        "rows": {
                            "1": "1 fila seleccionada",
                            "_": "%d filas seleccionadas"
                        }
                    },
                    "thousands": ".",
                    "datetime": {
                        "previous": "Anterior",
                        "next": "Proximo",
                        "hours": "Horas",
                        "minutes": "Minutos",
                        "seconds": "Segundos",
                        "unknown": "-",
                        "amPm": [
                            "AM",
                            "PM"
                        ],
                        "months": {
                            "0": "Enero",
                            "1": "Febrero",
                            "10": "Noviembre",
                            "11": "Diciembre",
                            "2": "Marzo",
                            "3": "Abril",
                            "4": "Mayo",
                            "5": "Junio",
                            "6": "Julio",
                            "7": "Agosto",
                            "8": "Septiembre",
                            "9": "Octubre"
                        },
                        "weekdays": [
                            "Dom",
                            "Lun",
                            "Mar",
                            "Mie",
                            "Jue",
                            "Vie",
                            "Sab"
                        ]
                    },
                    "editor": {
                        "close": "Cerrar",
                        "create": {
                            "button": "Nuevo",
                            "title": "Crear Nuevo Registro",
                            "submit": "Crear"
                        },
                        "edit": {
                            "button": "Editar",
                            "title": "Editar Registro",
                            "submit": "Actualizar"
                        },
                        "remove": {
                            "button": "Eliminar",
                            "title": "Eliminar Registro",
                            "submit": "Eliminar",
                            "confirm": {
                                "_": "¿Está seguro que desea eliminar %d filas?",
                                "1": "¿Está seguro que desea eliminar 1 fila?"
                            }
                        },
                        "error": {
                            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                        },
                        "multi": {
                            "title": "Múltiples Valores",
                            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                            "restore": "Deshacer Cambios",
                            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                        }
                    },
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "stateRestore": {
                        "creationModal": {
                            "button": "Crear",
                            "name": "Nombre:",
                            "order": "Clasificación",
                            "paging": "Paginación",
                            "search": "Busqueda",
                            "select": "Seleccionar",
                            "columns": {
                                "search": "Búsqueda de Columna",
                                "visible": "Visibilidad de Columna"
                            },
                            "title": "Crear Nuevo Estado",
                            "toggleLabel": "Incluir:"
                        },
                        "emptyError": "El nombre no puede estar vacio",
                        "removeConfirm": "¿Seguro que quiere eliminar este %s?",
                        "removeError": "Error al eliminar el registro",
                        "removeJoiner": "y",
                        "removeSubmit": "Eliminar",
                        "renameButton": "Cambiar Nombre",
                        "renameLabel": "Nuevo nombre para %s",
                        "duplicateError": "Ya existe un Estado con este nombre.",
                        "emptyStates": "No hay Estados guardados",
                        "removeTitle": "Remover Estado",
                        "renameTitle": "Cambiar Nombre Estado"
                    }

                },
                ajax: {
                    url: "{{ route('docentes.index') }}",
                },
                columns: [{
                        data: 'doce_dni'
                    },
                    {
                        data: 'doce_fullName'
                    },
                    {
                        data: 'doce_fullDireccion'
                    },
                    {
                        data: 'doce_celular'
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ]
            });
        });
    </script>


    {{-- CREAR --}}
    <script>
        $('#registro-docente').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('docentes.store') }}",
                type: "POST",
                dataType: 'json',
                data: new FormData($("#registro-docente")[0]),
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btn_registrar').attr("disabled", true);
                    $('#btn_registrar').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registrando...'
                    );
                },
                success: function(response) {
                    if (response) {
                        $('#registro-docente')[0].reset();
                        toastr.success('El alumno se registró correctamente.', 'Nuevo Registro', {
                            timeOut: 3000
                        });
                        $('#tabla-docente').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    if (data.status == 422) {
                        let errores = data.responseJSON.errors;
                        let msjError = '';
                        Object.values(errores).forEach(function(valor) {
                            msjError += '<li>' + valor[0] + '</li>';
                        });
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                        $('#btn_registrar').text('Registrar');
                        $('#btn_registrar').attr("disabled", false);
                        $("#alertError").fadeTo(5000, 500).slideUp(500, function() {
                            $("#alertError").slideUp(500);
                        });
                    } else if (data.status == 403) {
                        let msjError = '<li>No tiene permisos para registrar un docente</li>';
                        msjError +=
                            '<li>Por favor contacte con un administrador para solicitar los permisos necesarios</li>';
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                        $('#btn_registrar').text('Registrar');
                        $('#btn_registrar').attr("disabled", false);
                        $("#alertError").fadeTo(5000, 500).slideUp(500, function() {
                            $("#alertError").slideUp(500);
                        });
                    } else {
                        let msjError = '<li>Hay un problema con la página que esta buscando</li>';
                        msjError +=
                            '<li>Por favor reinicie la página o contacte con un administrador</li>';
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                        $('#btn_registrar').text('Registrar');
                        $('#btn_registrar').attr("disabled", false);
                        $("#alertError").fadeTo(5000, 500).slideUp(500, function() {
                            $("#alertError").slideUp(500);
                        });
                    }
                },
                complete: function() {
                    $('#btn_registrar').text('Registrar');
                    $('#btn_registrar').attr("disabled", false);
                }

            });

        });
    </script>

    {{-- EDITAR --}}
    <script>
        function paisCambioUpdate() {
            var pais_id = $(this).val();

            var html_select_departamento = '<option value="">Seleccione Departamento</option>';
            var html_select_provincia = '<option value="">Seleccione Provincia</option>';
            var html_select_distrito = '<option value="">Seleccione Distrito</option>';

            $('#update_depa_id').html(html_select_departamento);
            $('#update_prov_id').html(html_select_provincia);
            $('#update_dist_id').html(html_select_distrito);

            $.get('/api/pais/' + pais_id + '/departamentos', function(data) {
                var html_select = '<option value="">Seleccione Departamento</option>'
                for (var i = 0; i < data.length; i++)
                    html_select += '<option value="' + data[i].depa_id + '">' + data[i].depa_nombre + '</option>';
                $('#update_depa_id').html(html_select);
            });
        }

        function departamentoCambioUpdate() {
            var departamento_id = $(this).val();

            var html_select_provincia = '<option value="">Seleccione Provincia</option>';
            var html_select_distrito = '<option value="">Seleccione Distrito</option>';

            $('#update_prov_id').html(html_select_provincia);
            $('#update_dist_id').html(html_select_distrito);

            $.get('/api/departamento/' + departamento_id + '/provincias', function(data) {
                var html_select = '<option value="">Seleccione Provincia</option>'
                for (var i = 0; i < data.length; i++)
                    html_select += '<option value="' + data[i].prov_id + '">' + data[i].prov_nombre + '</option>';
                $('#update_prov_id').html(html_select);
            });
        }

        function provinciaCambioUpdate() {
            var provincia_id = $(this).val();

            var html_select_distrito = '<option value="">Seleccione Distrito</option>';

            $('#update_dist_id').html(html_select_distrito);

            $.get('/api/provincia/' + provincia_id + '/distritos', function(data) {
                var html_select = '<option value="">Seleccione Distrito</option>'
                for (var i = 0; i < data.length; i++)
                    html_select += '<option value="' + data[i].dist_id + '">' + data[i].dist_nombre + '</option>';
                $('#update_dist_id').html(html_select);
            });
        }

        function editDocente(doce_id) {
            $.get('docentes/' + doce_id + '/edit', function(docente) {
                $('#update_doce_id').val(docente[0].doce_id);
                $('#update_doce_dni').val(docente[0].doce_dni);
                $('#update_doce_sexo').val(docente[0].doce_sexo);
                $('#update_doce_apellidoPaterno').val(docente[0].doce_apellidoPaterno);
                $('#update_doce_apellidoMaterno').val(docente[0].doce_apellidoMaterno);
                $('#update_doce_primerNombre').val(docente[0].doce_primerNombre);
                $('#update_doce_otrosNombres').val(docente[0].doce_otrosNombres);
                $('#update_doce_fechaIngreso').val(docente[0].doce_fechaIngreso);
                $('#update_doce_direccion').val(docente[0].doce_direccion);
                $('#update_doce_celular').val(docente[0].doce_celular);
                $('#update_doce_telefono').val(docente[0].doce_telefono);
                $('#update_pais_id').val(docente[0].pais_id);

                $.get('/api/pais/' + docente[0].pais_id + '/departamentos', function(data) {
                    var html_select = '<option value="">Seleccione Departamento</option>'
                    for (var i = 0; i < data.length; i++)
                        html_select += '<option value="' + data[i].depa_id + '">' + data[i].depa_nombre +
                        '</option>';
                    $('#update_depa_id').html(html_select);

                    for (var i = 0; i < data.length; i++) {
                        if (data[i].depa_id == docente[0].depa_id) {
                            document.getElementById('update_depa_id').value = data[i].depa_id;
                        }
                    }
                });

                $.get('/api/departamento/' + docente[0].depa_id + '/provincias', function(data) {
                    var html_select = '<option value="">Seleccione Provincia</option>'
                    for (var i = 0; i < data.length; i++)
                        html_select += '<option value="' + data[i].prov_id + '">' + data[i].prov_nombre +
                        '</option>';
                    $('#update_prov_id').html(html_select);

                    for (var i = 0; i < data.length; i++) {
                        if (data[i].prov_id == docente[0].prov_id) {
                            document.getElementById('update_prov_id').value = data[i].prov_id;
                        }
                    }
                });

                $.get('/api/provincia/' + docente[0].prov_id + '/distritos', function(data) {
                    var html_select = '<option value="">Seleccione Distrito</option>'
                    for (var i = 0; i < data.length; i++)
                        html_select += '<option value="' + data[i].dist_id + '">' + data[i].dist_nombre +
                        '</option>';
                    $('#update_dist_id').html(html_select);

                    for (var i = 0; i < data.length; i++) {
                        if (data[i].dist_id == docente[0].dist_id) {
                            document.getElementById('update_dist_id').value = data[i].dist_id;
                        }
                    }
                });

                $(function() {
                    $('#update_pais_id').on('change', paisCambioUpdate);
                    $('#update_depa_id').on('change', departamentoCambioUpdate);
                    $('#update_prov_id').on('change', provinciaCambioUpdate);
                });

                $("input[name=_token]").val();
                $('#docente_edit_modal').modal('toggle');
            })
        }
    </script>

    {{-- ACTUALIZAR --}}
    <script>
        $('#docente_edit_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('docentes.actualizar') }}",
                type: "POST",
                dataType: 'json',
                data: new FormData($("#docente_edit_form")[0]),
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnActualizar').attr("disabled", true);
                    $('#btnActualizar').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando...'
                    );
                },
                success: function(response) {
                    if (response) {
                        $('#docente_edit_modal').modal('hide');
                        toastr.info('El registro fue actualizado correctamente.',
                            'Actualizar Registro', {
                                timeOut: 3000
                            });
                        $('#tabla-docente').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    $('#docente_edit_modal').modal('hide');
                    if (data.status == 403) {
                        let msjError = '<li>No tiene permisos para actualizar un docente</li>';
                        msjError +=
                            '<li>Por favor contacte con un administrador para solicitar los permisos necesarios</li>';
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                        $('#btnActualizar').text('Registrar');
                        $('#btnActualizar').attr("disabled", false);
                        $("#alertError").fadeTo(5000, 500).slideUp(500, function() {
                            $("#alertError").slideUp(500);
                        });
                    } else {
                        let msjError = '<li>Hay un problema con la página que esta buscando</li>';
                        msjError +=
                            '<li>Por favor reinicie la página o contacte con un administrador</li>';
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                        $('#btnActualizar').text('Registrar');
                        $('#btnActualizar').attr("disabled", false);
                        $("#alertError").fadeTo(5000, 500).slideUp(500, function() {
                            $("#alertError").slideUp(500);
                        });
                    }
                },
                complete: function() {
                    $('#btnActualizar').text('Actualizar');
                    $('#btnActualizar').attr("disabled", false);
                }

            })

        });
    </script>

    {{-- ELIMINAR --}}
    <script>
        var doce_id;
        $(document).on('click', '.delete', function() {
            doce_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#btnEliminar').click(function() {
            $.ajax({
                url: "docente/eliminar/" + doce_id,
                beforeSend: function() {
                    $('#btnEliminar').attr("disabled", true);
                    $('#btnEliminar').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Eliminando...'
                    );
                },
                beforeSend: function() {
                    $('#btnEliminar').attr("disabled", true);
                    $('#btnEliminar').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Eliminando...'
                    );
                },
                success: function(data) {
                    $('#confirmModal').modal('hide');
                    toastr.error('El registro fue eliminado correctamente.',
                        'Eliminar Registro', {
                            timeOut: 3000
                        });
                    $('#tabla-docente').DataTable().ajax.reload();
                },
                error: function(data) {
                    $('#confirmModal').modal('hide');
                    if (data.status == 403) {
                        let msjError = '<li>No tiene permisos para eliminar un docente</li>';
                        msjError +=
                            '<li>Por favor contacte con un administrador para solicitar los permisos necesarios</li>';
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                        $('#btn_registrar').text('Registrar');
                        $('#btn_registrar').attr("disabled", false);
                        $("#alertError").fadeTo(5000, 500).slideUp(500, function() {
                            $("#alertError").slideUp(500);
                        });
                    } else {
                        let msjError = '<li>Hay un problema con la página que esta buscando</li>';
                        msjError +=
                            '<li>Por favor reinicie la página o contacte con un administrador</li>';
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                        $('#btn_registrar').text('Registrar');
                        $('#btn_registrar').attr("disabled", false);
                        $("#alertError").fadeTo(5000, 500).slideUp(500, function() {
                            $("#alertError").slideUp(500);
                        });
                    }
                },
                complete: function() {
                    $('#btnEliminar').text('Eliminar');
                    $('#btnEliminar').attr("disabled", false);
                },
            });
        });
    </script>
@endsection
