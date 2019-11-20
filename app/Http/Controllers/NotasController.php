<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Nota; 

class NotasController extends Controller
{
    public function indexNotas(Request $request)
    {
        $registrosNotas=DB::table('notas')
        ->join('users', 'users.id', '=', 'notas.user_id')
        ->select( 'notas.id','notas.user_id','notas.asunto','notas.descripcion','notas.created_at',
        'users.nombre','users.apellido')
        ->orderBy('notas.created_at','DESC') //ordena Descendientemente de acuerdo a la fecha
        
        /*El siguiente WHRERE ayuda con la búsqueda de acuerdo a la fecha deseada.*/
        //->where('notas.created_at', 'like', '%'.$request->fecha.'%')
        ->get();

        $registrosUsuarios=DB::table('users')
        ->select('users.id','users.nombre','users.apellido')
        ->get();

        return view('notas',compact('registrosNotas','registrosUsuarios'));
    }

     //Función para Añadir Nota
    public function addNota(Request $request)
    {
  request()->validate([
        //Valida que en estos campos se encuentre información
        'asunto'=>'required',
        'descripcion'=>'required',
    ],
    [
        'asunto.required'=>'El Asunto es obligatorio',
        'descripcion.required'=>'La descripción es obligatoria',
    ]);

    $registro=new Nota();
    $registro->asunto=Input::get('asunto'); 
    $registro->descripcion=Input::get('descripcion');
    $registro->user_id=Input::get('user_id');
    $registro->save();
    
    return \Redirect::to('indexNotas')->with('msj','Registro añadido correctamente');
    }

    //Función para eliminar registro
    public function eliminarNota($id)
    {
        $nota=Nota::findOrFail($id);
        //If
        if(!is_null($nota->imagen)){
            $archivo=explode("/",$nota->imagen);
            Storage::disk('disco')->delete($archivo[2]);
        }
        $nota->delete();
        $nota->deleteData('id',$id,$nota);
        return \Redirect::to('indexNotas')->with('msj','Nota eliminada correctamente');
    }

    //Mostrar para editar
    public function showNota($id)
    {
        //dd($id);
       $nota=DB::table('notas')
        ->select('notas.id','notas.user_id','notas.asunto','notas.descripcion','notas.created_at')
        ->where('id',$id) //Aquí hace la comparación del id que recibe con el de la base de datos
        ->get();

        $usuario=DB::table('users')
        ->select('users.id','users.nombre','users.apellido')
        ->get();

            return view('editarNota',compact('nota','usuario'));
    }
//Actualizar la información para la edición
public function updateNota(Request $request,$id)
{
    request()->validate([
        //Valida que en estos campos se encuentre información
        'asunto'=>'required',
        'descripcion'=>'required',
    ],
    [
        'asunto.required'=>'El Asunto es obligatorio',
        'descripcion.required'=>'La descripción es obligatoria',
    ]);
    //Creamos el objeto que va a almacenar nuestra Peli
    $nota=Nota::findOrFail($id);
    $nota->asunto=Input::get('asunto'); 
    $nota->descripcion=Input::get('descripcion');
    $nota->user_id=Input::get('user_id');
    $nota->updateData('id',$id,$nota);
    return \Redirect::to('indexNotas')->with('msj','Se Editó correctamente');
}

}
