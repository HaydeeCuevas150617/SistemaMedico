@extends('layouts.app')
@section('titulo')
Bitácora Diaria
@endsection
@section('nombre')
Bienvenido {{auth()->user()->name}}
@endsection

@section('Seccion')
<div class="left">
        <h3 class="display-4">Administradores</h1>
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
            <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">
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
        
    </div><!--Terminación Div box-body table-responsive no-padding-->
    <!-- /.box-body -->
</div><!--Terminación Div Class Box-->

@endsection