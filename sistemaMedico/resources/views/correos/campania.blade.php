@extends('layouts.app')
@section('titulo')
Campañas Electrónicas
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')

<div class="left">
    <h3 class="display-4">Enviar Campañas Electrónicas</h1>
</div>
<br><br><br><br>
@endsection

@section('Contenido')
<!--Mensaje de acciones-->
@if (session()->has('msj'))
<div class="alert alert-success" role="alert">
    {{session('msj')}}
</div>
@endif
<div class="box precarga">
<form method="POST" action="{{route('enviarCampania')}}" class="form-horizontal" enctype="multipart/form-data"> <!--Para determinar el tipo de información-->
    {{csrf_field ()}}
        <div class="box-body">
        <div class="form-group">

                <label class="col-sm-2 control-label"><b>Email:</b></label>
                <div class="col-sm-12">
                    {!!$errors->first('email','<br><span class="help-block">:message</span>')!!}
                    <input type="email" class="form-control" name="email" placeholder="Email"
                        value="{{old('email')}}">
                </div>
    
                <br>
            <label class="col-sm-2 control-label"><b>Asunto:</b></label>
            <div class="col-sm-12">
                {!!$errors->first('asunto','<br><span class="help-block">:message</span>')!!}
                <input type="text" class="form-control" name="asunto" placeholder="Asunto"
                    value="{{old('asunto')}}">
            </div>
            
            <br>

            <label class="col-sm-2 control-label"><b>Descripcion:</b></label>
            <div class="col-sm-12">
                {!!$errors->first('descripcion','<br><span class="help-block">:message</span>')!!}
                <textarea  class="form-control" name="descripcion" placeholder="descripcion"
                    value="{{old('descripcion')}}"></textarea>
            </div>          

            <br>
            <label class="col-sm-2 control-label"><b>Imagen:</b></label>
            <div class="col-sm-12">
                {!!$errors->first('descripcion','<br><span class="help-block">:message</span>')!!}
                <input type="file" class="form-control-file" name="archivo">
            </div>   
            <br>
            <div class="form-group">
                <label class="col-sm-2 control-label"><b>Usuario</b></label>
                <div class="col-sm-12">
                    {!!$errors->first('user_id','<br><span class="help-block">:message</span>')!!}
                    <input type="text"  readonly class="form-control" name="user_id" value="{{auth()->user()->nombre}} {{auth()->user()->apellido}}">
                </div>
            </div>


            <div class="box-footer">
                <button type="submit" class="btn btn-morado">Enviar</button>
            </div>
        </div>
    </div>
</form>
</div>
@endsection