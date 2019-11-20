<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
trait UpdateTrait{
    //Creacion de la funcion para actualizar
    public function updateData($con,$id,Model $model)
    {
        self::where($con,$id)->update($model->attributes);
    }
}
