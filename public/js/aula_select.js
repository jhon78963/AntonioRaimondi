$(function(){
    $('#select-aula_id').on('change', aulaCambio);
    $('#select-aula_id_admin').on('change', aulaChange);
    $('#select-fecha').on('change', fechaCambio);
    $('#select-fecha_alum').on('change', fechaChange);

});

function aulaCambio(){
    var aula_id = $(this).val();

    var doce_id;

    $.get('/api/aula/'+aula_id+'/docente', function (data) {

        $('#nombre_docente').val(data[0].doce_apellidoPaterno + " " + data[0].doce_apellidoMaterno + " " + data[0].doce_primerNombre + " " + data[0].doce_otrosNombres);
        $('#doce_id').val(data[0].doce_id);
        doce_id = document.getElementById('doce_id').value;

        $.get('/api/docente/'+doce_id+'/curso', function(data){
            var html_select = '<option value="">Seleccione Curso</option>'
            for(var i=0;i<data.length;i++)
                html_select += '<option value="'+data[i].curso_id+"_"+data[i].doce_id+'">'+data[i].curso_nombre+'</option>';
            $('#select-curso_id').html(html_select);

        });

    });

}

function aulaChange(){
    var aula_id = $(this).val();

    fechaCambio();

    $.get('/api/aula/'+aula_id+'/docente', function (data) {

        $('#nombre_docente').val(data[0].doce_apellidoPaterno + " " + data[0].doce_apellidoMaterno + " " + data[0].doce_primerNombre + " " + data[0].doce_otrosNombres);
        $('#docente_id').val(data[0].doce_id);
        $("#asistencia tbody").children().remove();
        document.getElementById("select-fecha").valueAsDate = null;
    });

}

function fechaCambio() {
    var fecha = document.getElementById("select-fecha").value;
    var doce_id = document.getElementById("docente_id").value;
    var asistencia;

    $.get("/api/aula/asistencia/" + doce_id + "/" + fecha, function (data) {
        $("#asistencia tbody").children().remove();
        if (data.length == 0) {
             var filas =
                '<tr><th class="text-center" scope="col">#</th><th class="text-center" scope="col">Alumno</th><th class="text-center" scope="col">Asistencia</th></tr>';
            var filas =
                    '<tr id="filas' +
                    i +
                    '"><td></td><td class="text-center">'+ "No hay datos para mostrar" +"</td></tr>";
                $("#asistencia").append(filas);
        } else {
            var filas =
            '<tr><th class="text-center" scope="col">#</th><th class="text-center" scope="col">Alumno</th><th class="text-center" scope="col">Asistencia</th></tr>';
            for (var i = 0; i < data.length; i++) {
                if (data[i].asis_estado == 1) {
                    asistencia = "Presente";
                } else {
                    asistencia = "Falta";
                }
                filas =
                    '<tr id="filas' +
                    i +
                    '"><td class="text-center">'+(i+1)+'</td><td class="text-center">'+
                    data[i].alum_primerNombre + " " + data[i].alum_otrosNombres + " " + data[i].alum_apellidoPaterno + " " + data[i].alum_apellidoMaterno +
                    '</td><td class="text-center">'+ asistencia +"</td></tr>";
                $("#asistencia").append(filas);
            }
        }


    });

}

function fechaChange() {
    var fecha = document.getElementById("select-fecha_alum").value;
    var alum_id = document.getElementById("alumno_id").value;
    var asistencia;

    $.get("/api/asistencia/alumno/" + alum_id + "/" + fecha, function (data) {
        $("#asistencia tbody").children().remove();
        if (data.length == 0) {
             var filas =
                '<tr><th class="text-center" scope="col">#</th><th class="text-center" scope="col">Fecha</th><th class="text-center" scope="col">Asistencia</th></tr>';
            var filas =
                    '<tr id="filas' +
                    i +
                    '"><td></td><td class="text-center">'+ "No hay datos para mostrar" +"</td></tr>";
                $("#asistencia").append(filas);
            document.getElementById('paginate').style.display = 'none';
            document.getElementById('button').style.display = 'inline';
        } else {
            var filas =
            '<tr><th class="text-center" scope="col">#</th><th class="text-center" scope="col">Fecha</th><th class="text-center" scope="col">Asistencia</th></tr>';
            for (var i = 0; i < data.length; i++) {
                if (data[i].asis_estado == 1) {
                    asistencia = "Presente";
                } else {
                    asistencia = "Falta";
                }
                filas =
                    '<tr id="filas' +
                    i +
                    '"><td class="text-center">'+
                    data[i].asis_fecha +
                    '</td><td class="text-center">'+ asistencia +"</td></tr>";
                $("#asistencia").append(filas);
            }

            document.getElementById('paginate').style.display = 'none';
            document.getElementById('button').style.display = 'inline';
        }


    });

}
