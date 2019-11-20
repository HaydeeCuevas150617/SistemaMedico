@extends('layouts.app')
@section('titulo')
Inventario de Medicamentos
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')
<div class="left">
        <h3 class="display-4">Inventario de Medicamentos</h1>
</div>
@endsection

@section('Contenido')
<!--Mensaje de acciones-->
@if (session()->has('msj'))
<div class="alert alert-success" role="alert">
    {{session('msj')}}
</div>
@endif
<!--Recuadro de busqueda por nombre de medicamentos registrados-->
<div class="right " >
    {!! Form::open(['route' => 'index','method' =>'GET','class' =>'right ', 'role' =>'search'])!!}
    <div class="form-group">
        Nombre:
        {!! Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Nombre del medicamento']) !!}
    </div>
    <button type="submit" class="btn btn-default">Buscar</button>
    {!! Form::close() !!}
</div>
<!--Terminación del recuadro de busqueda de medicamentos-->

<!--Formulario de nuevo registro de medicamento:
Aquí se comienza con el formulario que va a realizar los nuevos registros de medicamentos que se deseen.-->
<!--Botón para formulario flotante-->
<button type="button" class="btn btn-amarillo btn-lg fas fa-pills" data-toggle="modal" data-target="#ventanaFlotante"> Nuevo Medicamento</button>
  <!-- Modal -->
  <div class="modal fade" id="ventanaFlotante" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title fas fa-pills"> Nuevo Medicamento</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
    <!--Form de nuevo registro-->
    <form method="POST" action="{{ route('addMedicamento')}}" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-12">
                    {!!$errors->first('nombre_medicamento','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="nombre_medicamento" placeholder="Nombre" value="{{old('nombre_medicamento')}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Cantidad</label>
                <div class="col-sm-12">
                    {!!$errors->first('cantidad','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="cantidad" placeholder="Cantidad" value="{{old('cantidad')}}">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info btn-block">Guardar</button>
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
<!--Terminación de Formulario de nuevo registro de medicamento->


<!--Registros de Medicamentos-->
<br><br>
@if ($registros->isEmpty())
<div class="alert alert-warning" role="alert">
    No hay registros
</div>
@else
<div class="box">
    <div class="box-body table-responsive no-padding">
        <table class="table">
            <tr class="encabezadoTR">
                <th>ID</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Operaciones</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($registros as $med)
            <tr>
                <td>{!! $med->id_medicamento!!}</td>
                <td>{!! $med->nombre_medicamento!!}</td>
                <td>{!! $med->cantidad!!}</td>
                <td><a href="{{ route('editM',$med->id_medicamento)}}" class="btn btn-success fas fa-pen"></a></td>
                <!--Ventana flotante para editar registro de medicamento -->

                <!--Terminación de ventana flotante para editar registro de medicamento -->

    <!--Terminación de Botones para descargas en EXCEL y PDF-->
                <td>
                    <form method="POST" action="{{ route('deleteM',$med->id_medicamento)}}">
                        {{method_field('DELETE')}}
                        @csrf
                        <input class="btn btn-danger" onclick="confirmDelete()" type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!--Script para mensajes de confirmación de eliminación-->
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


