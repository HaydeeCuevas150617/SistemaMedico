<?php
//use Maatwebsite\Excel\Facades\Excel; //opc1
use App\Exports\UsersExport;
use App\Exports\PacientesExport;
use App\Exports\MedicamentosExport;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarPassword; 
use App\Console\Commands;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Test para comprobar si funciona la libreria de PDF's 
Route::get('/',function(){
    return view('bitacora');

    $pdf-> loadView('bitacora');
    return $pdf -> download();
});
*/


/*
Route::get('',function(){
    //$usersExport = new UsersExport; //opc2
    //return $usersExport->download('usuarios.xlsx'); //opc2

    return (new PacientesExport(1997))->forDate(request('date'))->download('pacientes'.$request.'.xlsx');
   // return Excel::download(new UsersExport, 'usuarios.xlsx'); //opc1
});*/


//Ruta que muestra el formulario Login al entrar
Route::get('/','Auth\LoginController@ShowLoginForm')->name('/');

//Ruta hacia login
Route::post('inicioSesion','Auth\LoginController@login')->name('inicioSesion');
Route::post('logout','Auth\LoginController@logout')->name('logout');
//Ruta hacia login
Route::get('obtenerEmail','Auth\LoginController@obtEmail')->name('obtenerEmail');

//Ruta para las rutas que se han creado de AUTH
Auth::routes();
Route::get('/home', 'bitacoraController@indexBit')->name('home');


/*CRUD DE PACIENTES */
//Ver Pacientes enlistados 
Route::get('BitacoraDiaria/{pacientes?}','bitacoraController@indexBit')->name('indexB');
//Redirect::to('auth.login');
//Agregar Registro en la Bitacora
Route::post('addP','bitacoraController@addPaciente')->name('addP');
//Mostrar datos de paciente en el formulario de edición
Route::get('editarPaciente/{id}','bitacoraController@mostrarDatosPaciente')->name('mostrarDatos');;//Muestra los datos en la pantalla
Route::put('actualizarPaciente/{id}','bitacoraController@updatePaciente')->name('actualizarPaciente');
//Eliminar Paciente
Route::delete('deletePaciente/{id}','bitacoraController@destroyPaciente')->name('deletePaciente');
//Mostrar tratamiento
Route::get('mostrarTratamiento/{id}','TratamientoController@showTratamiento')->name('showTratamiento');
Route::post('addTratamiento','TratamientoController@addTrat')->name('addTratamiento');

/*FIN DE CRUD DE PACIENTES */


/*CRUD DE MEDICAMENTOS */
//Mostrar a todos los registros de Medicamentos de la BD
Route::get('InventarioDeMedicamentos/{medicamentos?}','verMedicamentosController@index')->name('index');
//Agregar Medicamento
Route::post('addMedicamento','verMedicamentosController@addM')->name('addMedicamento');
//Eliminar Medicamento
Route::delete('deleteM/{id}','verMedicamentosController@destroyM')->name('deleteM');
//Editar Medicamento
Route::get('editM/{id}','verMedicamentosController@showM')->name('editM');
Route::put('updateMed/{id}','verMedicamentosController@update')->name('updateMed');
/*FIN DE CRUD DE MEDICAMENTOS */


/*CRUD DE USUARIOS */
//Mostrar a todos los registros de Médicos de la BD
Route::get('indexMedicos','UsuarioController@indexMedicos')->name('indexMedicos');
//Agregar Usuario
Route::post('addMedico','UsuarioController@addMedico')->name('addMedico');
Route::resource('usuario', 'UsuarioController');
//Eliminar Usuario
Route::delete('eliminarMedico/{id}','UsuarioController@eliminarMedico')->name('eliminarMedico');
//Editar Médico
Route::get('editarMedico/{id}','UsuarioController@mostrarDatosMedico')->name('editarMedico');//Muestra los datos en la pantalla
Route::put('actualizarMedico/{id}','UsuarioController@actualizar')->name('actualizarMedico');//Envia los datos para actualizar
/* FIN DE CRUD DE USUARIOS */


/*CRUD DE CONTROL DE EMBARAZADAS */
//Index de embarazadas
Route::get('indexEmbarazadas','EmbarazadasController@indexEmb')->name('indexEmbarazadas');
//Agregar Embarazada-Paciente
Route::post('addEmbarazada','EmbarazadasController@addEmbarazada')->name('addEmbarazada');
//Agregar datos de embarazo
Route::post('agregarDatosEmbarazada','EmbarazadasController@addDatosEmbarazo')->name('addDatosEmbarazada');
//mostrar datos de embarazo
Route::get('mostrarDatosExtra/{id}','EmbarazadasController@showDatos')->name('showDatosExtra');
/*FIN DE CRUD DE CONTROL DE EMBARAZADAS */

