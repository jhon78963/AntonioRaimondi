$(function () {
    $("#select-curso_id").on("change", cursoChangeDocente);
    $("#select-curso_id_alum").on("change", cursoChangeAlumno);
});


function cursoChangeDocente() {
    var cursodatos = document.getElementById("select-curso_id").value.split("_");
    var curso_id = cursodatos[0];
    var doce_id = cursodatos[1];
    var $select = $('#select-bimestre');
    $select.val($select.data('default'));
    $("#notas tbody").children().remove();

    $.get("/api/alumnos/" + curso_id + "/" + doce_id, function (data) {
        $("#promedio tbody").children().remove();
        var fila =
            '<tr><th class="text-center" scope="col">#</th><th class="text-center" scope="col">Alumno</th><th class="text-center" scope="col">Primera Unidad</th><th class="text-center" scope="col">Segunda Unidad</th><th class="text-center" scope="col">Tercera Unidad</th></tr>';
        for (var i = 0; i < data.length; i++) {

            if (Number(data[i].nota_primera_unidad) < 11) {
                nota_primera_unidad = 'C';
            } else if (Number(data[i].nota_primera_unidad) < 13) {
                nota_primera_unidad = 'B';
            } else if (Number(data[i].nota_primera_unidad) < 18) {
                nota_primera_unidad = 'A';
            } else {
                nota_primera_unidad = 'AD';
            }

            if (Number(data[i].nota_segundad_unidad) < 11) {
                nota_segundad_unidad = 'C';
            } else if (Number(data[i].nota_segundad_unidad) < 13) {
                nota_segundad_unidad = 'B';
            } else if (Number(data[i].nota_segundad_unidad) < 18) {
                nota_segundad_unidad = 'A';
            } else {
                nota_segundad_unidad = 'AD';
            }

            if (Number(data[i].nota_tercera_unidad) < 11) {
                nota_tercera_unidad = 'C';
            } else if (Number(data[i].nota_tercera_unidad) < 13) {
                nota_tercera_unidad = 'B';
            } else if (Number(data[i].nota_tercera_unidad) < 18) {
                nota_tercera_unidad = 'A';
            } else {
                nota_tercera_unidad = 'AD';
            }

            fila =
                '<tr id="fila' +
                i +
                '"><td class="text-center">' +
                (i + 1) +
                '</td><td class="text-center"><input type="hidden" name="idnotas[]" value="' +
                data[i].nota_id +
                '"><input type="hidden" name="idasecs[]" value="' +
                data[i].asec_id +
                '">' +
                data[i].alum_primerNombre +
                " " +
                data[i].alum_otrosNombres +
                " " +
                data[i].alum_apellidoPaterno +
                " " +
                data[i].alum_apellidoMaterno +

                '</td ><td class="text-center"><input type="hidden" class="form-control text-center" name="notas_primera_unidad[]" value="' +
                data[i].nota_primera_unidad +
                '">' +
                nota_primera_unidad +

                '</td ><td class="text-center"><input type="hidden" class="form-control text-center" name="notas_segundad_unidad[]" value="' +
                data[i].nota_segundad_unidad +
                '">' +
                nota_segundad_unidad  +

                '</td><td class="text-center"><input type="hidden" class="form-control text-center" name="notas_tercera_unidad[]" value="' +
                data[i].nota_tercera_unidad +
                '">' +
                nota_tercera_unidad +

                "</td></tr>";
            $("#promedio").append(fila);
        }
    });

}

function cursoChangeAlumno() {
    var cursodatos = document.getElementById("select-curso_id_alum").value.split("_");
    var curso_id = cursodatos[0];
    var alum_id = cursodatos[1];

    var $select = $('#select-bimestre_alum');
    $select.val($select.data('default'));
    $("#notas tbody").children().remove();

    $.get("/api/alumno/" + curso_id + "/" + alum_id, function (data) {
        $("#promedio tbody").children().remove();
        var fila =
            '<tr><th class="text-center" scope="col">#</th><th class="text-center" scope="col">Alumno</th><th class="text-center" scope="col">Primera Unidad</th><th class="text-center" scope="col">Segunda Unidad</th><th class="text-center" scope="col">Tercera Unidad</th></tr>';
        for (var i = 0; i < data.length; i++) {

            if (Number(data[i].nota_primera_unidad) < 11) {
                nota_primera_unidad = 'C';
            } else if (Number(data[i].nota_primera_unidad) < 13) {
                nota_primera_unidad = 'B';
            } else if (Number(data[i].nota_primera_unidad) < 18) {
                nota_primera_unidad = 'A';
            } else {
                nota_primera_unidad = 'AD';
            }

            if (Number(data[i].nota_segundad_unidad) < 11) {
                nota_segundad_unidad = 'C';
            } else if (Number(data[i].nota_segundad_unidad) < 13) {
                nota_segundad_unidad = 'B';
            } else if (Number(data[i].nota_segundad_unidad) < 18) {
                nota_segundad_unidad = 'A';
            } else {
                nota_segundad_unidad = 'AD';
            }

            if (Number(data[i].nota_tercera_unidad) < 11) {
                nota_tercera_unidad = 'C';
            } else if (Number(data[i].nota_tercera_unidad) < 13) {
                nota_tercera_unidad = 'B';
            } else if (Number(data[i].nota_tercera_unidad) < 18) {
                nota_tercera_unidad = 'A';
            } else {
                nota_tercera_unidad = 'AD';
            }

            fila =
                '<tr id="fila' +
                i +
                '"><td class="text-center"><input type="hidden" class="form-control text-center" name="notas_primera_unidad[]" value="' +
                data[i].nota_primera_unidad +
                '">' +
                nota_primera_unidad +

                '</td ><td class="text-center"><input type="hidden" class="form-control text-center" name="notas_segundad_unidad[]" value="' +
                data[i].nota_segundad_unidad +
                '">' +
                nota_segundad_unidad +

                '</td><td class="text-center"><input type="hidden" class="form-control text-center" name="notas_tercera_unidad[]" value="' +
                data[i].nota_tercera_unidad +
                '">' +
                nota_tercera_unidad +

                "</td></tr>";
            $("#promedio").append(fila);
        }
    });
}
