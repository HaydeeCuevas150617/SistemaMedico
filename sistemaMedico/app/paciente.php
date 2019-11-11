<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

class paciente extends Model
{
    use UpdateTrait;
    use DeleteTrait;
    
    protected $table="pacientes";
    protected $filltable=['id_paciente','matricula','nombre','fecha_nac','area_id','diagnostico',
    'clase_diag','user_id','envio_imss','razon_ref'];
    protected $primaryKey = 'id_paciente';

    
}
