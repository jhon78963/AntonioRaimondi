@extends('layout.template')

@section('title')
    <title>AR | Permiso</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Mantenimiento de<b> Permisos</b></h2>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                aria-selected="true">
                                Lista de Permisos
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                aria-selected="false">
                                Nuevo Permiso
                            </button>
                        </li>
                    </ul>
                    <div class="row" id="alertError" style="display: none;">
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <p>Whoops! Ocurrieron algunos errores</p>
                                <ul id="listaErrores">
                                    @error('curso_nombre')
                                        <li>{{ $message }}</li>
                                    @enderror
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">

                            <table id="tabla-permiso" class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th data-priority="2" class="text-center">ID</th>
                                        <th class="text-center">Permiso</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                            <form id="registro-permiso">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="create_perm_name">Permiso</label>
                                    <input type="text" class="form-control" id="create_perm_name" name="perm_name"
                                        placeholder="permiso" />
                                </div>

                                <div class="mb-3">
                                    <label for="roles" class="form-label">Asignar Rol</label>


                                    <table id="tabla-roles" class="table table-bordered table-hover" style="width: 40%;">
                                        <thead class="table-dark">
                                            <th scope="col" width="1%">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="all_role">
                                                </div>
                                            </th>
                                            <th scope="col" width="20%">Permiso</th>
                                        </thead>

                                        @foreach ($roles as $rol)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="role[]" value="{{ $rol->id }}"
                                                            class='form-check-input role'>
                                                    </div>
                                                </td>
                                                <td>{{ $rol->name }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>


                                <button type="submit" class="btn btn-info" id="btn_registrar">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Actualizar -->
                <div class="modal fade" id="permiso_edit_modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="permiso_edit_form">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Actualizar Permiso</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="update_perm_id" name="perm_id">
                                    <div class="mb-3">
                                        <label class="form-label" for="update_perm_name">Permiso</label>
                                        <input type="text" class="form-control" id="update_perm_name"
                                            name="perm_name" placeholder="Permiso" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="roles" class="form-label">Asignar Roles</label>
                                        <table id="tabla-roles" class="table table-bordered table-hover"
                                            style="width: 100%;">
                                            <thead class="table-dark">
                                                <th scope="col" width="1%">

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="all_role_edit">
                                                    </div>
                                                </th>
                                                <th scope="col" width="20%">Permiso</th>
                                            </thead>

                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="role_edit[]"
                                                                id="role_edit{{ $role->id }}"
                                                                value="{{ $role->id }}"
                                                                class='form-check-input role_edit'>
                                                        </div>
                                                    </td>
                                                    <td>{{ $role->name }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
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
        #tabla-permiso thead th {
            text-align: center;
            color: white;
        }

        #tabla-permiso tbody td:eq(0) {
            text-align: left;
        }

        #tabla-permiso tbody td {
            text-align: center;
            color: dark;
        }
    </style>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-permiso').DataTable({
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
                    url: "{{ route('permissions.index') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
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
        $('#registro-permiso').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('permissions.store') }}",
                type: "POST",
                dataType: 'json',
                data: new FormData($("#registro-permiso")[0]),
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
                        $('#registro-permiso')[0].reset();
                        toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {
                            timeOut: 3000
                        });
                        $('#tabla-permiso').DataTable().ajax.reload();
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
                        let msjError = '<li>No tiene permisos para registrar un permiso</li>';
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
                    $('#btn_registrar').text('REGISTRAR');
                    $('#btn_registrar').attr("disabled", false);
                }

            });
        });
    </script>

    {{-- EDITAR --}}
    <script>
        function editPermission(perm_id) {
            $.get('permissions/' + perm_id + '/edit', function(permission) {
                $('#permiso_edit_form')[0].reset();
                $('#update_perm_id').val(permission[0].id);
                $('#update_perm_name').val(permission[0].name);
                $.get('/api/permission/' + permission[0].id + '/role', function(data) {
                    for (var i = 0; i < data.length; i++) {
                        role_id = $('#role_edit' + data[i].role_id + '').val();
                        if (data[i].role_id == role_id) {
                            $('#role_edit' + data[i].role_id + '').prop('checked', true);
                        } else {
                            $('#role_edit' + data[i].role_id + '').prop('checked', false);
                        }
                    }
                });
                $("input[name=_token]").val();
                $('#permiso_edit_modal').modal('toggle');
            })
        }
    </script>

    {{-- ACTUALIZAR --}}
    <script>
        $('#permiso_edit_form').submit(function(e) {

            e.preventDefault();

            $.ajax({
                url: "{{ route('permission.actualizar') }}",
                type: "POST",
                dataType: 'json',
                data: new FormData($("#permiso_edit_form")[0]),
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
                        $('#permiso_edit_modal').modal('hide');
                        toastr.info('El registro fue actualizado correctamente.',
                            'Actualizar Registro', {
                                timeOut: 3000
                            });
                        $('#tabla-permiso').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    $('#permiso_edit_modal').modal('hide');
                    if (data.status == 403) {
                        let msjError = '<li>No tiene permisos para actualizar un permiso</li>';
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
        var perm_id;
        $(document).on('click', '.delete', function() {
            perm_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#btnEliminar').click(function() {
            $.ajax({
                url: "permission/eliminar/" + perm_id,
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
                    $('#tabla-permiso').DataTable().ajax.reload();
                },
                error: function(data) {
                    $('#confirmModal').modal('hide');
                    if (data.status == 403) {
                        let msjError = '<li>No tiene permisos para eliminar un permiso</li>';
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_role"]').on('click', function() {

                if ($(this).is(':checked')) {
                    $.each($('.role'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.role'), function() {
                        $(this).prop('checked', false);
                    });
                }

            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_role_edit"]').on('click', function() {

                if ($(this).is(':checked')) {
                    $.each($('.role_edit'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.role_edit'), function() {
                        $(this).prop('checked', false);
                    });
                }

            });
        });
    </script>
@endsection
