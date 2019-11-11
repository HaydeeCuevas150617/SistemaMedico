@extends('layouts.app')
@section('titulo')
Copias de Seguridad
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection

@section('Seccion')
<div class="left">
        <h3 class="display-4">Copias de Seguridad</h1>
</div>
@endsection

@section('Contenido')

<!--Mensaje de acciones-->
@if (session()->has('msj'))
<div class="alert alert-success" role="alert">
    {{session('msj')}}
</div>
@endif
    <br><br>
    <br><br>
    <br><br>
    <br><br>
<div class="todaPantalla">
    <button type="button" class="btn btn-amarillo btn-lg  fas fa-download" 
    data-toggle="modal" action="{{ route('descargarBD')}}"> Descargar Base de Datos</button>
    <br><br><br><br>
<button type="button" class=" btn btn-morado-gde btn-lg fas fa-upload" 
data-toggle="modal" data-target="#ventanaFlotante"> Restaurar Base de Datos</button>
</div>

@endsection

