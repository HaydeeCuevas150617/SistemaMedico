@extends('layouts.app')
<?php 
use App\Http\Controllers\PlanificadoresController;
?>
@section('titulo')
Datos de Accidente
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
       <h3 class="box-title">Datos de Accidente</h3>
    </div
@if ($datos->isEmpty()) <!--Si registrosP está vacío entonces...-->
    <div class="alert alert-warning" role="alert"><!--Notificación de Alerta-->
    No se han registrado datos <!--Mensaje de alerta-->
    </div>
<a href="#VentanaF" role="button" class="btn btn-success" data-toggle="modal" title="Añadir datos extra">Añadir datos Extra</a>
<form method="POST" action="{{route('addDatosAccidente')}}">
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
                                    <label class="col-sm-2 control-label"><b>Área: </b></label>
                                    <div class="col-sm-12">
                                            <select class="form-control" name="area_accidente">
                                                    <option value="Interno">Interno</option>
                                                    <option value="Externo">Externo</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><b>Región Afectada: </b></label>
                                    <div class="col-sm-12">
                                        <input type="text"  class="form-control" name="region_afectada" placeholder="Región Afectada">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><b>Tipo de Lesión: </b></label>
                                    <div class="col-sm-12">
                                        <input type="text"  class="form-control" name="tipo_lesion" placeholder="Tipo de Lesión">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-4 control-label"><b>Causa de Lesión: </b></label>
                                        <div class="col-sm-12">
                                            <input type="text"  class="form-control" name="causa_lesion" placeholder="Causa de Lesión">
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><b>Lugar del Accidente: </b></label>
                                    <div class="col-sm-12">
                                        <input type="text"  class="form-control" name="lugar_accidente" placeholder="Lugar del Accidente">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-2 control-label"><b>Observaciones: </b></label>
                                        <div class="col-sm-12">
                                            <input type="text"  class="form-control" name="observaciones_accidente" placeholder="Observaciones">
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
                <th>Área</th>
                <th>Región Afectada</th>
                <th>Tipo de Lesión</th>
                <th>Causa de Lesión</th>
                <th>Lugar del Accidente</th>
                <th>Observaciones</th>
                <th></th>

            </tr>
            @foreach($registroDatosExtra as $paciente) <!--Ciclo que recorre toda la tabla -->
            <tr class="textCenter">
                <td>{!! $paciente->area_accidente!!}</td>
                <td>{!! $paciente->region_afectada!!}</td>
                <td>{!! $paciente->tipo_lesion!!}</td>
                <td>{!! $paciente->causa_lesion!!}</td>
                <td>{!! $paciente->lugar_accidente!!}</td>
                <td>{!! $paciente->observaciones_accidente!!}</td>
                <td></td>
            </tr>
            @endforeach
@endif
    </table>

</div>
@endsection
