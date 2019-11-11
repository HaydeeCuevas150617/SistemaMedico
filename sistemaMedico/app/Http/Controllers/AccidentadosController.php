<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Paciente; 
use App\Accidentado; //Modelo de la embarazada
use Carbon\Carbon;


class AccidentadosController extends Controller
{
    public function indexAccidentes(Request $request)
    {
       
       //dd($request->get('nombre'));//imprimir arreglo con el resultado que se está mandando como búsqueda
       $registrosAccidentados=DB::table('pacientes')
       ->join('carrera', 'carrera.id_carrera', '=', 'pacientes.area_id')
       ->join('afeccion', 'afeccion.id_afeccion', '=', 'pacientes.afeccion_id')
       ->select('pacientes.*', //Selecciona todos los atributos
       //Atributos de la tabla carrera
       'carrera.nombre_carrera',
       //Atributos de la tabla afeccion
       'afeccion.nombre_afeccion')        
       ->where('afeccion.nombre_afeccion', 'like', '%Cura%')
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

        return view('controlAccidentes.controlAccidentados',
        compact('registrosAccidentados','registrosAfecciones','registrosCarrera'));
    }

    public function addAccidentado(Request $request)
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
        return \Redirect::to('ControlDeAccidentes')->with('msj','Registro añadido correctamente');
    }
    
    //Mostrar los datos del accidente
    public function showDatos($id)
    {
        //dd($id);
        $datos=DB::table('accidentado') 
        ->join('pacientes', 'pacientes.id_paciente', '=', 'accidentado.paciente_id')        
        ->select( 'accidentado.*','pacientes.*') 
        ->where('accidentado.paciente_id', '=', $id)    
        ->get();

        $registroDatosExtra=DB::table('accidentado')
        ->select('accidentado.*')
        ->where('accidentado.paciente_id', '=', $id) 
        ->get();

        return view('controlAccidentes.datosAccidente',
        compact('datos','id','registroDatosExtra'));
    }

    public function addDatosAccidente(){
        //dd($datosExtra);
        $datosExtra = new Accidentado();
        $datosExtra->paciente_id=Input::get('paciente_id'); 
        $datosExtra->area_accidente=Input::get('area_accidente'); 
        $datosExtra->region_afectada=Input::get('region_afectada'); 
        $datosExtra->tipo_lesion=Input::get('tipo_lesion'); 
        $datosExtra->causa_lesion=Input::get('causa_lesion'); 
        $datosExtra->lugar_accidente=Input::get('lugar_accidente');
        $datosExtra->observaciones_accidente=Input::get('observaciones_accidente');
        $datosExtra->save();
        return back()->with('msj','Registro añadido correctamente');
    }
}
