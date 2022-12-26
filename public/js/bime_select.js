$(function () {
    $("#select-bimestre").on("change", bimestreChangeDocente);
    $("#select-bimestre_alum").on("change", bimestreChangeAlumno);
});

function bimestreChangeDocente() {
    var nrobimestre = $(this).val();
    var cursodatos = document.getElementById("select-curso_id").value.split("_");
    var curso_id = cursodatos[0];
    var doce_id = cursodatos[1];
    $('#nrobimestre').val(nrobimestre);

    $.get("/api/alumnos/bimestre/" + curso_id + "/" + doce_id + "/" + nrobimestre, function (data) {
        $("#notas tbody").children().remove();
        var filas =
            '<tr><th class="text-center" scope="col">#</th><th class="text-center" scope="col">Alumno</th><th class="text-center" scope="col">Primera Unidad</th><th class="text-center" scope="col">Segunda Unidad</th><th class="text-center" scope="col">Tercera Unidad</th></tr>';
        for (var i = 0; i < data.length; i++) {
            suma_semanal = (Number(data[i].nsem_primera_semana) + Number(data[i].nsem_segunda_semana) + Number(data[i].nsem_tercera_semana) + Number(data[i].nsem_cuarta_semana) + Number(data[i].nsem_quinta_semana) + Number(data[i].nsem_sexta_semana) + Number(data[i].nsem_septima_semana) + Number(data[i].nsem_octava_semana))/8;
            filas =
                '<tr id="filas' +
                i +
                '"><td class="text-center">' +
                (i + 1) +
                '</td><td class="text-center"><input type="hidden" name="idnsems[]" value="'+data[i].nsem_id+'"><input type="hidden" name="idasecs[]" value="'+data[i].asec_id+'"><input type="hidden" name="idnotas[]" value="' +
                data[i].nota_id +
                '">' +
                data[i].alum_primerNombre +
                " " +
                data[i].alum_otrosNombres +
                " " +
                data[i].alum_apellidoPaterno +
                " " +
                data[i].alum_apellidoMaterno +
                '</td><td class="text-center"><input class="form-control text-center" name="notas_primerasemana[]" value="' +
                data[i].nsem_primera_semana +
                '">' +
                '</td><td class="text-center"><input class="form-control text-center" name="notas_segundasemana[]" value="' +
                data[i].nsem_segunda_semana +
                '">' +
                '</td><td class="text-center"><input class="form-control text-center" name="notas_tercerasemana[]" value="' +
                data[i].nsem_tercera_semana +
                '">' +
                '</td><td class="text-center"><input class="form-control text-center" name="notas_cuartasemana[]" value="' +
                data[i].nsem_cuarta_semana +
                '">' +
                '</td><td class="text-center"><input class="form-control text-center" name="notas_quintasemana[]" value="' +
                data[i].nsem_quinta_semana +
                '">' +
                '</td><td class="text-center"><input class="form-control text-center" name="notas_sextasemana[]" value="' +
                data[i].nsem_sexta_semana +
                '">' +
                '</td><td class="text-center"><input class="form-control text-center" name="notas_septimasemana[]" value="' +
                data[i].nsem_septima_semana +
                '">' +
                '</td><td class="text-center"><input type="hidden" name="promedio_semanal[]" value="'+suma_semanal+'"><input class="form-control text-center" name="notas_octavasemana[]" value="' +
                data[i].nsem_octava_semana +
                '">' +
                "</td></tr>";
            $("#notas").append(filas);
        }
    });
}

function bimestreChangeAlumno() {
    var nrobimestre = $(this).val();
    var cursodatos = document.getElementById("select-curso_id_alum").value.split("_");
    var curso_id = cursodatos[0];
    var alum_id = cursodatos[1];
    $('#nrobimestre').val(nrobimestre);

    $.get("/api/alumno/bimestre/" + curso_id + "/" + alum_id + "/" + nrobimestre, function (data) {
        $("#notas tbody").children().remove();
        var filas =
            '<tr><th class="text-center" scope="col">#</th><th class="text-center" scope="col">Alumno</th><th class="text-center" scope="col">Primera Unidad</th><th class="text-center" scope="col">Segunda Unidad</th><th class="text-center" scope="col">Tercera Unidad</th></tr>';
        for (var i = 0; i < data.length; i++) {
            suma_semanal = (Number(data[i].nsem_primera_semana) + Number(data[i].nsem_segunda_semana) + Number(data[i].nsem_tercera_semana) + Number(data[i].nsem_cuarta_semana) + Number(data[i].nsem_quinta_semana) + Number(data[i].nsem_sexta_semana) + Number(data[i].nsem_septima_semana) + Number(data[i].nsem_octava_semana))/8;
            filas =
                '<tr id="filas' +
                i +
                '"><td class="text-center"><input readonly class="form-control text-center" name="notas_primerasemana[]" value="' +
                data[i].nsem_primera_semana +
                '">' +
                '</td><td class="text-center"><input readonly class="form-control text-center" name="notas_segundasemana[]" value="' +
                data[i].nsem_segunda_semana +
                '">' +
                '</td><td class="text-center"><input readonly class="form-control text-center" name="notas_tercerasemana[]" value="' +
                data[i].nsem_tercera_semana +
                '">' +
                '</td><td class="text-center"><input readonly class="form-control text-center" name="notas_cuartasemana[]" value="' +
                data[i].nsem_cuarta_semana +
                '">' +
                '</td><td class="text-center"><input readonly class="form-control text-center" name="notas_quintasemana[]" value="' +
                data[i].nsem_quinta_semana +
                '">' +
                '</td><td class="text-center"><input readonly class="form-control text-center" name="notas_sextasemana[]" value="' +
                data[i].nsem_sexta_semana +
                '">' +
                '</td><td class="text-center"><input readonly class="form-control text-center" name="notas_septimasemana[]" value="' +
                data[i].nsem_septima_semana +
                '">' +
                '</td><td class="text-center"><input readonly type="hidden" name="promedio_semanal[]" value="'+suma_semanal+'"><input readonly class="form-control text-center" name="notas_octavasemana[]" value="' +
                data[i].nsem_octava_semana +
                '">' +
                "</td></tr>";
            $("#notas").append(filas);
        }
    });
}
