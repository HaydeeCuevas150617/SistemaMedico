@extends('layouts.app')
<?php 
use carbon\carbon;
?>
@section('titulo')
Gráficas Mensuales
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')
@endsection

@section('Contenido')
<div class="box box-info" id="nuevo">
    <div class="box-header with-border">
       <a href="javascript:history.back()" class="fas fa-arrow-circle-left right" style="font-size: 200%"></a>
       <h3 class="box-title">Gráficas Mensuales</h3><strong>{{$mes->fecha2}}</strong>
    </div>
<!--Tabla de casos por carrera mensual-->
<div class="box">
<div class="box-body table-responsive no-padding"><br>
    <table class="table table-hover "> <!--size300px para hacer tabla mas pequeña-->
        <tr class="encabezadoTR textCenter">
            <th>ITEM</th>
            <th>Carrera</th>
            <th>No. Casos</th>
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
    </table>
</div>
  <div id="top_x_div" style="width: 800px; height: 400px;"></div>
</div>
<!--FIN DE Tabla de casos por carrera mensual-->
<!--Tabla de casos por afección mensual-->
<div class="box">
<div class="box-body table-responsive no-padding"><br>
    <table class="table table-hover "> <!--size300px para hacer tabla mas pequeña-->
        <tr class="encabezadoTR textCenter">
            <th>ITEM</th>
            <th>Carrera</th>
            <th>No. Casos</th>
        </tr>
        @foreach($registrosAfeccion as $pacienteMensual)
         <tr class="textCenter">
            <td>{!! $pacienteMensual->id_afeccion!!}</td>
            <td>{!! $pacienteMensual->nombre_afeccion!!}</td>
            @if($pacienteMensual->id_afeccion == 1)
            <td>{!! $Respiratorias[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 2)
            <td>{!! $Digestivas[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 3)
            <td>{!! $Osteo[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 4)
            <td>{!! $Cardio[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 5)
            <td>{!! $Genito[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 6)
            <td>{!! $Dermo[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 7)
            <td>{!!  $Ofta[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 8)
            <td>{!! $Neuro[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 9)
            <td>{!! $Gineco[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 10)
            <td>{!! $Curacion[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 11)
            <td>{!! $P_fam[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 12)
            <td>{!! $Ap_med[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 13)
            <td>{!!  $PresionArterial[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 14)
            <td>{!! $Campania_mensual[0]->conteos!!}</td>
            @endif
            @if($pacienteMensual->id_afeccion == 15)
            <td>{!! $OtrosAfeccion[0]->conteos!!}</td>
            @endif

         </tr>
        @endforeach
    </table>
</div>
<div id="piechart"  style="width: 800px; height: 400px;"></div>
</div>
<!--FIN DE Tabla de casos por afección mensual-->

</div>

@endsection
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

   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);

   function drawChart() {
    var data = google.visualization.arrayToDataTable([
    ['Afección', 'Cantidad'],
               ['Respiratorias',   {!! $Respiratorias[0]->conteos!!}],
               ['Digestivas',   {!! $Digestivas[0]->conteos!!}],
               ['Osteo',   {!! $Osteo[0]->conteos!!}],
               ['Cardio',   {!! $Cardio[0]->conteos!!}],
               ['Genito',   {!! $Genito[0]->conteos!!}],
               ['Dermo',   {!! $Dermo[0]->conteos!!}],
               ['Ofta',   {!! $Ofta[0]->conteos!!}],
               ['Neuro', {!! $Neuro[0]->conteos!!}],
               ['Gineco',   {!! $Gineco[0]->conteos!!}],
               ['Curacion',   {!! $Curacion[0]->conteos!!}],
               ['P_fam',   {!! $P_fam[0]->conteos!!}],
               ['Ap_med',   {!! $Ap_med[0]->conteos!!}],
               ['PresionArterial',   {!! $PresionArterial[0]->conteos!!}],
               ['Campania_mensual',   {!! $Campania_mensual[0]->conteos!!}],
               ['OtrosAfeccion',   {!! $OtrosAfeccion[0]->conteos!!}],
             ]);
var options = {
  title: 'Gráfica mensual por afección'
};

var chart = new google.visualization.PieChart(document.getElementById('piechart'));

chart.draw(data, options);
}

 </script>