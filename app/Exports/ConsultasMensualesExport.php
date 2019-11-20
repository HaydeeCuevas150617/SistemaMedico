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
use Maatwebsite\Excel\Concerns\WithMultipleSheets; //Para multiples hojas
class ConsultasMensualesExport implements WithMultipleSheets
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

        public function sheets(): array
    {
        return [
            'CONSULTAS-'.$this->year.'-'.$this->month => new ConsultasM1($this->year,$this->month),
            'GRÁFICAS-'.$this->year.'-'.$this->month => new ConsultasM2($this->year,$this->month),
        ];
    }
    
}