<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon\Carbon;
use DateTime;
use App\Paciente;
use App\Exports\PacientesExport;
use Maatwebsite\Excel\Facades\Excel;

class bitacoraController extends Controller
{
    /*El siguiente  */
    public function indexBit(Request $request)
    {
        //dd($request->get('nombre'));//imprimir arreglo con el resultado que se está mandando como búsqueda
        //$hoy = Carbon::now();
        $registrosPacientes=DB::table('pacientes')
        ->join('carrera', 'carrera.id_carrera', '=', 'pacientes.area_id')
        ->join('afeccion', 'afeccion.id_afeccion', '=', 'pacientes.afeccion_id')
        ->select('pacientes.*', //Selecciona todos los atributos
        //Atributos de la tabla carrera
        'carrera.nombre_carrera',
        //Atributos de la tabla afeccion
        'afeccion.nombre_afeccion')        
        //->whereRaw('(TIMESTAMPDIFF(YEAR, pacientes.fecha_nac, pacientes.created_at))')
        /*BÚSCADORES */
        /*El siguiente WHRERE ayuda con la búsqueda de acuerdo a la matrícula deseada.*/
        ->where('pacientes.matricula', 'like', '%'.$request->matricula.'%')
        /*El siguiente WHRERE ayuda con la búsqueda de acuerdo a la fecha deseada.*/
        ->where('pacientes.created_at', 'like', '%'.$request->fecha.'%')
        ->orderBy('created_at','desc')
        ->get();
        //dd($registrosPacientes[0]);
        
        $registrosAfeccion=DB::table('afeccion')
        ->select('afeccion.id_afeccion','afeccion.nombre_afeccion')
        ->get();

        $registrosCarrera=DB::table('carrera')
        ->select('carrera.id_carrera','carrera.nombre_carrera')
        ->get();

        //$edades = $this->obtenerEdad($registrosPacientes);
        
        return view('bitacora',compact('registrosPacientes','registrosCarrera','registrosAfeccion'));
    }

    public function obtenerEdad($registrosPacientes){
        $start = new Carbon\Carbon('2014-01-05 12:00:00');
        $end = new Carbon\Carbon('2014-01-01 12:00:00');
        return $end->diffInDays($start);
    }
    /*Función para Añadir Paciente*/
    public function addPaciente(Request $request)
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
        return \Redirect::to('BitacoraDiaria')->with('msj','Paciente añadido correctamente'); 
    }

    public function mostrarDatosPaciente($id){
         //dd($id);
       $paciente=DB::table('pacientes')
       ->select('pacientes.*')
       ->where('id_paciente',$id) //Aquí hace la comparación del id que recibe con el de la base de datos
       ->get();

       $registrosAfeccion=DB::table('afeccion')
       ->select('afeccion.id_afeccion','afeccion.nombre_afeccion')
       ->get();

       $registrosCarrera=DB::table('carrera')
       ->select('carrera.id_carrera','carrera.nombre_carrera')
       ->get();
        return view('editarPaciente',compact('paciente','registrosAfeccion','registrosCarrera'));
    }
    
    public function updatePaciente(Request $request,$id)
    {
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
        $registroPaciente=Paciente::findOrFail($id);
        $registroPaciente->matricula=$request->matricula; 
        $registroPaciente->nombre=$request->nombre;
        $registroPaciente->fecha_nac=$request->fecha_nac;
        $registroPaciente->area_id=$request->area_id;
        $registroPaciente->diagnostico=$request->diagnostico; 
        $registroPaciente->user_id=$request->user_id;
        $registroPaciente->afeccion_id=$request->afeccion_id;
        $registroPaciente->envio_imss=$request->envio_imss;
        $registroPaciente->razon_ref=$request->razon_ref; 
        $registroPaciente->updateData('id_paciente',$id,$registroPaciente);
        return \Redirect::to('BitacoraDiaria')->with('msj','Se editó correctamente');

    }

    //Función para eliminar registro
    public function destroyPaciente($id)
    {
        $paciente=Paciente::findOrFail($id);

        $paciente->delete();
        $paciente->deleteData('id_paciente',$id,$paciente);
        return back()->with('msj','Paciente eliminado correctamente');
    }

    function download(Request $request){
       // dd($request->fecha_descarga);
       $year=substr($request->fecha_descarga,-10,4);
       $month=substr($request->fecha_descarga, -5,2);
       $day=substr($request->fecha_descarga, -2);
        //return Excel::download(new PacientesExport, 'bitacora.xlsx');
        return (new PacientesExport($year,$month,$day))->download('Bitacora'.$request->fecha_descarga.'.xlsx');
    }
}