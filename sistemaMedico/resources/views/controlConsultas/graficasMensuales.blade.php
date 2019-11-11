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
       <h3 class="box-title">Gráficas Mensuales</h3>
    </div>
<!--Tabla de casos por carrera mensual-->
<!--Mostrar los Registros de Medicamentos-->

<div class="box">
    <!--<div class="box-header">
       <h3 class="box-title">Bitácora</h3>
    </div>-->
<div class="box-body table-responsive no-padding">
    <table class="table table-hover size300px">
        <tr class="encabezadoTR textCenter">
            <th>ITEM</th>
            <th>Carrera</th>
            <th>No. Casos</th>
        </tr>
        {{$conteos}}
        @foreach($registrosCarrera as $pacienteMensual)
         <tr class="textCenter">
            <td>{!! $pacienteMensual->id_carrera!!}</td>
            <td>{!! $pacienteMensual->nombre_carrera!!}</td>
            @if($pacienteMensual->id_carrera == 1)
            <td>{!! $conteos !!}</td>
            @endif
         </tr>
        @endforeach
    </table>
        <!--Terminación de la tabla que muestra a los registros de los pacientes-->
</div>
</div>
@endsection
