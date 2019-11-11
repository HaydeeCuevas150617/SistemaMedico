@extends('layouts.login')
@section('titulo')
Inicio de Sesión
@endsection
@section('contenido')
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Inicio de Sesión</div>
        <div class="card-body">
            <!--Mensaje de Error-->
            @if(session()->has('msj'))
            <div class="alert alert-warning" role="alert">
                {{session('msj')}}
            </div>
            @endif
            <!--//-->
            <form method="POST" action="{{ route('inicioSesion')}}">
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
                    {!!$errors->first('password','<br><span class="help-block">:message</span>')!!}
                    <div class="form-label-group">
                        <input type="password" id="password" name="password" class="form-control"
                         placeholder="Contraseña" value="{{old('password')}}">
                        <label for="password">Contraseña</label>
                    </div>
                </div>

                <div class="form-group">
                    <div style="text-align:center;">
                        <button class="btn btn-primary btn-block">Iniciar Sesión</button><br>
                        <a href="{{ route('recuperarPassword')}}">¿Ha olvidado su contraseña?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
