@extends('layouts.app')
<?php 
use carbon\carbon;
?>
@section('titulo')
Consultas Mensuales
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')
<div class="left">
<h3 class="display-4">Consultas Mensuales</h1> 
</div>
<!--Input de búsqueda por fecha-->
<div class="large " >
    
        {!! Form::open(['route' => 'indexMensuales','method' =>'GET','class' =>'right', 'role' =>'search'])!!}
        <div class="form-group">
            <!--<label> Fecha:</label>--> <!--Etiqueta que muestra que se trata de la fecha --> 
            <!--null es para el valor que se puede poner por defecto -->
            {!! Form::month('fecha','fecha',['class' => 'form-control']) !!}
            <button type="submit" class="btn btn-default">Buscar</button>
        </div>
        {!! Form::close() !!}
    </div>
<!--Terminación de input de búsqueda por fecha-->
@endsection

@section('Contenido')
<!--Mensaje de acciones-->
@if (session()->has('msj'))
<div class="alert alert-success" role="alert">
    {{session('msj')}}
</div>
@endif
<center>
    <a data-toggle="modal" data-target="#ventanaFlotanteFecha" class="btn btn-amarillo btn-lg  fas fa-chart-pie"> Ver Gráficas</a>    
</center>
<br>
<!-- -->
<!--Mostrar los Registros de Medicamentos-->
@if ($registrosPacientes->isEmpty()) <!--Si registrosP está vacío entonces...-->
<div class="alert alert-warning" role="alert"><!--Notificación de Alerta-->
    No hay registros <!--Mensaje de alerta-->
</div>
@else
<div class="box">
    <!--<div class="box-header">
       <h3 class="box-title">Bitácora</h3>
    </div>-->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr class="encabezadoTR textCenter">
                <th>Matricula</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Área</th>
                <th>Diagnóstico</th>
            <!--    <th>Afeccion</th> -->
                <th>Envío a IMSS</th>
                <th>Razón Ref</th>
                <th>Fecha/Hora Visita</th>
                <th>Tratamiento</th>
            </tr>
            
            @foreach($registrosPacientes as $paciente)
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
                <td class="textCenter">
                    <a href="{{ route('showTratamiento',$paciente->id_paciente)}}" role="button" 
                        class="btn btn-amarillo-ch fas fa-prescription-bottle-alt" title="Ver tratamiento"></a>
                </td> 
            </tr>
            @endforeach
@endif
        </table>
        <!--Terminación de la tabla que muestra a los registros de los pacientes-->

        <!--Botones para descargas en EXCEL y PDF-->
        <div class="sticky-container">
                <ul class="sticky">
                <br>
                    <br>
                    <li>
                        <a data-toggle="modal" data-target="#ventanaFlotanteFechaExcel" >
                        <img src="{{ asset('img/excel.png')}}" width="40" height="40" title="Descargar Excel">
                        </a>
                    </li>
                </ul>
            </div><!--Terminación Div sticky-container-->
        <!--Terminación de Botones para descargas en EXCEL y PDF-->
        
    </div><!--Terminación Div box-body table-responsive no-padding-->
    <!-- /.box-body -->
</div><!--Terminación Div Class Box-->
<!-- Modal ventanaFlotanteExcel -->
<div class="modal fade" id="ventanaFlotanteFechaExcel" role="dialog">
        <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title fas fa-download"> Mes de descarga</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                          <!--Form de nuevo registro-->
                      <form method="get" action="{{ route('descargarConsultasMensuales')}}" enctype="multipart/form-data" class="form-horizontal">
                          @csrf
                      <div class="box-body">
                      <div class="form-group">
                              <div class="form-group">
                                  <label class="col-sm-5 control-label"><b>Seleccionar Mes:</b></label>
                                  <div class="col-sm-12">
                                      {!!$errors->first('fecha_descarga','<br><span class="help-block">:message</span>')!!}
                                      <input type="month" class="form-control" name="fecha_descarga"
                                          value="{{old('fecha_descarga')}}">
                                  </div>
                              </div>
                              <div class="box-footer">
                                  <button  class="btn btn-morado btn-block">Descargar Reporte</button><br>
                              </div>
                          </div>
                      </div>
              </form>
            </div>
              <!--Terminación del Form de nuevo registro-->
                </div>
                </div>
</div><!--Terminación ventanaFlotanteExcel-->
<!-- Modal ventanaFlotante -->
<div class="modal fade" id="ventanaFlotanteFecha" role="dialog">
        <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title far fa-calendar-alt"> Seleccionar Mes</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                          <!--Form de nuevo registro-->
                      <form method="Post" action="{{ route('mostrarGraficasMensuales')}}" enctype="multipart/form-data" class="form-horizontal">
                          @csrf
                      <div class="box-body">
                      <div class="form-group">
                              <div class="form-group">
                                  <label class="col-sm-2 control-label"><b>Fecha:</b></label>
                                  <div class="col-sm-12">
                                      {!!$errors->first('fecha2','<br><span class="help-block">:message</span>')!!}
                                      <input type="month" class="form-control" name="fecha2"
                                          value="{{old('fecha2')}}">
                                  </div>
                              </div>
                              <div class="box-footer">
                                  <button  class="btn btn-morado btn-block">Mostrar Gráficas</button><br>
                              </div>
                          </div>
                      </div>
              </form>
            </div>
              <!--Terminación del Form de nuevo registro-->
                </div>
                </div>
</div><!--Terminación ventanaFlotanteE-->
@endsection

