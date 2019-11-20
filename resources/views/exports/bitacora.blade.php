<?php 
use carbon\carbon;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        th {
            border: 1px solid black;
        }
    </style>
</head>
<body>
        <table>
                <tr>
                    <th colspan="8"><img src="img/cabecera.png"></th>
                </tr>
                <tr></tr>
                <tr border="1">
                        <th><b>Matricula</b></th>
                        <th><b>Nombre</b></th>
                        <th><b>Edad</b></th>
                        <th><b>Área</b></th>
                        <th><b>Diagnóstico</b></th>
                        <th><b>Envío IMSS</b></th>
                        <th><b>Razón Ref</b></th>
                        <th><b>Fecha/Hora Visita</b></th>
    
                </tr>
                @foreach($registrosPacientes as $paciente) <!--Ciclo que recorre toda la tabla -->
                <tr class="textCenter">
                    <td>{!! $paciente->matricula!!}</td>
                    <td>{!! $paciente->nombre!!}</td>
                    <td>{{ Carbon::parse($paciente->fecha_nac)->age}}</td>
                    <td>{!! $paciente->nombre_carrera!!}</td>
                    <td>{!! $paciente->diagnostico!!}</td>
                <!--    <td> $paciente->nombre_afeccion!!}</td> -->
                    <td>{!! $paciente->envio_imss!!}</td>
                    <td>{!! $paciente->razon_ref!!}</td>
                    <td>{!! $paciente->created_at!!}</td>
                </tr>
                @endforeach
        </table>
</body>
</html>

