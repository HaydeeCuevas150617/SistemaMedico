<?php
namespace App\Exports;
use App\paciente;
use DB;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;//Le agrega titulos de cabeceras
use Maatwebsite\Excel\Concerns\WithColumnFormatting;//Le agrega formato 
use Maatwebsite\Excel\Concerns\WithTitle;//Le agrega un titulo a la hoja de excel
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;//cálculo de ancho automático
class EmbarazadasExport implements FromQuery, WithHeadings, WithColumnFormatting,WithTitle,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $year;
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_GENERAL,
            'B' => NumberFormat::FORMAT_GENERAL,
            'C' => NumberFormat::FORMAT_GENERAL,
        ];
    }
    public function headings(): array
    {
        $encabezados =['Id',
        'Nombre',
        'Edad',
        'Carrera',
        'Semanas De Embarazo',
        'Control',
        'Comentarios',
        'Fecha de Probable de Parto',
        'Fecha de Ingreso'];
        return $encabezados;
    }
    
   
    public function __construct(int $year) {
        $this->year  = $year;
        
    }

    public function query()
    {
        return Paciente
            ::query()
            ->join('carrera', 'carrera.id_carrera', '=', 'pacientes.area_id')
            ->join('embarazada', 'embarazada.paciente_id', '=', 'pacientes.id_paciente')
            ->select('pacientes.id_paciente','pacientes.nombre','pacientes.fecha_nac',
            'carrera.nombre_carrera',
            'embarazada.semanas_embarazo','embarazada.control','embarazada.comentarios',
            'embarazada.f_prob_parto','embarazada.f_ingreso',
            'carrera.nombre_carrera')
            ->where('pacientes.diagnostico', 'like', '%Embaraz%')
            ->whereYear('pacientes.created_at', $this->year);
    }

//Le agrega un titulo a la hoja de excel
    public function title(): string
    {
        return 'Embarazadas'.$this->year;
    }
}