@extends('layouts.app')
@section('titulo')
Datos de Embarazada
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
       <h3 class="box-title">Datos de Embarazada</h3>
    </div
@if ($datos->isEmpty()) <!--Si registrosP está vacío entonces...-->
    <div class="alert alert-warning" role="alert"><!--Notificación de Alerta-->
    No se han registrado datos <!--Mensaje de alerta-->
    </div>
<a href="#VentanaF" role="button" class="btn btn-success" data-toggle="modal" title="Añadir datos extra">Añadir datos Extra</a>
<form method="POST" action="{{ route('addDatosEmbarazada')}}">
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
                                        <input type="text" readonly  class="form-control" name="paciente_id" value="{{$id}}">
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Control: </b></label>
                                    <div class="col-sm-12">
                                        <input type="text"  class="form-control" name="control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Comentarios: </b></label>
                                    <div class="col-sm-12">
                                        <input type="text"  class="form-control" name="comentarios">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Fecha Probable de Parto: </b></label>
                                    <div class="col-sm-12">
                                        <input type="date"  class="form-control" name="f_prob_parto">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Fecha Ingreso: </b></label>
                                    <div class="col-sm-12">
                                        <input type="date"  class="form-control" name="f_ingreso">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Semanas de Embarazo: </b></label>
                                    <div class="col-sm-12">
                                        <input type="number"  class="form-control" name="semanas_embarazo">
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
                <th>Control</th>
                <th>Comentarios</th>
                <th>Fecha de Parto</th>
                <th>Fecha de Ingreso</th>
                <th>Semanas de Embarazo</th>
                <th></th>
                <th></th>

            </tr>
            @foreach($registroDatosExtra as $paciente) <!--Ciclo que recorre toda la tabla -->
            <tr class="textCenter">
                <td>{!! $paciente->control!!}</td>
                <td>{!! $paciente->comentarios!!}</td>
                <td>{!! $paciente->f_prob_parto!!}</td>
                <td>{!! $paciente->f_ingreso!!}</td>
                <td>{!! $paciente->semanas_embarazo!!}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
@endif
    </table>

</div>
@endsection
