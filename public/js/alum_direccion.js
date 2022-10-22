$(function(){
    $('#pais_id').on('change', paisCambio);
    $('#depa_id').on('change', departamentoCambio);
    $('#prov_id').on('change', provinciaCambio);
});

function paisCambio(){
    var pais_id = $(this).val();

    var html_select_departamento = '<option value="">Seleccione Departamento</option>';
    var html_select_provincia = '<option value="">Seleccione Provincia</option>';
    var html_select_distrito = '<option value="">Seleccione Distrito</option>';

    $('#depa_id').html(html_select_departamento);
    $('#prov_id').html(html_select_provincia);
    $('#dist_id').html(html_select_distrito);

    $.get('/api/pais/'+pais_id+'/departamentos', function(data){
        var html_select = '<option value="">Seleccione Departamento</option>'
        for(var i=0;i<data.length;i++)
            html_select += '<option value="'+data[i].depa_id+'">'+data[i].depa_nombre+'</option>';
        $('#depa_id').html(html_select);
    });
}

function departamentoCambio(){
    var departamento_id = $(this).val();

    var html_select_provincia = '<option value="">Seleccione Provincia</option>';
    var html_select_distrito = '<option value="">Seleccione Distrito</option>';

    $('#prov_id').html(html_select_provincia);
    $('#dist_id').html(html_select_distrito);

    $.get('/api/departamento/'+departamento_id+'/provincias', function(data){
        var html_select = '<option value="">Seleccione Provincia</option>'
        for(var i=0;i<data.length;i++)
            html_select += '<option value="'+data[i].prov_id+'">'+data[i].prov_nombre+'</option>';
        $('#prov_id').html(html_select);
    });
}

function provinciaCambio(){
    var provincia_id = $(this).val();

    var html_select_distrito = '<option value="">Seleccione Distrito</option>';

    $('#dist_id').html(html_select_distrito);

    $.get('/api/provincia/'+provincia_id+'/distritos', function(data){
        var html_select = '<option value="">Seleccione Distrito</option>'
        for(var i=0;i<data.length;i++)
            html_select += '<option value="'+data[i].dist_id+'">'+data[i].dist_nombre+'</option>';
        $('#dist_id').html(html_select);
    });
}
