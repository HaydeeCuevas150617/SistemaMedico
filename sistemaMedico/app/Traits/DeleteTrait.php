<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
trait DeleteTrait{
    //Creacion de la funcion para actualizar
    public function deleteData($con,$id,Model $model)
    {
        self::where($con,$id)->delete();
    }
}
