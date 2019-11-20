<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
        <table>
                <tr>
                    <!--<th colspan="8"><img src="img/cabecera.png"></th>-->
                    <th colspan="8"><b>RELACIÓN PACIENTES CON METODO ANTICONCEPTIVO UPEMOR</b></th>
                </tr>
                <tr>
                    <th><b>No.</b></th>
                    <th><b>Nombre</b></th>
                    <th><b>Fecha de Nacimiento</b></th>
                    <th><b>Número IMSS</b></th>
                    <th><b>Tipo de Método</b></th>
                    <th><b>Correo</b></th>
                    <th><b>Estado</b></th>
                    <th><b>Fecha de Aplicación</b></th>
                    <th></th>
                    <th></th>
    
                </tr>
                @foreach($planificadores as $paciente) <!--Ciclo que recorre toda la tabla -->
                <tr class="textCenter">
                    <td></td>
                    <td>{!! $paciente->nombre!!}</td>
                    <td>{!! $paciente->fecha_nac!!}</td>
                    <td>{!! $paciente->nss!!}</td>
                    <td>{!! $paciente->tipo_metodo!!}</td>
                    <td>{!! $paciente->correo!!}</td>
                    <td>{!! $paciente->estado!!}</td>
                    <td>{!! $paciente->f_aplicacion!!}</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
        </table>
</body>
</html>

