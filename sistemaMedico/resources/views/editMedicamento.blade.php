@extends('layouts.app')
@section('titulo')
Editar Medicamento
@endsection
@section('nombre')
Bienvenido {{auth()->user()->name}}
@endsection

@section('Contenido')
<div class="box box-info" id="nuevo">
    <div class="box-header with-border">
        <a href="javascript:history.back()" class="fas fa-arrow-circle-left right" style="font-size: 200%"></a>
        <h3 class="box-title">Editar Medicamento</h3>
    </div>
    @if (isset($medicamento))
    @foreach ($medicamento as $registroMed)
    <form method="POST" action="{{ route('updateMed',$registroMed->id_medicamento)}}" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-12">
                    {!!$errors->first('nombre_medicamento','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="nombre_medicamento" readonly value="{{ $registroMed->nombre_medicamento }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Cantidad</label>
                <div class="col-sm-12">
                    {!!$errors->first('cantidad','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="cantidad" placeholder="Cantidad" value="{{ $registroMed->cantidad }}">
                </div>
            </div>
        <div class="box-footer">
            <button type="submit"  onclick="confirmEdicion()" class="btn btn-info btn-block">Guardar</button>
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
