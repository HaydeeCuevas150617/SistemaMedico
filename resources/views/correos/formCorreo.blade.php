@extends('layouts.login')
@section('titulo')
Recuperar Contraseña
@endsection
@section('contenido')
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Recuperar Contraseña</div>
        <div class="card-body">
            <form method="POST" action="{{ route('cambiarPass')}}" >
                @csrf
                <!--Email-->
                <div class="form-group">
                    {!!$errors->first('email','<br><span class="help-block">:message</span>')!!}
                    <div class="form-label-group">
                        <input type="email" id="email" name="email" class="form-control" 
                        placeholder="Dirección de correo electrónico" autofocus="autofocus"
                        value="{{old('email')}}">
                        <label for="email">Dirección de correo electrónico</label>
                    </div>
                </div>
                <div class="form-group">
                    <div style="text-align:center;">
                        <button class="btn btn-primary btn-block">Cambiar Contraseña</button><br>
                    </div>
                    <a href="javascript:history.back()" class="fas fa-arrow-circle-left right" style="font-size: 200%"></a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
