<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planificador_fam extends Model
{
    protected $table="planificador_fam";
    protected $filltable=['paciente_id','nss','tipo_metodo',
    'correo','estado','f_aplicacion'];
}
