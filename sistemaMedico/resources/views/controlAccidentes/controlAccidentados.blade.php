@extends('layouts.app')
<?php 
use carbon\carbon;
?>
@section('titulo')
Control de Accidentes
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')
<div class="left">
        <h3 class="display-4">Control de Accidentes</h1>
</div>
<!--Input de búsqueda por fecha-->
<div class="large " >
    {!! Form::open(['route' => 'indexAccidentados','method' =>'GET','class' =>'right', 'role' =>'search'])!!}
    <div class="form-group">
        <!--<label> Fecha:</label>--> <!--Etiqueta que muestra que se trata de la fecha --> 
        <!--null es para el valor que se puede poner por defecto -->
        {!! Form::date('fecha',null,['class' => 'form-control']) !!}
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
<!--Input de búsqueda por matricula de paciente-->
<div class="large" >
        {!! Form::open(['route' => 'indexAccidentados','method' =>'GET', 'role' =>'search'])!!}
        <div class="form-group">
            {!! Form::text('matricula',null,['class' => 'form-control','placeholder' => 'Matricula paciente']) !!}
        <!--/div>
        <<button type="submit" class="btn btn-default">Buscar</button>-->
        {!! Form::close() !!}
</div>
<!--Terminación de input de búsqueda por matricula de paciente-->

