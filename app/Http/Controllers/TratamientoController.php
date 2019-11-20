<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Tratamiento;
use App\Medicamento;

class TratamientoController extends Controller
{
    //Función para añadir un tratamiento al paciente
    public function addTrat(Request $request)
{
    //dd($request); //Mostrar datos de la variable que se recibe
    $registro=new Tratamiento(); //Nuevo objeto de la clase Tratamiento
    $registro->medicamento_id=Input::get('medicamento_id');  //id del medicamento
    $registro->paciente_id=Input::get('paciente_id'); //id del paciente
    $registro->cantidad_medicamento=Input::get('cantidad_medicamento'); //cantidad del medicamento brindado.
    /*Llamada a la función descontrarMedicamento, la cual descuenta la cantidad del medicamento que se le
    dió al paciente en la consulta a la cantidad del medicamento que se encuentra en stock.*/
    $medicamento= $this->descontarMedicamento($registro->medicamento_id, $registro->cantidad_medicamento);
    $registro->save(); //Guardar datos en la tabla
    //Redirigir a la vista deseada con un mensaje de éxito.
    return back()->with('msj','Tratamiento añadido correctamente');
}

    /*Función para descontar cantidad de medicamento en el stock,
    recibe dos variables: id del medicamento y cantidad a descontat*/
    public function descontarMedicamento($id,$cantidad){
        /*Busca una identificación y devuelve un único modelo. 
        Si no existe un modelo coincidente, arroja un error.*/
        $medicamento=Medicamento::findOrFail($id);
        /*Accede al campo cantidad del medicamento que se buscó anteriormente,
        despues se especifica la cantidad que se encuentra en ese campo y se
        descuenta la cantidad que le fué dada al paciente y que se envió a 
        esta función.*/
        $medicamento->cantidad = ($medicamento->cantidad - $cantidad);
        $medicamento->updateData('id_medicamento',$id,$medicamento); //Actualizar los datos.
        return $medicamento;//Retornar la variable con los datos.
    }
//Mostrar para editar
public function showTratamiento($id)
{
    //dd($id);
    
    $tratamiento=DB::table('tratamiento')
    ->join('medicamentos', 'medicamentos.id_medicamento', '=', 'tratamiento.medicamento_id')  
    ->join('pacientes', 'pacientes.id_paciente', '=', 'tratamiento.paciente_id')        
    ->select( 'tratamiento.medicamento_id','tratamiento.paciente_id','tratamiento.cantidad_medicamento',
    'medicamentos.*','pacientes.*') 
    ->where('pacientes.id_paciente', '=', $id)    
    ->get();

    $registrosMedicamentos=DB::table('medicamentos')
        ->select('medicamentos.id_medicamento','medicamentos.nombre_medicamento','medicamentos.cantidad')
        ->get();

    return view('tratamiento',compact('tratamiento','registrosMedicamentos','id'));
}

}
