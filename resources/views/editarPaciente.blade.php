@extends('layouts.app')
@section('titulo')
Editar Registro de Paciente
@endsection
@section('nombre')
Bienvenido {{auth()->user()->name}}
@endsection

@section('Seccion')
<h1 class="display-4">Editar Registro de Paciente</h1>
@endsection

@section('Contenido')
<div class="box box-info" id="nuevo">
    <div class="box-header with-border">
            <a href="javascript:history.back()" class="fas fa-arrow-circle-left right" style="font-size: 200%"></a>
        <h3 class="box-title">Editar Registro de Paciente</h3>
    </div>
    @if (isset($paciente))
    @foreach ($paciente as $registroPaciente)
<form method="POST" action="{{route('actualizarPaciente',$registroPaciente->id_paciente)}}" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <label class="col-sm-2 control-label"><b>Matrícula</b></label>
        <div class="col-sm-12">
            {!!$errors->first('matricula','<br><span class="help-block">:message</span>')!!}
            <input type="text" class="form-control" name="matricula" placeholder="Matrícula"
                value="{{$registroPaciente->matricula}}" maxlength="10" size="10">
        </div>
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-12">
                    {!!$errors->first('nombre','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="nombre" value="{{ $registroPaciente->nombre }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Fecha de Nacimiento</label>
                <div class="col-sm-12">
                    {!!$errors->first('fecha_nac','<br><span class="help-block">:message</span>')!!}
                    <input type="date" class="form-control" name="fecha_nac" value="{{ $registroPaciente->fecha_nac }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><b>Área</b></label>
                <div class="col-sm-12">
                    <!--El siguiente <select> ocupa la variable $registrosCarrera la cual se encuentra en
                        bitacoraController la cual realiza una consulta a la BD para extraer los registros
                        que se encuentran en la tabla.-->
                    <select  class="form-control" name="area_id">
                        @foreach($registrosCarrera as $carrera)
                        <option  value="{!!$carrera->id_carrera!!}"> {!! $carrera->id_carrera!!} .- {!! $carrera->nombre_carrera!!} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><b>Diagnóstico</b></label>
                <div class="col-sm-12">
                    {!!$errors->first('diagnostico','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="diagnostico" placeholder="diagnostico"
                    value="{{ $registroPaciente->diagnostico }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><b>Afección</b></label>
                <div class="col-sm-12">
                    <!--El siguiente <select> ocupa la variable $registrosCarrera la cual se encuentra en
                        bitacoraController la cual realiza una consulta a la BD para extraer los registros
                        que se encuentran en la tabla.-->
                    <select  class="form-control" name="afeccion_id">
                        @foreach($registrosAfeccion as $afeccion)
                        <option value="{!!$afeccion->id_afeccion!!}"> {!! $afeccion->id_afeccion!!} .- {!! $afeccion->nombre_afeccion!!} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--Ingresar si se envió al IMSS al paciente -->
            <div class="form-group">
                    <label class="col-sm-4 control-label"><b>Envío a IMSS</b></label>
                    <div class="col-sm-12">
                        {!!$errors->first('envio_imss','<br><span class="help-block">:message</span>')!!}
                        <input type="text" class="form-control" name="envio_imss" placeholder="Envío a imss"
                        value="{{ $registroPaciente->envio_imss }}">
                    </div>
            </div>
            <!--Ingresar Razón de la Referencia -->
            <div class="form-group">
                <!--Etiqueta de Razón de Referencia -->
                    <label class="col-sm-6 control-label"><b>Razón de Referencia</b></label>
                <div class="col-sm-12">
                    {!!$errors->first('razon_ref','<br><span class="help-block">:message</span>')!!}
                    <input type="text" class="form-control" name="razon_ref" placeholder="Razón de Referencia"
                    value="{{ $registroPaciente->razon_ref }}">
                </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-2 control-label"><b>Usuario</b></label>
                    <div class="col-sm-12">
                        {!!$errors->first('user_id','<br><span class="help-block">:message</span>')!!}
                        <input type="text"  readonly class="form-control" name="user_id" value="{{auth()->user()->id}}">
                    </div>
                </div>
        <div class="box-footer">
            <button type="submit" onclick="confirmEdicion()" class="btn btn-info btn-block">Guardar</button>
        </div>
    </form>
    @endforeach
    @endif
</div>
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
@endsection
