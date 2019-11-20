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
class PlanificadoresExport implements FromView,WithTitle,ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $year, int $month) {
        $this->month = $month;
        $this->year  = $year;
    }
    //Le agrega un titulo a la hoja de excel con el año que se requiere
    public function title(): string
    {
        return 'Planificación Familiar'.$this->year;
    }
//
    public function view(): View
    {
        $pf = DB::table('pacientes')
            ->join('planificador_fam', 'planificador_fam.paciente_id', '=', 'pacientes.id_paciente')
            ->select('planificador_fam.*','pacientes.*')
            ->whereYear('pacientes.created_at', $this->year)
            ->whereMonth('pacientes.created_at', $this->month)
            ->get();
        return view('exports.planificadores', [
            'planificadores' => $pf
        ]);
    }
}