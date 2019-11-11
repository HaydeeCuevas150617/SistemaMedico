<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon\Carbon;
use DateTime;
use App\Paciente;
class ConsultasMensualesController extends Controller
{
    public function indexCMensuales(Request $request)
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
        /*BÚSCADOR */
        /*El siguiente WHRERE ayuda con la búsqueda de acuerdo a la fecha deseada.*/
        ->where('pacientes.created_at', 'like', '%'.$request->fecha.'%')
        ->orderBy('created_at','desc')
        ->get();
        //dd($registrosPacientes[0]->nombre);
        
        $registrosAfeccion=DB::table('afeccion')
        ->select('afeccion.id_afeccion','afeccion.nombre_afeccion')
        ->get();

        $registrosCarrera=DB::table('carrera')
        ->select('carrera.id_carrera','carrera.nombre_carrera')
        ->get();
        //dd($request->fecha);
        return view('controlConsultas.consultasMensuales',
        compact('registrosPacientes','registrosCarrera','registrosAfeccion','request'));
    }

    public function tablaMensual($mes)
    {
        //dd($mes);
        $registrosCarrera=DB::table('carrera')
        ->select('carrera.id_carrera','carrera.nombre_carrera')
        ->get();  

        $conteos = $this->conteos($mes,1);
        //dd($conteos[0]);
        return view('controlConsultas.graficasMensuales',
        compact('registrosCarrera','conteos','mes'));
    }

    public static function conteos($mes,$id){
        $registrosLAG=DB::table('pacientes')
        ->select('pacientes.*') //Selecciona todos los atributos
        ->where('area_id', '=', $id)
        ->where('created_at', 'LIKE', '%'.$mes.'%')
        ->select(DB::raw('count(*) as LAG'))
        /*SELECT COUNT(*)
        FROM pacientes
        WHERE area_id = 1;*/ 
        ->get();
        return $registrosLAG;
    }


    public function indexCAnuales(Request $request)
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
        /*BÚSCADOR */
        /*El siguiente WHRERE ayuda con la búsqueda de acuerdo a la fecha deseada.*/
        ->where('pacientes.created_at', 'like', '%'.$request->fecha.'%')
        ->orderBy('created_at','desc')
        ->get();
        //dd($registrosPacientes[0]->nombre);
        
        $registrosAfeccion=DB::table('afeccion')
        ->select('afeccion.id_afeccion','afeccion.nombre_afeccion')
        ->get();

        $registrosCarrera=DB::table('carrera')
        ->select('carrera.id_carrera','carrera.nombre_carrera')
        ->get();
        
        return view('controlConsultas.consultasAnuales',
        compact('registrosPacientes','registrosCarrera','registrosAfeccion'));
    }
    
}
