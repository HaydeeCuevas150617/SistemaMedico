<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

class medicamento extends Model
{
    use UpdateTrait;
    use DeleteTrait;
    protected $table="medicamentos";
    protected $filltable=['id_medicamento','nombre_medicamento','cantidad'];
    protected $primaryKey = 'id_medicamento';
    protected $fillable = [];
}
