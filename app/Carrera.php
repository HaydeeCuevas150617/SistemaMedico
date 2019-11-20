<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use UpdateTrait;
    use DeleteTrait;
    protected $table="carrera";
    protected $filltable=['id_carrera','nombre_carrera','razon_ref'];
    protected $primaryKey = 'id_carrera';
    
}
