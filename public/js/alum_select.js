$(function(){
    $('#select-alum_id').on('change', alumnoChange);
});

function alumnoChange(){
    var alum_id = $(this).val();

    $.get('/api/alumno/' + alum_id, function (data) {

        $('#alum_id').val(data.alum_id);
        $('#alum_dni').val(data.alum_dni);
        $('#alum_fechaNacimiento').val(data.alum_fechaNacimiento);
        $('#alum_primerNombre').val(data.alum_primerNombre);
        $('#alum_otrosNombres').val(data.alum_otrosNombres);
        $('#alum_apellidoPaterno').val(data.alum_apellidoPaterno);
        $('#alum_apellidoMaterno').val(data.alum_apellidoMaterno);
        $('#alum_direccion').val(data.alum_direccion);
        $('#alum_telefono').val(data.alum_telefono);
        $('#alum_celular').val(data.alum_celular);
        document.getElementById('alum_sexo').value = data.alum_sexo;
        document.getElementById('pais_id').value = data.pais_id;

        if (document.getElementById('depa_id').value == "0" && document.getElementById('prov_id').value == "0" && document.getElementById('dist_id').value == "0")
        {
            var pais_id = data.pais_id;
            var departamento_id = data.depa_id;
            var provincia_id = data.prov_id;
            var distrito_id = data.dist_id;

            $.get('/api/pais/'+pais_id+'/departamentos', function(data){
                var html_select = '<option value="">Seleccione departamento</option>'
                for (var i = 0; i < data.length; i++)
                    html_select += '<option value="' + data[i].depa_id + '">' + data[i].depa_nombre + '</option>';
                $('#depa_id').html(html_select);

                for (var i = 0; i < data.length; i++) {
                    if (data[i].depa_id == departamento_id) {
                        document.getElementById('depa_id').value = data[i].depa_id;
                    }
                }
            });

            $.get('/api/departamento/'+departamento_id+'/provincias', function(data){
                var html_select = '<option value="">Seleccione provincia</option>'
                for(var i=0;i<data.length;i++)
                    html_select += '<option value="'+data[i].prov_id+'">'+data[i].prov_nombre+'</option>';
                $('#prov_id').html(html_select);

                for (var i = 0; i < data.length; i++) {
                    if (data[i].prov_id == provincia_id) {
                        document.getElementById('prov_id').value = data[i].prov_id;
                    }
                }
            });


            $.get('/api/provincia/'+provincia_id+'/distritos', function(data){
                var html_select = '<option value="">Seleccione distrito</option>'
                for(var i=0;i<data.length;i++)
                    html_select += '<option value="'+data[i].dist_id+'">'+data[i].dist_nombre+'</option>';
                $('#dist_id').html(html_select);

                for (var i = 0; i < data.length; i++) {
                    if (data[i].dist_id == distrito_id) {
                        document.getElementById('dist_id').value = data[i].dist_id;
                    }
                }
            });
        } else {
            document.getElementById('depa_id').value = data.depa_id;
            document.getElementById('prov_id').value = data.prov_id;
            document.getElementById('dist_id').value = data.dist_id;
        }
    });
}
