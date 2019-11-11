<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('titulo')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--Font Awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- Ionicons -->
  <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link href="{{ URL::asset('css/AdminLTE.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ URL::asset('css/skin-blue.css') }}" rel="stylesheet" type="text/css" media="all" />
  <!--Script para jquery-->
  <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">
    <!--Logo-->
    <a href="{{ route('/') }}" class="logo">
        Sistema Médico UPEMOR
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand"href="">@yield('nombre')</a>
            <button class="navbar-toggler" type="button" data-toggle="push-menu" role="button" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!--Si el usuario es del rol_id = 1 (Super Administrador) entonces muestra lo siguiente.
        Pero unicamente si es de tipo 1. -->
        
        <li class="header">MÓDULO SUPER-ADMIN</li>
        <!--Modulos Super Administrador-->
        <li class="{{request()->routeIs('indexMedicos')? 'active' : ''}}"><a href="{{ route('indexMedicos') }}"><i class=" fas fa-user-md"></i> <span> Médicos</span></a></li>
        <!--<li><a href=""><i class="fas fa-user-cog"></i> <span> Perfil Super-Admin</span></a></li>-->
        
        <!--Si el usuario es Doctor o Super Adminsitrador entonces muestra lo siguiente.
        El Super Administrador puede ver ambos Menús ya que tiene control de todo en el sistema.-->
       
        <li class="header">MÓDULOS DE MÉDICOS</li>
        <!--Modulos de los MÉDICOS y Super Administrador-->
        
        <li class="{{request()->routeIs('indexB')? 'active' : ''}}"><a href="{{ route('indexB') }}"><i class="fas fa-laptop-medical"></i> <span> Bitácora</span></a></li>
        <li class="{{request()->routeIs('indexEmbarazadas')? 'active' : ''}}"><a href="{{ route('indexEmbarazadas') }}"><i class="fas fa-baby-carriage"></i> <span> Control de Embarazadas</span></a></li>
        <li class="{{request()->routeIs('indexPlanificacion')? 'active' : ''}}"><a href="{{ route('indexPlanificacion') }}"><i class="fas fa-pills"></i> <span> Planificación Familiar</span></a></li>
        <li class="{{request()->routeIs('indexAccidentados')? 'active' : ''}}"><a href="{{ route('indexAccidentados') }}"><i class="fas fa-briefcase-medical"></i> <span> Control de Accidentes</span></a></li>
        <li class="{{request()->routeIs('indexMensuales')? 'active' : ''}}"><a href="{{ route('indexMensuales') }}"><i class="fas fa-chart-pie"></i> <span> Consultas Mensuales</span></a></li>
        <li class="{{request()->routeIs('indexAnuales')? 'active' : ''}}"><a href="{{ route('indexAnuales') }}"><i class="fas fa-chart-bar"></i> <span> Consultas Anuales</span></a></li>
        <li><a href=""><i class="fas fa-book-medical"></i> <span> Historiales</span></a></li>
        <li class="{{request()->routeIs('indexBackup')? 'active' : ''}}"><a href="{{ route('indexBackup') }}"><i class="fas fa-save"></i> <span> Copia de Seguridad</span></a></li>
        <li class="{{request()->routeIs('indexNotas')? 'active' : ''}}"><a href="{{ route('indexNotas') }}"><i class="fas fa-sticky-note"></i> <span> Recordatorios</span></a></li>
        <li class="{{request()->routeIs('index')? 'active' : ''}}"><a href="{{ route('index') }}"><i class="fas fa-prescription-bottle-alt"></i> <span> Inventario</span></a></li>
        <li class="{{request()->routeIs('enviarCampanias')? 'active' : ''}}"><a href="{{ route('enviarCampanias') }}"><i class="fas fa-paper-plane"></i> <span> Campañas</span></a></li>
        
        <!--///////-->
        <li>
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button class="btn bt-fill btn-block btn-danger"><i class="fas fa-sign-out-alt"></i><span>Cerrar Sesión</span></button>
        |    </form>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @yield('Seccion')
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        @yield('Contenido')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Alexa Haydee Talamantes Cuevas
    </div>
    <!-- Default to the left -->
    <strong>UPEMOR &copy; 2019 </strong> Derechos Reservados.
  </footer>

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.10/js/adminlte.min.js"></script>

</body>
</html>
