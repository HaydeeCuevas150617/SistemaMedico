<?php

namespace App\Exports;
use App\paciente;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
//use Maatwebsite\Excel\Concerns\WithHeadings;//Le agrega titulos de cabeceras
use Maatwebsite\Excel\Concerns\WithTitle;//Le agrega un titulo a la hoja de excel
use Maatwebsite\Excel\Concerns\ShouldAutoSize;//cálculo de ancho automático

class ConsultasM2 implements FromView,WithTitle,ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $year, int $month) {
        $this->month = $month;
        $this->year  = $year;
        //dd($this->month);
    }
    //Le agrega un titulo a la hoja de excel con el año que se requiere
    public function title(): string
    {
        return 'CONSULTAS-'.$this->year.'-'.$this->month;
    }
//
    public function view(): View
    {
        $registrosCarrera=DB::table('carrera')
        ->select('carrera.id_carrera','carrera.nombre_carrera')
        ->get();  
        $LAG = $this->conteos($this->month,1);
        $IBT = $this->conteos($this->month,2);
        $ITA = $this->conteos($this->month,3);
        $IIN = $this->conteos($this->month,4);
        $IIF = $this->conteos($this->month,5);
        $IFI = $this->conteos($this->month,6);
        $IET = $this->conteos($this->month,7);
        $OTROS = $this->conteos($this->month,8);

        $registrosAfeccion=DB::table('afeccion')
        ->select('afeccion.id_afeccion','afeccion.nombre_afeccion')
        ->get();  
       
        return view('exports.mensual_pag2', [
            'registrosCarrera' => $registrosCarrera,
            'LAG' => $LAG,
            'IBT' => $IBT,
            'ITA' => $ITA,
            'IIN' => $IIN,
            'IIF' => $IIF,
            'IFI' => $IFI,
            'IET' => $IET,
            'OTROS'=> $OTROS,
            'registrosAfeccion' => $registrosAfeccion,
        ]);
    }
    /*Realiza los conteos de los pacientes de acuerdo al área, recibe el mes y año del cual debe realizar las busquedas
    y el id de el área para realizar el conteo*/
    public function conteos($mes,$id){
        $registrosLAG=DB::table('pacientes')
        ->select('pacientes.*') //Selecciona todos los atributos
        ->where('area_id', '=', $id)
        ->where('created_at', 'LIKE', '%'.$mes.'%')
        ->select(DB::raw('count(*) as conteos'))
        ->get();
    return $registrosLAG;
    }
    public static function conteosAfeccion($mes,$id){
        $registros=DB::table('pacientes')
        ->select('pacientes.*') //Selecciona todos los atributos
        ->where('afeccion_id', '=', $id)
        ->where('created_at', 'LIKE', '%'.$mes.'%')
        ->select(DB::raw('count(*) as conteos'))
        ->get();
       //dd($registrosLAG);
        return $registros;
    }
    
    
}