@extends('layouts.app')
<?php 
use App\Http\Controllers\PlanificadoresController;
?>
@section('titulo')
Datos de Planificación Familiar
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
       <h3 class="box-title">Datos de Planificación Familiar</h3>
    </div
@if ($datos->isEmpty()) <!--Si registrosP está vacío entonces...-->
    <div class="alert alert-warning" role="alert"><!--Notificación de Alerta-->
    No se han registrado datos <!--Mensaje de alerta-->
    </div>
<a href="#VentanaF" role="button" class="btn btn-success" data-toggle="modal" title="Añadir datos extra">Añadir datos Extra</a>
<form method="POST" action="{{ route('addDatosPlanificador')}}">
        @csrf
            <div id="VentanaF" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title fas fa-prescription-bottle-alt"  > Registro de Medicamentos</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> <!-- Opción de cerrar ventana -->
                            </div>
                            <div class="modal-body">
                                <!-- Aquí van los inputs con la información -->
                                <div class="form-group">
                                        <label class="col-sm-2 control-label"><b>Id paciente: </b></label>
                                        <div class="col-sm-12">
                                        <input type="text" readonly  class="form-control" name="paciente_id" 
                                        value="{{$id}}">
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>NSS: </b></label>
                                    <div class="col-sm-12">
                                        <input type="number" size="11" class="form-control" name="nss">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Tipo de Método: </b></label>
                                    <div class="col-sm-12">
                                        <input type="text"  class="form-control" name="tipo_metodo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Correo: </b></label>
                                    <div class="col-sm-12">
                                        <input type="email"  class="form-control" name="correo"
                                    value="{{strtolower($correo)}}.@upemor.edu.mx">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-2 control-label"><b>Estado: </b></label>
                                        <div class="col-sm-12">
                                            <input type="text"  class="form-control" name="estado">
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Fecha de Aplicacion: </b></label>
                                    <div class="col-sm-12">
                                        <input type="date"  class="form-control" name="f_aplicacion">
                                    </div>
                                </div>
                                
                                <!-- Cerrar los inputs con la información -->
                            </div>            
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-info btn-block">Guardar</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
            </div>
    </form>
<!-- Modal / Ventana / Overlay en HTML -->
@else 
<div class="box">
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr class="encabezadoTR textCenter">
                <th>Nss</th>
                <th>Tipo de Método</th>
                <th>correo</th>
                <th>Estado</th>
                <th>Fecha de Aplicación</th>
                <th></th>
                <th></th>

            </tr>
            @foreach($registroDatosExtra as $paciente) <!--Ciclo que recorre toda la tabla -->
            <tr class="textCenter">
                <td>{!! $paciente->nss!!}</td>
                <td>{!! $paciente->tipo_metodo!!}</td>
                <td>{!! $paciente->correo!!}</td>
                <td>{!! $paciente->estado!!}</td>
                <td>{!! $paciente->f_aplicacion!!}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
@endif
    </table>
    </div>
</div>
@endsection
