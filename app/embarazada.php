<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class embarazada extends Model
{
    protected $table="embarazada";
    protected $filltable=['paciente_id','control','comentarios',
    'f_prob_parto','f_ingreso','semanas_embarazo'];
}