/*CRUD DE PLANIFICACIÓN FAMILIAR */
//Index de Planificación Familiar
Route::get('PlanificacionFamiliar','PlanificadoresController@indexPlanificadores')->name('indexPlanificacion');
//Agregar Planificador Familiar-Paciente
Route::post('añadirPlanificaciónFamiliar','PlanificadoresController@addPlanificador')->name('addPlanificador');
//mostrar datos de planificación familiar
Route::get('mostrarDatosDePlanificacion/{id}','PlanificadoresController@showDatos')->name('showDatosPlanificacion');
//Agregar datos de Planificación Familiar
Route::post('agregarDatosDePlanificacionFamiliar','PlanificadoresController@addDatos')->name('addDatosPlanificador');
/*FIN DE CRUD DE PLANIFICACIÓN FAMILIAR */

/*CRUD DE CONTROL DE ACCIDENTES */
//Index de Accidentado
Route::get('ControlDeAccidentes','AccidentadosController@indexAccidentes')->name('indexAccidentados');
//Agregar Accidentado-Paciente
Route::post('añadirAccidentado','AccidentadosController@addAccidentado')->name('addAccidentado');
//mostrar datos de planificación familiar
Route::get('mostrarDatosDeAccidente/{id}','AccidentadosController@showDatos')->name('showDatosAccidente');
//Agregar datos de Planificación Familiar
Route::post('agregarDatosDeAccidente','AccidentadosController@addDatosAccidente')->name('addDatosAccidente');
/*FIN DE CRUD DE CONTROL DE ACCIDENTES */


/*CRUD DE CONSULTAS MENSUALES Y ANUALES */
//Index de consultas mensuales
Route::get('ConsultasMensuales','ConsultasMensualesController@indexCMensuales')->name('indexMensuales');
//Gráficas de consultas mensuales
Route::get('GraficasMensuales/{mes}', 'ConsultasMensualesController@tablaMensual')->name('mostrarGraficasMensuales');
//Index de consultas anuales
Route::get('ConsultasAnuales','ConsultasMensualesController@indexCAnuales')->name('indexAnuales');

/*FIN DE CRUD DE CONSULTAS MENSUALES Y ANUALES*/

/*CARRERAS*/
//index carreras
Route::get('indexCarreras','CarreraController@indexCa')->name('indexCarreras');
/*FIN DE CARRERAS*/

/*NOTAS*/
//Agregar Nota
Route::post('addNota','NotasController@addNota')->name('addNota');
//Index de Notas
Route::get('indexNotas','NotasController@indexNotas')->name('indexNotas');
//Eliminar Nota
Route::delete('eliminarNota/{id}','NotasController@eliminarNota')->name('eliminarNota');
Route::get('editarNota/{id}','NotasController@showNota')->name('editarNota');
Route::put('actualizarNota/{id}','NotasController@updateNota')->name('actualizarNota');
/*FIN DE NOTAS*/

/*BACKUP -> Copia de Seguridad*/
Route::view('/backup', 'backup')->name('indexBackup');
Route::get('descargarBD','App\Console\Commands\BackupBaseDatos@handle')->name('descargarBD');

/*FIN DE BACKUP*/


/*Reestablecer Contraseña*/
Route::view('recuperarContraseña', 'correos.formCorreo')->name('recuperarPassword');
Route::post('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('cambiarPass');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset');

/*FIN DE Reestablecer Contraseña*/


/*Envio de campañas electónicas*/
Route::view('/EnviarCampanias', 'correos.campania')->name('enviarCampanias');
Route::post('/EnviarCampania', 'CampaniaController@enviarCorreo')->name('enviarCampania');
/*FIN DE Envio de campañas electónicas*/


Route::get('/excel',function(MedicamentosExport $usersExport){
    $usersExport = new MedicamentosExport; //opc2
    return $usersExport->download('ListaDeMedicamentos.xlsx'); //opc2

    //return (new MedicamentosExport)->download('ListaDeMedicamentos.xlsx');
   //return Excel::download(new MedicamentosExport, 'ListaDeMedicamentos.xlsx'); //opc1
});

Route::get('/usuarios',function(UsersExport $usersExport){
    //$usersExport = new UsersExport; //opc2
    //return $usersExport->download('usuarios.xlsx'); //opc2

    //return (new UsersExport)->download('usuarios.pdf');
   return Excel::download(new UsersExport, 'usuarios.xlsx'); //opc1
});

Route::get('descargarBitacora', 'bitacoraController@download')->name('descargarBitacora');
