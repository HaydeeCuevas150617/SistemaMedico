<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Medicamento;
class verMedicamentosController extends Controller
{
     //Función para index de medicamentos 
   public function index(Request $requestM)
    {
        /*La variable $request se envia a esta función desde la vista en el input de
        búsqueda, se recibe aquí y se realiza la busqueda en la base de datos que con
        el WHERE se ayuda a realizar la busqueda de acuerdo al nombre ingresado */
        //dd($request->get('nombre'));//imprimir arreglo con el resultado que se está mandando como búsqueda
        $registros=DB::table('medicamentos')
        ->select('medicamentos.id_medicamento','medicamentos.nombre_medicamento','medicamentos.cantidad')
        ->orderBy('medicamentos.cantidad','DESC') //Ordenar por cantidad del medicamento Orden Descendiente
        ->where('medicamentos.nombre_medicamento', 'like', '%'.$requestM->nombre_medicamento.'%')
        ->get();
        return view('verMedicamentos',compact('registros'));
    }
    //Función para Añadir Medicamento 
    public function addM(Request $request)
    {
        //Se valida que los campos sean requeridos
        //dd($request);
        request()->validate([
            'nombre_medicamento'=>'required',
            'cantidad'=>'required',
        ],
        [
            //Mensaje de alerta si los campos no son introducios
            'nombre_medicamento.required'=>'El nombre del medicamento es obligatorio',
            'cantidad.required'=>'La cantidad del medicamento es obligatorio',
        ]);

        //Comienza a añadir el nuevo registro
        $med=new Medicamento(); //Crea un nuevo objeto de la case Medicamento
        $med->nombre_medicamento=Input::get('nombre_medicamento'); //En el campo 'nombre' ingresa el que se obtiene en el campo 'nombre' de la vista
        $med->cantidad=Input::get('cantidad'); //En el campo 'cantidad ' ingresa la cantidad que se manda desde la vista
        $med->save();//Guarda los datos en la base de datos
        return \Redirect::to('/InventarioDeMedicamentos')->with('msj','Medicamento añadido correctamente'); //Redirecciona a la vista de los medicamentos y muestra mensaje de que se añadio correctamente.
    }

    //Función para eliminar registro
    public function destroyM($id)
    {
        $med=Medicamento::findOrFail($id);

        $med->delete();
        $med->deleteData('id_medicamento',$id,$med);
        return \Redirect::to('/InventarioDeMedicamentos')->with('msj','Medicamento eliminado correctamente');
    }

    //Mostrar para editar
    public function showM($id)
    {
        //dd($id);
       $medicamento=DB::table('medicamentos')
        ->select('medicamentos.id_medicamento','medicamentos.nombre_medicamento','medicamentos.cantidad')
        ->where('id_medicamento',$id) //Aquí hace la comparación del id que recibe con el de la base de datos
        ->get();
            return view('editMedicamento',compact('medicamento'));
    }


    //Actualizar la información para la edición
    public function update(Request $request,$id)
    {
        request()->validate([
            'nombre_medicamento'=>'required',
            'cantidad'=>'required'
        ],
        [
            'nombre_medicamento.required'=>'El nombre del medicamento es obligatorio',
            'cantidad'=>'La cantidad del medicamento es obligatoria'

        ]);
        //Creamos el objeto que va a almacenar nuestra Peli
        $med=Medicamento::findOrFail($id);
        $med->nombre_medicamento=$request->nombre_medicamento;
        $med->cantidad=$request->cantidad;
        $med->updateData('id_medicamento',$id,$med);
        return \Redirect::to('/InventarioDeMedicamentos')->with('msj','Se Editó correctamente');
    }
    

}
