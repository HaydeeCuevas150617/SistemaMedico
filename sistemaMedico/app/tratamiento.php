<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

class tratamiento extends Model
{
    use UpdateTrait;
    use DeleteTrait;
    
    protected $table="tratamiento";
    protected $filltable=['paciente_id','medicamento_id','cantidad_medicamento','created_at'];
}
