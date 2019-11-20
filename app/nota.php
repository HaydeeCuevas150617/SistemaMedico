<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

class nota extends Model
{
    use UpdateTrait;
    use DeleteTrait;
    
    protected $table="notas";
    protected $filltable=['id','user_id','asunto','descripcion','razon_ref'];
    protected $primaryKey = 'id';
}
