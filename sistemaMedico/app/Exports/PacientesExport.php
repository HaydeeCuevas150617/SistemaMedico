<?php

namespace App\Exports;
use DB;
use App\paciente;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PacientesExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $month;
    private $year;
    private $day;
    public function headings(): array
    {
        return [
            'Id',
            'Matricula',
            'Nombre',
            'Fecha Nacimiento',
            'Area id',
            'Diagnostico',
            'Envio a IMSS',
            'Razón de Referencia',
            'Fecha de Visita'
        ];
    }
    
   
    public function __construct(int $year, int $month, int $day) {
        $this->day = $day;
        $this->month = $month;
        $this->year  = $year;
        
    }
    public function query()
    {
        return Paciente
            ::query()
            ->join('carrera', 'carrera.id_carrera', '=', 'pacientes.area_id')
            ->select('pacientes.id_paciente','pacientes.matricula','pacientes.nombre','pacientes.fecha_nac',
            'carrera.nombre_carrera','pacientes.diagnostico',
            'pacientes.envio_imss','pacientes.razon_ref','pacientes.created_at')
            ->whereDay('pacientes.created_at', $this->day)
            ->whereYear('pacientes.created_at', $this->year)
            ->whereMonth('pacientes.created_at', $this->month);
    }
}