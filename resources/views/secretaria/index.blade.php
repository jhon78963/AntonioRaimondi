@extends('layout.template')

@section('title')
    <title>AR | Secretaria</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Mantenimiento de<b> Secretarias</b></h2>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                aria-selected="true">
                                Lista de Secretarias
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                aria-selected="false">
                                Registrar Secretaria
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
                                    @error('secre_apellidoPaterno')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('secre_apellidoMaterno')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('secre_primerNombre')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('secre_otrosNombres')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('secre_sexo')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('secre_fechaIngreso')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('secre_direccion')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('secre_telefono')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('secre_celular')
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

                            <table id="tabla-secretaria" class="table table-bordered table-hover">
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
                            <form id="registro-secretaria">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">

                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Fecha de Ingreso</label>
                                        <input type="date" class="form-control" id="secre_fechaIngreso"
                                            name="secre_fechaIngreso" placeholder="apellido materno">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">DNI</label>
                                        <input type="number" class="form-control" id="secre_dni" name="user_name"
                                            placeholder="dni">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Sexo</label>
                                        <select id="secre_sexo" name="secre_sexo" class="form-control">
                                            <option value="">Seleccione sexo</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="secre_apellidoPaterno"
                                            name="secre_apellidoPaterno" placeholder="apellido paterno">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Apellido Materno</label>
                                        <input type="text" class="form-control" id="secre_apellidoMaterno"
                                            name="secre_apellidoMaterno" placeholder="apellido materno">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Primer Nombre</label>
                                        <input type="text" class="form-control" id="secre_primerNombre"
                                            name="secre_primerNombre" placeholder="apellido paterno">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Otros Nombres</label>
                                        <input type="text" class="form-control" id="secre_otrosNombres"
                                            name="secre_otrosNombres" placeholder="apellido materno">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Telefono</label>
                                        <input type="text" class="form-control" id="secre_telefono"
                                            name="secre_telefono" placeholder="telefono">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="update_role_name">Celular</label>
                                        <input type="text" class="form-control" id="secre_celular"
                                            name="secre_celular" placeholder="celular">
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
                                        <input type="text" class="form-control" id="secre_direccion"
                                            name="secre_direccion" placeholder="dirección">
                                    </div>
                                </div>



                                <button type="submit" class="btn btn-info" id="btn_registrar">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Actualizar -->
                <div class="modal fade" id="secretaria_edit_modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <form id="secretaria_edit_form">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Actualizar Secretaria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="update_secre_id" name="secre_id">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_secre_fechaIngreso">Fecha de
                                                Ingreso</label>
                                            <input type="date" class="form-control" id="update_secre_fechaIngreso"
                                                name="secre_fechaIngreso" placeholder="apellido materno">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_secre_dni">DNI</label>
                                            <input type="number" class="form-control" id="update_secre_dni"
                                                name="secre_dni" placeholder="dni" readonly>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_role_name">Sexo</label>
                                            <select id="update_secre_sexo" name="secre_sexo" class="form-control">
                                                <option value="">Seleccione sexo</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_secre_apellidoPaterno">Apellido
                                                Paterno</label>
                                            <input type="text" class="form-control" id="update_secre_apellidoPaterno"
                                                name="secre_apellidoPaterno" placeholder="apellido paterno">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_secre_apellidoMaterno">Apellido
                                                Materno</label>
                                            <input type="text" class="form-control" id="update_secre_apellidoMaterno"
                                                name="secre_apellidoMaterno" placeholder="apellido materno">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_secre_primerNombre">Primer
                                                Nombre</label>
                                            <input type="text" class="form-control" id="update_secre_primerNombre"
                                                name="secre_primerNombre" placeholder="apellido paterno">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_secre_otrosNombres">Otros
                                                Nombres</label>
                                            <input type="text" class="form-control" id="update_secre_otrosNombres"
                                                name="secre_otrosNombres" placeholder="apellido materno">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_role_name">Telefono</label>
                                            <input type="text" class="form-control" id="update_secre_telefono"
                                                name="secre_telefono" placeholder="telefono">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="update_secre_celular">Celular</label>
                                            <input type="text" class="form-control" id="update_secre_celular"
                                                name="secre_celular" placeholder="celular">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="form-label" for="update_secre_direccion">Dirección</label>
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
                                            <input type="text" class="form-control" id="update_secre_direccion"
                                                name="secre_direccion" placeholder="dirección">
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
                        <form id="rol_delete_form">
                            @csrf
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
                        </form>
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
        #tabla-secretaria thead th {
            text-align: center;
            color: white;
        }

        #tabla-secretaria tbody td:eq(0) {
            text-align: left;
        }

        #tabla-secretaria tbody td {
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
    <script src="{{ asset('js/secre_direccion.js') }}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-secretaria').DataTable({
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
                    url: "{{ route('secretarias.index') }}",
                },
                columns: [{
                        data: 'secre_dni'
                    },
                    {
                        data: 'secre_fullName'
                    },
                    {
                        data: 'secre_fullDireccion'
                    },
                    {
                        data: 'secre_celular'
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
        $('#registro-secretaria').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('secretarias.store') }}",
                type: "POST",
                dataType: 'json',
                data: new FormData($("#registro-secretaria")[0]),
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
                        $('#registro-secretaria')[0].reset();
                        toastr.success('Los datos se registraron correctamente.', 'Nuevo Registro', {
                            timeOut: 3000
                        });
                        $('#tabla-secretaria').DataTable().ajax.reload();
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
                        let msjError = '<li>No tiene permisos para registrar una secretaria</li>';
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

        function editSecretaria(secre_id) {
            $.get('secretarias/' + secre_id + '/edit', function(secretaria) {
                $('#update_secre_id').val(secretaria[0].secre_id);
                $('#update_secre_dni').val(secretaria[0].secre_dni);
                $('#update_secre_sexo').val(secretaria[0].secre_sexo);
                $('#update_secre_apellidoPaterno').val(secretaria[0].secre_apellidoPaterno);
                $('#update_secre_apellidoMaterno').val(secretaria[0].secre_apellidoMaterno);
                $('#update_secre_primerNombre').val(secretaria[0].secre_primerNombre);
                $('#update_secre_otrosNombres').val(secretaria[0].secre_otrosNombres);
                $('#update_secre_fechaIngreso').val(secretaria[0].secre_fechaIngreso);
                $('#update_secre_direccion').val(secretaria[0].secre_direccion);
                $('#update_secre_celular').val(secretaria[0].secre_celular);
                $('#update_secre_telefono').val(secretaria[0].secre_telefono);
                $('#update_pais_id').val(secretaria[0].pais_id);

                $.get('/api/pais/' + secretaria[0].pais_id + '/departamentos', function(data) {
                    var html_select = '<option value="">Seleccione Departamento</option>'
                    for (var i = 0; i < data.length; i++)
                        html_select += '<option value="' + data[i].depa_id + '">' + data[i].depa_nombre +
                        '</option>';
                    $('#update_depa_id').html(html_select);

                    for (var i = 0; i < data.length; i++) {
                        if (data[i].depa_id == secretaria[0].depa_id) {
                            document.getElementById('update_depa_id').value = data[i].depa_id;
                        }
                    }
                });

                $.get('/api/departamento/' + secretaria[0].depa_id + '/provincias', function(data) {
                    var html_select = '<option value="">Seleccione Provincia</option>'
                    for (var i = 0; i < data.length; i++)
                        html_select += '<option value="' + data[i].prov_id + '">' + data[i].prov_nombre +
                        '</option>';
                    $('#update_prov_id').html(html_select);

                    for (var i = 0; i < data.length; i++) {
                        if (data[i].prov_id == secretaria[0].prov_id) {
                            document.getElementById('update_prov_id').value = data[i].prov_id;
                        }
                    }
                });

                $.get('/api/provincia/' + secretaria[0].prov_id + '/distritos', function(data) {
                    var html_select = '<option value="">Seleccione Distrito</option>'
                    for (var i = 0; i < data.length; i++)
                        html_select += '<option value="' + data[i].dist_id + '">' + data[i].dist_nombre +
                        '</option>';
                    $('#update_dist_id').html(html_select);

                    for (var i = 0; i < data.length; i++) {
                        if (data[i].dist_id == secretaria[0].dist_id) {
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
                $('#secretaria_edit_modal').modal('toggle');
            })
        }
    </script>

    {{-- ACTUALIZAR --}}
    <script>
        $('#secretaria_edit_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('secretarias.actualizar') }}",
                type: "POST",
                dataType: 'json',
                data: new FormData($("#secretaria_edit_form")[0]),
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
                        $('#secretaria_edit_modal').modal('hide');
                        toastr.info('El registro fue actualizado correctamente.',
                            'Actualizar Registro', {
                                timeOut: 3000
                            });
                        $('#tabla-secretaria').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    $('#secretaria_edit_modal').modal('hide');
                    if (data.status == 403) {
                        let msjError = '<li>No tiene permisos para actualizar una secretaria</li>';
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
        var secre_id;
        $(document).on('click', '.delete', function() {
            secre_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#btnEliminar').click(function() {
            $.ajax({
                url: "secretaria/eliminar/" + secre_id,
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
                    $('#tabla-secretaria').DataTable().ajax.reload();
                },
                error: function(data) {
                    $('#confirmModal').modal('hide');
                    if (data.status == 403) {
                        let msjError = '<li>No tiene permisos para eliminar una secretaria</li>';
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
