@extends('layouts.app')
@section('titulo')
Bitácora Diaria
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')
<div class="left">
        <h3 class="display-4">Médicos</h1>
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
<button type="button" class="btn btn-amarillo btn-lg" data-toggle="modal" data-target="#ventanaFlotante">Nuevo Registro</button>
  <!-- Modal -->
  <div class="modal fade" id="ventanaFlotante" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Nuevo Registro</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
                <!--Form de nuevo registro-->
            <form method="POST" action="{{ route('addMedico')}}" enctype="multipart/form-data" class="form-horizontal">
                @csrf
            <div class="box-body">
            <div class="form-group">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-12">
                            {!!$errors->first('nombre','<br><span class="help-block">:message</span>')!!}
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                                value="{{old('nombre')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Apellidos</label>
                        <div class="col-sm-12">
                            {!!$errors->first('apellido','<br><span class="help-block">:message</span>')!!}
                            <input type="text" class="form-control" name="apellido" placeholder="apellido"
                                value="{{old('apellido')}}">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                {!!$errors->first('email','<br><span class="help-block">:message</span>')!!}
                                <input type="text" class="form-control" name="email" placeholder="Email"
                                    value="{{old('email')}}">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Contraseña</label>
                            <div class="col-sm-12">
                                {!!$errors->first('password','<br><span class="help-block">:message</span>')!!}
                                <input type="password" class="form-control" name="password" placeholder="Contraseña"
                                    value="{{old('password')}}">
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo de Usuario</label>
                        <div class="col-sm-12">
                            {!!$errors->first('rol_id','<br><span class="help-block">:message</span>')!!}
                            <select  class="form-control" name="rol_id">
                                    <option value="2">1.- Doctor</option>
                            </select>
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
@if ($registrosMedicos->isEmpty()) <!--Si registrosP está vacío entonces...-->
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
            <tr class="encabezadoTR">
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach($registrosMedicos as $medico)
            <tr>
                <td>{!! $medico->nombre!!}</td>
                <td>{!! $medico->apellido!!}</td>
                <td>{!! $medico->email!!}</td>
                <td>{!! $medico->rol!!}</td>
                <td><a href="{{ route('editarMedico',$medico->id)}}" class="btn btn-success fas fa-pen"></a></td>
                <td>
                    <form method="POST" action="{{ route('eliminarMedico',$medico->id)}}">
                        {{method_field('DELETE')}}
                        @csrf
                        <input class="btn btn-danger" type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
        <!--Terminación de la tabla que muestra a los registros de los medicos-->

        <!--Botones para descargas en EXCEL y PDF-->
        <div class="sticky-container">
                <ul class="sticky">
                <br>
                    <li>
                        <img src="https://image.flaticon.com/icons/svg/1126/1126862.svg" width="50" height="50" title="Descargar PDF">
                        <p><a href="" target="_blank"></a></p>
                    </li>
                    <br>
                    <li>
                        <img src="https://image.flaticon.com/icons/svg/732/732220.svg" width="50" height="50" title="Descargar Excel">
                        <p><a href="https://twitter.com/noprog" target="_blank"></a></p>
                    </li>
                </ul>
            </div><!--Terminación Div sticky-container-->
        <!--Terminación de Botones para descargas en EXCEL y PDF-->
        
    </div><!--Terminación Div box-body table-responsive no-padding-->
    <!-- /.box-body -->
</div><!--Terminación Div Class Box-->

@endsection