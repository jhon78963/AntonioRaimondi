<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Ficha de Matricula</title>
</head>

<body>
    <style>
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            position: relative;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
            text-align: right;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #03c3ec;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #03c3ec;
        }

        table .desc {
            text-align: left;
        }

        table .unit {
            background: #DDDDDD;
        }

        table .qty {}

        table .total {
            background: #03c3ec;
            color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #03c3ec;
            font-size: 1.4em;
            border-top: 1px solid #03c3ec;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }
    </style>
    <header class="clearfix">
        <div id="logo">
            <img src="img/logo.png">
        </div>
        <div id="company">
            <h2 class="name">Colegio Antonio Raimondi</h2>
            <div>Av. Agustín Gamarra 217, Huaraz</div>
            <div>(043) 422711</div>

        </div>
    </header>
    @foreach ($matriculas as $matricula)
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                    <div class="to">ALUMNO:</div>
                    <h2 class="name">{{ $matricula->alum_primerNombre }}
                        {{ $matricula->alum_otrosNombres }}
                        {{ $matricula->alum_apellidoPaterno }} {{ $matricula->alum_apellidoMaterno }}</h2>
                    <div class="address">{{ strtoupper($matricula->alum_direccion) }}
                        {{ $matricula->dist_nombre }},
                        {{ $matricula->prov_nombre }} - {{ $matricula->depa_nombre }}
                    </div>
                    <div class="email"><a href="{{ $matricula->alum_celular }}">{{ $matricula->alum_celular }}</a>
                    </div>
                </div>
                <div id="invoice">
                    <h1>{{ $titulo }}</h1>
                    <div class="date">Fecha: {{ $hoy }}</div>

                </div>


            </div>
            <div>
                <h2 class="text-center date" style="color: #0087C3;">DOCENTE</h2>
                <h2 class="text-center date">{{ $matricula->doce_primerNombre }}
                    {{ $matricula->doce_otrosNombres }} {{ $matricula->doce_apellidoPaterno }}
                    {{ $matricula->doce_apellidoMaterno }}
                </h2>
            </div>
            <div class="table-responsive">
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th class="no">FECHA</th>
                            <th class="unit">GRADO</th>
                            <th class="total">SECCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <tr>
                            <td class="text-center no">
                                {{ Carbon\Carbon::parse($matricula->created_at)->format('d M, Y') }}
                            </td>
                            <td class="text-center unit">{{ $matricula->grado_descripcion }}</td>
                            <td class="text-center total">{{ $matricula->secc_descripcion }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </main>
    @endforeach
    <?php
    function get_format($df)
    {
        $str = 'Tiempo de respuesta: ';
    
        if ($df->y > 0) {
            // years
            $str .= $df->y > 1 ? $df->y . ' Años ' : $df->y . ' Año ';
        }
        if ($df->m > 0) {
            // month
            $str .= $df->m > 1 ? $df->m . ' Meses ' : $df->m . ' Mes ';
        }
        if ($df->d > 0) {
            // days
            $str .= $df->d > 1 ? $df->d . ' Días ' : $df->d . ' Día ';
        }
        if ($df->h > 0) {
            // hours
            $str .= $df->h > 1 ? $df->h . ' Horas ' : $df->h . ' Hora ';
        }
        if ($df->i > 0) {
            // minutes
            $str .= $df->i > 1 ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
        }
        if ($df->s > 0) {
            // seconds
            $str .= $df->s > 1 ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
        }
        echo $str;
    }
    $date1 = new DateTime($hoy);
    $date2 = new DateTime($fecha_anterior);
    $diff = $date1->diff($date2);
    echo get_format($diff);
    
    ?>

</body>

</html>
