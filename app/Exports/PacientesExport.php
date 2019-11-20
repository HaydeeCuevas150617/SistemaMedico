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
class PacientesExport implements FromView,WithTitle,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $month;
    private $year;
    private $day;

    //Constrictor que recibe los datos de la fecha
    public function __construct(int $year, int $month, int $day) {
        $this->day = $day;
        $this->month = $month;
        $this->year  = $year;
        
    }
    //Le agrega un titulo a la hoja de excel
    public function title(): string
    {
        return 'Bitacora'.$this->day.'-'.$this->month.'-'.$this->year;
    }

    public function view(): View
    {
        $registros = DB::table('pacientes')
            ->join('carrera', 'carrera.id_carrera', '=', 'pacientes.area_id')
            ->select('pacientes.id_paciente','pacientes.matricula','pacientes.nombre','pacientes.fecha_nac',
            'carrera.nombre_carrera','pacientes.diagnostico',
            'pacientes.envio_imss','pacientes.razon_ref','pacientes.created_at')
            ->whereDay('pacientes.created_at', $this->day)
            ->whereYear('pacientes.created_at', $this->year)
            ->whereMonth('pacientes.created_at', $this->month)
            ->get();
        return view('exports.bitacora', [
            'registrosPacientes' => $registros
        ]);
    }
}