<?php

namespace App\Exports;
use App\Medicamento;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
class MedicamentosExport implements FromCollection
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return Medicamento::all();
    }
}
