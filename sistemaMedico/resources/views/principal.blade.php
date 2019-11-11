@extends('layouts.app')
@section('titulo')
Inicio
@endsection
@section('nombre')
Bienvenido {{auth()->user()->nombre}}
@endsection
@section('Seccion')

@endsection
