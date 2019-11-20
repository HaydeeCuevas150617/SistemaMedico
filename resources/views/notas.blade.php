@extends('layouts.app')
@section('titulo')
Recordatorios
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')
<div class="left">
    <h3 class="display-4">Recordatorios</h1>
</div>
@endsection

@section('Contenido')
<!--Mensaje de acciones-->
@if (session()->has('msj'))
<div class="alert alert-success" role="alert">
    {{session('msj')}}
</div>
@endif

<!--Formulario de nuevo registro-->
<!--Botón para formulario flotante-->
<button type="button" class="btn btn-amarillo btn-lg  far fa-sticky-note" data-toggle="modal" data-target="#ventanaFlotante"> Nuevo Recordatorio</button>
<br><br>  
<!-- Modal -->
  <div class="modal fade" id="ventanaFlotante" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title far fa-sticky-note"> Nuevo Recordatorio</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
                <!--Form de nueva nota-->
            <form method="POST" action="{{ route('addNota')}}" enctype="multipart/form-data" class="form-horizontal">
                @csrf
            <div class="box-body">
            <div class="form-group">
                
                <label class="col-sm-2 control-label"><b>Asunto</b></label>
                <div class="col-sm-12">
                    {!!$errors->first('asunto','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="asunto" placeholder="Asunto"
                        value="{{old('asunto')}}">
                </div>
                
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><b>Descripcion</b></label>
                        <div class="col-sm-12">
                            {!!$errors->first('descripcion','<br><span class="help-block">:message</span>')!!}
                            <textarea  class="form-control" name="descripcion" placeholder="descripcion"
                                value="{{old('descripcion')}}"></textarea>
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




<!--Mostrar los Registros de Medicamentos-->
@if ($registrosNotas->isEmpty()) <!--Si registrosP está vacío entonces...-->
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
                <!--<th>Id Nota</th>-->
                <th>Usuario</th>
                <th>Asunto</th>
                <th>Descripción</th>
                <th>Creación</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($registrosNotas as $nota)
            <tr class="textCenter">
                 <!--<td>{!! $nota->id!!}</td>-->
                <td>{!! $nota->nombre!!}  {!!$nota->apellido!!}</td>
                <td>{!! $nota->asunto!!}</td>
                <td>{!! $nota->descripcion!!}</td>
                <td>{!! $nota->created_at!!}</td>
                @if (auth()->user()->rol_id==$nota->user_id)
                <td><a href="{{ route('editarNota',$nota->id)}}" class="btn btn-success fas fa-pen"></a>
                </td>
                <td>
                    <form method="POST" action="{{ route('eliminarNota',$nota->id)}}">
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