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

class ConsultasM1 implements FromView,WithTitle,ShouldAutoSize
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
        $pf = DB::table('pacientes')
            ->join('carrera', 'carrera.id_carrera', '=', 'pacientes.area_id')
            ->join('tratamiento', 'tratamiento.paciente_id', '=', 'pacientes.id_paciente')
            ->join('medicamentos', 'medicamentos.id_medicamento', '=', 'tratamiento.medicamento_id')
            ->select('pacientes.id_paciente','pacientes.matricula','pacientes.nombre','pacientes.fecha_nac',
            'carrera.nombre_carrera','pacientes.diagnostico',
            'pacientes.envio_imss','pacientes.razon_ref','pacientes.created_at',
            'tratamiento.paciente_id','tratamiento.medicamento_id','tratamiento.cantidad_medicamento',
            'medicamentos.id_medicamento','medicamentos.nombre_medicamento')
            ->whereYear('pacientes.created_at', $this->year)
            ->whereMonth('pacientes.created_at', $this->month)
            ->get();
            
        return view('exports.mensual_pag1', [
            'registros' => $pf
        ]);
    }
    
}