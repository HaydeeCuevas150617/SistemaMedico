<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accidentado extends Model
{
    protected $table="accidentado";
    protected $filltable=['paciente_id','area_accidente','region_afectada',
    'tipo_lesion','causa_lesion','lugar_accidente','observaciones_accidente'];
}
