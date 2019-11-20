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
                    <th><b>ITEM</b></th>
                    <th><b>Carrera</b></th>
                    <th><b>No. Casos</b></th>
            </tr>
                @foreach($registrosCarrera as $pacienteMensual)
                 <tr class="textCenter">
                    <td>{!! $pacienteMensual->id_carrera!!}</td>
                    <td>{!! $pacienteMensual->nombre_carrera!!}</td>
                    @if($pacienteMensual->id_carrera == 1)
                    <td>{!! $LAG[0]->conteos!!}</td>
                    @endif
                    @if($pacienteMensual->id_carrera == 2)
                    <td>{!! $IBT[0]->conteos!!}</td>
                    @endif
                    @if($pacienteMensual->id_carrera == 3)
                    <td>{!! $ITA[0]->conteos!!}</td>
                    @endif
                    @if($pacienteMensual->id_carrera == 4)
                    <td>{!! $IIN[0]->conteos!!}</td>
                    @endif
                    @if($pacienteMensual->id_carrera == 5)
                    <td>{!! $IIF[0]->conteos!!}</td>
                    @endif
                    @if($pacienteMensual->id_carrera == 6)
                    <td>{!! $IFI[0]->conteos!!}</td>
                    @endif
                    @if($pacienteMensual->id_carrera == 7)
                    <td>{!! $IET[0]->conteos!!}</td>
                    @endif
                    @if($pacienteMensual->id_carrera == 8)
                    <td>{!! $OTROS[0]->conteos!!}</td>
                    @endif
                 </tr>
                @endforeach
            <tr></tr>
            <tr></tr>
    </table>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Carreras', 'Pacientes Registrados'],
            ['LAG',   {!! $LAG[0]->conteos!!}],
            ['IBT',   {!! $IBT[0]->conteos!!}],
            ['ITA',   {!! $ITA[0]->conteos!!}],
            ['IIN',   {!! $IIN[0]->conteos!!}],
            ['IIF',   {!! $IIF[0]->conteos!!}],
            ['IFI',   {!! $IFI[0]->conteos!!}],
            ['IET',   {!! $IET[0]->conteos!!}],
            ['OTROS', {!! $OTROS[0]->conteos!!}]
            ]);

        var options = {
          width: 800,
          legend: { position: 'none' },
          chart: {
            title: 'Gráfica mensual por afección',
            subtitle: 'Afecciones' },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };


 </script>
</html>

