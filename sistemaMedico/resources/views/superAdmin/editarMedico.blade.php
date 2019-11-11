@extends('layouts.app')
@section('titulo')
Editar Médico
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')
@endsection

@section('Contenido')
<div class="box box-info" id="nuevo">
    <div class="box-header with-border">
        <h3 class="box-title">Editar Médico</h3>
    </div>
    @if (isset($medico))
    @foreach ($medico as $registroMed)
    <form method="POST" action="{{ route('actualizarMedico',$registroMed->id)}}" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-12">
                    {!!$errors->first('nombre','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="nombre" value="{{ $registroMed->nombre }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-12">
                    {!!$errors->first('apellidos','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="apellido"  value="{{ $registroMed->apellido }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-12">
                    {!!$errors->first('email','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="email"  value="{{ $registroMed->email }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Contraseña</label>
                <div class="col-sm-12">
                    {!!$errors->first('password','<br><span class="help-block">:message</span>')!!}
                    <input type="password" class="form-control" name="password"  value="{{ $registroMed->password }}">
                </div>
            </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info btn-block">Guardar</button>
        </div>
    </form>
    @endforeach
    @endif
</div>
@endsection
