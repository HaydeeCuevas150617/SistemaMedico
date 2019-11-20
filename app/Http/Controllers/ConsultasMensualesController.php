<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon\Carbon;
use DateTime;
use App\Paciente;
use App\Exports\ConsultasMensualesExport;
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
        $fecha = $request->fecha;
        $registrosCarrera=DB::table('carrera')
        ->select('carrera.id_carrera','carrera.nombre_carrera')
        ->get();
        //dd($request->fecha);
        return view('controlConsultas.consultasMensuales',
        compact('registrosPacientes','registrosCarrera','registrosAfeccion','fecha'));
    }

    public function tablaMensual(Request $mes)
    {
       // dd($mes->fecha2);
        $registrosCarrera=DB::table('carrera')
        ->select('carrera.id_carrera','carrera.nombre_carrera')
        ->get();  
        //dd( $registrosCarrera);
        $LAG = $this->conteos($mes,1);
        //dd($LAG[0]->conteos);
        $IBT = $this->conteos($mes,2);
        $ITA = $this->conteos($mes,3);
        $IIN = $this->conteos($mes,4);
        $IIF = $this->conteos($mes,5);
        $IFI = $this->conteos($mes,6);
        $IET = $this->conteos($mes,7);
        $OTROS = $this->conteos($mes,8);

        // dd($mes->fecha2);
        $registrosAfeccion=DB::table('afeccion')
        ->select('afeccion.id_afeccion','afeccion.nombre_afeccion')
        ->get();  
        $Respiratorias = $this->conteosAfeccion($mes,1);
        $Digestivas = $this->conteosAfeccion($mes,2);
        $Osteo = $this->conteosAfeccion($mes,3);
        $Cardio = $this->conteosAfeccion($mes,4);
        $Genito = $this->conteosAfeccion($mes,5);
        $Dermo = $this->conteosAfeccion($mes,6);
        $Ofta = $this->conteosAfeccion($mes,7);
        $Neuro = $this->conteosAfeccion($mes,8);
        $Gineco = $this->conteosAfeccion($mes,9);
        $Curacion = $this->conteosAfeccion($mes,10);
        $P_fam = $this->conteosAfeccion($mes,11);
        $Ap_med = $this->conteosAfeccion($mes,12);
        $PresionArterial = $this->conteosAfeccion($mes,13);
        $Campania_mensual = $this->conteosAfeccion($mes,14);
        $OtrosAfeccion = $this->conteosAfeccion($mes,15);
        //dd($conteos[0]);
        return view('controlConsultas.graficasMensuales',
        compact('registrosCarrera','LAG','IBT','ITA','IIN','IIF',
        'IFI','IET','OTROS',
        'registrosAfeccion','Respiratorias','Digestivas','Osteo','Cardio','Genito','Dermo','Ofta','Neuro',
        'Gineco','Curacion','P_fam','Ap_med','PresionArterial','Campania_mensual','OtrosAfeccion','mes'));
    }
/*Realiza los conteos de los pacientes de acuerdo al área, recibe el mes y año del cual debe realizar las busquedas
y el id de el área para realizar el conteo*/
    public static function conteos($mes,$id){
        $registrosLAG=DB::table('pacientes')
        ->select('pacientes.*') //Selecciona todos los atributos
        ->where('area_id', '=', $id)
        ->where('created_at', 'LIKE', '%'.$mes->fecha2.'%')
        ->select(DB::raw('count(*) as conteos'))
        ->get();
       //dd($registrosLAG);
        return $registrosLAG;
    }
/*Realiza los conteos de los pacientes de acuerdo a la afección, recibe el mes y año del cual debe realizar las busquedas
y el id de la afección para realizar el conteo*/
    public static function conteosAfeccion($mes,$id){
        $registrosLAG=DB::table('pacientes')
        ->select('pacientes.*') //Selecciona todos los atributos
        ->where('afeccion_id', '=', $id)
        ->where('created_at', 'LIKE', '%'.$mes->fecha2.'%')
        ->select(DB::raw('count(*) as conteos'))
        ->get();
       //dd($registrosLAG);
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

    function downloadExcel(Request $request){
        //dd($request->fecha_descarga);
        $year=substr($request->fecha_descarga,0,4);
        $month=substr($request->fecha_descarga, -2);
        return(new ConsultasMensualesExport($year,$month))
        ->download('CONSULTAS-'.$request->fecha_descarga.'.xlsx');
  }
}
