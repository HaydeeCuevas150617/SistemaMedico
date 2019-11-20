<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Paciente; //La planificador_fam es un paciente
use App\Planificador_fam; //Modelo de la planificador_fam
use App\Exports\PlanificadoresExport;

class PlanificadoresController extends Controller
{
    public function indexPlanificadores(Request $request)
    {
       
       //dd($request->get('nombre'));//imprimir arreglo con el resultado que se está mandando como búsqueda
       $registrosPlanificador=DB::table('pacientes')
       ->join('carrera', 'carrera.id_carrera', '=', 'pacientes.area_id')
       ->join('afeccion', 'afeccion.id_afeccion', '=', 'pacientes.afeccion_id')
       ->select('pacientes.*', //Selecciona todos los atributos
       //Atributos de la tabla carrera
       'carrera.nombre_carrera',
       //Atributos de la tabla afeccion
       'afeccion.nombre_afeccion')        
       ->where('afeccion.nombre_afeccion', 'like', '%Planifica%')
       /*BÚSCADORES */
        /*El siguiente WHRERE ayuda con la búsqueda de acuerdo a la matrícula deseada.*/
        ->where('pacientes.matricula', 'like', '%'.$request->matricula.'%')
        /*El siguiente WHRERE ayuda con la búsqueda de acuerdo a la fecha deseada.*/
        ->where('pacientes.created_at', 'like', '%'.$request->fecha.'%')

        ->orderBy('created_at','desc')
        ->get();

        $registrosAfecciones=DB::table('afeccion')
        ->select('afeccion.*')
        ->get();

        $registrosCarrera=DB::table('carrera')
        ->select('carrera.id_carrera','carrera.nombre_carrera')
        ->get();
        

        return view('controlPlanificacion.planificacionFamiliar',
        compact('registrosPlanificador','registrosAfecciones','registrosCarrera'));
    }
    

    public function addPlanificador(Request $request)
    {
        /*Requiest()->validate([]) permite realizar las validaciones 
        de los campos que son requeridos. */
        //dd($request);
        request()->validate([
            'matricula'=>'required',
            'nombre'=>'required',
            'fecha_nac'=>'required',
            'area_id'=>'required',
            'diagnostico'=>'required',
            'user_id'=>'required',
            'afeccion_id'=>'required',
            'envio_imss'=>'required'
        ]);
        //Datos del paciente enviados desde la vista
        //dd($request);
        $registro=new Paciente(); //Nuevo objeto de la clase Paciente.
        $registro->matricula=Input::get('matricula'); 
        $registro->nombre=Input::get('nombre');
        $registro->fecha_nac=Input::get('fecha_nac');
        $registro->area_id=Input::get('area_id'); //Se extrajó de la tabla Carreras en la vista.
        $registro->diagnostico=Input::get('diagnostico'); //Texto que ingresa el médico.
        $registro->user_id=Input::get('user_id'); //Id el usuario que realizó el registro.
        $registro->afeccion_id=Input::get('afeccion_id'); //Id de la afección
        $registro->envio_imss=Input::get('envio_imss');
        $registro->razon_ref=Input::get('razon_ref'); 
        $registro->save(); //Guardar información en la base de datos.
        /*Redirigir a la página deseada, en este caso es la bitácora diaria,
        con un mensaje de la correcta inserción. */
        return \Redirect::to('PlanificacionFamiliar')->with('msj','Registro añadido correctamente');
    }

    public function showDatos($id)
    {
        //dd($id);
        $datos=DB::table('planificador_fam') 
        ->join('pacientes', 'pacientes.id_paciente', '=', 'planificador_fam.paciente_id')        
        ->select( 'planificador_fam.*','pacientes.*') 
        ->where('planificador_fam.paciente_id', '=', $id)    
        ->get();

        $registroDatosExtra=DB::table('planificador_fam')
        ->select('planificador_fam.*')
        ->where('planificador_fam.paciente_id', '=', $id) 
        ->get();

        $correo = $this->buscarPaciente($id);

        return view('controlPlanificacion.datosPlanificacion',
        compact('datos','id','registroDatosExtra','correo'));
    }
    public function buscarPaciente($id){
        $correo=Paciente::findOrFail($id);
        $correo=$correo->matricula;
       return $correo;
    }
    public function addDatos(){
        $datosExtra = new Planificador_fam();
        $datosExtra->paciente_id=Input::get('paciente_id'); 
        $datosExtra->nss=Input::get('nss'); 
        $datosExtra->tipo_metodo=Input::get('tipo_metodo'); 
        $datosExtra->correo=Input::get('correo'); 
        $datosExtra->estado=Input::get('estado'); 
        $datosExtra->f_aplicacion=Input::get('f_aplicacion');
        $datosExtra->save();
        return \Redirect::to('PlanificacionFamiliar')->with('msj','Datos añadidos correctamente');
    }

    function downloadExcel(Request $request){
          //dd($request->fecha);
          $year=substr($request->fecha,0,4);
          $month=substr($request->fecha, -2);
          return (new PlanificadoresExport($year,$month))
          ->download('Relación planificación familiar'.$request->fecha.'.xlsx');
    }

    function downloadPDF(Request $request){
        //dd($request->fecha);
        $year=substr($request->fecha,0,4);
        $month=substr($request->fecha, -2);
        return (new PlanificadoresExport($year,$month))
        ->download('Relación planificación familiar'.$request->fecha.'.pdf');
  }

}