<!--Formulario de nuevo registro-->
<!--Botón para formulario flotante-->
<button type="button" class="btn btn-amarillo btn-lg  fas fa-user-plus" data-toggle="modal" data-target="#ventanaFlotante"> Nuevo Registro</button>
<br><br>  
<!-- Modal -->
  <div class="modal fade" id="ventanaFlotante" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title fas fa-user-plus"> Nuevo Registro</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
                <!--Form de nuevo registro-->
            <form method="POST" action="{{ route('addAccidentado')}}" enctype="multipart/form-data" class="form-horizontal">
                @csrf
            <div class="box-body">
            <div class="form-group">
                
                <label class="col-sm-2 control-label"><b>Matrícula</b></label>
                <div class="col-sm-12">
                    {!!$errors->first('matricula','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="matricula" placeholder="Matrícula"
                        value="{{old('matricula')}}">
                </div>
                
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><b>Nombre</b></label>
                        <div class="col-sm-12">
                            {!!$errors->first('nombre','<br><span class="help-block">:message</span>')!!}
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                                value="{{old('nombre')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><b>Fecha de Nacimiento</b></label>
                        <div class="col-sm-12">
                            {!!$errors->first('fecha_nac','<br><span class="help-block">:message</span>')!!}
                            <input type="date" class="form-control" name="fecha_nac" placeholder="fecha_nac"
                                value="{{old('fecha_nac')}}">
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="col-sm-2 control-label"><b>Área</b></label>
                        <div class="col-sm-12">
                            <!--El siguiente <select> ocupa la variable $registrosCarrera la cual se encuentra en
                                bitacoraController la cual realiza una consulta a la BD para extraer los registros
                                que se encuentran en la tabla.-->
                            <select  class="form-control" name="area_id">
                                @foreach($registrosCarrera as $carrera)
                                <option value="{!!$carrera->id_carrera!!}"> {!! $carrera->id_carrera!!} .- {!! $carrera->nombre_carrera!!} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><b>Diagnóstico</b></label>
                        <div class="col-sm-12">
                            {!!$errors->first('diagnostico','<br><span class="help-block">:message</span>')!!}
                            <input type="text" class="form-control" name="diagnostico" placeholder="Diagnóstico">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label"><b>Afección: </b></label>
                            <div class="col-sm-12">
                                    <select  class="form-control" name="afeccion_id" >
                                            <option value="11">11 .- Curación</option>
                                    </select>
                            </div>
                    </div>
                    <!--Ingresar si se envió al IMSS al paciente -->
                    <div class="form-group">
                            <label class="col-sm-4 control-label"><b>Envío a IMSS</b></label>
                            <div class="col-sm-12">
                                {!!$errors->first('envio_imss','<br><span class="help-block">:message</span>')!!}
                                    <select class="form-control" name="envio_imss"  >
                                            <option value="No">No</option>
                                            <option value="Si">Si</option>
                                    </select>
                            </div>
                    </div>
                    <!--Ingresar Razón de la Referencia -->
                    <div class="form-group">
                        <!--Etiqueta de Razón de Referencia -->
                            <label class="col-sm-6 control-label"><b>Razón de Referencia</b></label>
                        <div class="col-sm-12">
                            {!!$errors->first('razon_ref','<br><span class="help-block">:message</span>')!!}
                            <input type="text" class="form-control" name="razon_ref" placeholder="Razón de Referencia" value="Ninguna"
                                value="{{old('razon_ref')}}">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label"><b>Usuario</b></label>
                            <div class="col-sm-12">
                                {!!$errors->first('user_id','<br><span class="help-block">:message</span>')!!}
                                <input type="text"  readonly class="form-control" name="user_id" value="{{auth()->user()->id}}">
                            </div>
                        </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-morado btn-block">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--Terminación del Form de nuevo registro-->
        </div>
        <!--Botón para cerrar formulario flotante-->
        <div class="modal-footer">
          <button type="button" class="btn btn-close" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<!--Terminación del Formulario Completo de nuevo registro-->

<!-- -->

<!--Mostrar los Registros de Medicamentos-->
@if ($registrosAccidentados->isEmpty()) <!--Si registrosEmbarazadas está vacío entonces...-->
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
                    <th>Envío IMSS</th>
                    <th>Razón Ref</th>
                    <th>Fecha/Hora Visita</th>
                    <th>Tratamiento</th>
                    <th>Datos Extra</th>
                @if (auth()->user()->rol_id == 1)
                <th colspan="2">Operaciones</th>
                @endif
            </tr>
            @foreach($registrosAccidentados as $paciente) <!--Ciclo que recorre toda la tabla -->
            <tr class="textCenter">
                    <td>{!! $paciente->matricula!!}</td>
                    <td>{!! $paciente->nombre!!}</td>
                    <td>{{ Carbon::parse($paciente->fecha_nac)->age}}</td>
                    <td>{!! $paciente->nombre_carrera!!}</td>
                    <td>{!! $paciente->diagnostico!!}</td>
                <!--    <td>{! $paciente->nombre_afeccion!!}</td> -->
                    <td>{!! $paciente->envio_imss!!}</td>
                    <td>{!! $paciente->razon_ref!!}</td>
                    <td>{!! $paciente->created_at!!}</td>
                <td>
                    <a href="{{ route('showTratamiento',$paciente->id_paciente)}}" role="button" 
                    class="btn btn-amarillo-ch fas fa-prescription-bottle-alt" title="Ver tratamiento"></a>
                </td>
                <td>
                        <a href="{{ route('showDatosAccidente',$paciente->id_paciente)}}" role="button" 
                        class="btn btn-morado fas fa-diagnoses" title="Datos de Accidente"></a>
                        
                </td>
                @if (auth()->user()->rol_id == 1)
                <td>
                    <a href="{{ route('mostrarDatos',$paciente->id_paciente)}}" role="button" 
                        class="btn btn-success fas fa-pen" title="Editar Registro"></a>
                </td>
                <td>
                    <form method="POST" action="{{ route('deletePaciente',$paciente->id_paciente)}}">
                        {{method_field('DELETE')}}
                        @csrf
                        <input class="btn btn-danger" onclick="confirmDelete()" type="submit" value="Eliminar">
                    </form>
                    </td>
                @endif
            </tr>
            
            @endforeach
            @endif
        </table>
        <!--Terminación de la tabla que muestra a los registros de los pacientes-->
        
    </div><!--Terminación Div box-body table-responsive no-padding-->
    <!-- /.box-body -->
</div><!--Terminación Div Class Box-->

<script type="text/javascript">
    function confirmDelete() {
    //Ingresamos un mensaje a mostrar
    var mensaje = confirm("¿Está seguro de eliminar la información?");
    //Detectamos si el usuario acepto el mensaje
        if (mensaje) {
           //mensaje en caso de que acepte el envio de la información
        }
        //Detectamos si el usuario denegó el mensaje
        else {
            alert("Ha cancelado la eliminación.");
            //Función para 
            stopDefAction(event);
            function stopDefAction(evt) {
                evt.preventDefault();
            }
        }
    }
</script>
@endsection

