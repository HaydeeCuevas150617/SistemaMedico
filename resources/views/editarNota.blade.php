@extends('layouts.app')
@section('titulo')
Editar Nota
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')
<h1 class="display-4">Editar Nota</h1>
@endsection

@section('Contenido')
<div class="box box-info" id="nuevo">
    <div class="box-header with-border">
        <h3 class="box-title">Editar Nota</h3>
        <a href="javascript:history.back()" class="fas fa-arrow-circle-left right" style="font-size: 200%"></a>
    </div>
    @if (isset($nota))
    @foreach ($nota as $registroNota)
    <form method="POST" action="{{ route('actualizarNota',$registroNota->id)}}" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Id Usuario</label>
                <div class="col-sm-12">
                    {!!$errors->first('user_id','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="user_id" readonly value="{{$registroNota->user_id }}">
                </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-2 control-label">Asunto</label>
                    <div class="col-sm-12">
                        {!!$errors->first('asunto','<br><span class="help-block">:message</span>')!!}
                        <input type="text" class="form-control" name="asunto" value="{{ $registroNota->asunto }}">
                    </div>
                </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-12">
                    {!!$errors->first('descripcion','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="descripcion" placeholder="descripcion" value="{{ $registroNota->descripcion }}">
                </div>
            </div>
        <div class="box-footer">
            <button type="submit" onclick="confirmEdicion()" class="btn btn-info btn-block">Guardar</button>
        </div>
    </form>

    <!--Script para mensajes de confirmación de edición-->
    <script type="text/javascript">
        function confirmEdicion() {
        //Ingresamos un mensaje a mostrar
        var mensaje = confirm("¿Está seguro de editar la información?");
        //Detectamos si el usuario acepto el mensaje
            if (mensaje) {
               //mensaje en caso de que acepte el envio de la información
            }
            //Detectamos si el usuario denegó el mensaje
            else {
                alert("Ha cancelado la edición.");
                //Función para 
                stopDefAction(event);
                function stopDefAction(evt) {
                    evt.preventDefault();
                    javascript:history.back();
                }
            }
        }
    </script>
    @endforeach
    @endif
</div>
@endsection
