@extends('layouts.app')
@section('titulo')
Tratamiento
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
       <h3 class="box-title">Tratamiento de Paciente </h3>
    </div
@if ($tratamiento->isEmpty()) <!--Si registrosP está vacío entonces...-->
    <div class="alert alert-warning" role="alert"><!--Notificación de Alerta-->
    No contiene tratamiento <!--Mensaje de alerta-->
    </div>
<a href="#VentanaF" role="button" class="btn btn-success" data-toggle="modal" title="Añadir Medicamento">Añadir Medicamento</a>
<form method="POST" action="{{ route('addTratamiento')}}">
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
                                        <label class="col-sm-2 control-label"><b>Medicamento: </b></label>
                                        <div class="col-sm-12">
                                                <select  class="form-control" name="medicamento_id">
                                                        @foreach($registrosMedicamentos as $medicamento)
                                                        <option value="{!!$medicamento->id_medicamento!!}">{!! $medicamento->nombre_medicamento!!}</option>
                                                        @endforeach
                                                </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-2 control-label"><b>Cantidad: </b></label>
                                        <div class="col-sm-12">
                                            <input type="number"  class="form-control" name="cantidad_medicamento">
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
<!-- Botón en HTML (lanza el modal en Bootstrap) -->
<a href="#VentanaF" role="button" class="btn btn-success" data-toggle="modal" title="Añadir Medicamento">Añadir Medicamento</a>
<!-- Modal / Ventana / Overlay en HTML -->
<form method="POST" action="{{ route('addTratamiento')}}">
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
                                    <input type="text"   class="form-control" name="paciente_id" value="{{$id}}">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Medicamento: </b></label>
                                    <div class="col-sm-12">
                                            <select  class="form-control" name="medicamento_id">
                                                    @foreach($registrosMedicamentos as $medicamento)
                                                    @if($medicamento->cantidad > 0) <!--Solo muestra medicamentos con cantidad mayores a 0-->
                                                        <option value="{!!$medicamento->id_medicamento!!}">{!! $medicamento->nombre_medicamento!!}</option>
                                                    @endif
                                                    @endforeach
                                            </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-2 control-label"><b>Cantidad: </b></label>
                                    <div class="col-sm-12">
                                        <input type="number"  class="form-control" name="cantidad_medicamento">
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


    @foreach ($tratamiento as $trat)
    <form method="POST"  enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="box-header with-border">
            <div class="form-group">
                <label class="col-sm-2 control-label">Medicamento:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="cantidad_medicamento_medicamento" readonly value="{{$trat->nombre_medicamento }}">
                </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-2 control-label">Cantidad</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="nombre" readonly value="{{ $trat->cantidad_medicamento}}">
                    </div>
            </div> 
        </div>
        
    </form>
    @endforeach
    @endif
</div>
@endsection
