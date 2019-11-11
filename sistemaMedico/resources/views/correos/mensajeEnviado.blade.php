<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$msj['asunto']}}</title>
</head>
<body>
<p>Recibiste un mensaje de  {{$msj['email']}}</p> <!--Aquí dice que recibio un mensaje
de y el correo electronico que es del sistema-->
@if($msj['descripcion'] == NULL)<!--Si el mensaje no contiene descripción, entonces no 
muestra nada y si tiene contenido, entonces lo muestra.-->
@else
<p><strong>Descripción:</strong>{{$msj['descripcion']}}</p><!--Aquí escribe la descripción que
    el usuario manda o no -->
@endif
</body>
</html>