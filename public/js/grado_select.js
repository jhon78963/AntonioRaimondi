$(function(){
    $('#grado_id').on('change', gradoCambio);
    $('#secc_id').on('change', vacanteCambio);
});

function gradoCambio(){
    var grado_id = $(this).val();

    $.get('/api/aulas/' + grado_id, function (data) {
        $('#aula_capacidad').val("");
        $('#aula_id').val("");
        var html_select = '<option value="">Seleccione sección</option>'
        for(var i=0;i<data.length;i++)
            html_select += '<option value="'+data[i].secc_id+'">'+data[i].secc_descripcion+'</option>';
        $('#secc_id').html(html_select);

    });


}

function vacanteCambio() {
    var grado_id = $('#grado_id').val();
    var secc_id = $(this).val();

    $.get('/api/aulas/'+grado_id+'/'+secc_id, function(data){
        $('#aula_id').val(data.aula_id);
    });

    $.get('/api/vacantes/'+grado_id+'/'+secc_id, function(data){
        $('#aula_capacidad').val(data.aula_capacidad);
    });
}
