<?php 
use carbon\carbon;
?>
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
                    <th colspan="8"><img src="img/cabecera_mensual.png"></th>
                </tr>
                <tr>
                    <th><b>No.</b></th>
                    <th><b>Mes</b></th>
                    <th><b>Nombre</b></th>
                    <th><b>Edad</b></th>
                    <th><b>Área</b></th>
                    <th><b>Diagnóstico</b></th>
                    <th><b>Tratamiento</b></th>
                    <th><b>Cantidad</b></th>
    
                </tr>
                @foreach($registros as $paciente) <!--Ciclo que recorre toda la tabla -->
                <tr class="textCenter">
                    <td></td>
                    <td>{!! substr($paciente->created_at,5,2)!!}</td>
                    <td>{!! $paciente->nombre!!}</td>
                    <td>{{ Carbon::parse($paciente->fecha_nac)->age}}</td><!--Edad-->
                    <td>{!! $paciente->nombre_carrera!!}</td>
                    <td>{!! $paciente->diagnostico!!}</td>
                @if($paciente->nombre_medicamento!=NULL)
                    <td>{!! $paciente->nombre_medicamento!!}</td>
                    <td>{!! $paciente->cantidad_medicamento!!}</td>
                @endif    
                </tr>
                @endforeach
        </table>
</body>
</html>

