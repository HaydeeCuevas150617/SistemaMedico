<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Mail\MensajeNotificacion; 
use DB;
use App\User;
use Hash;
class UsuarioController extends Controller
{
    public function create()
    {
        return view('administrador.indexMedicos');
    }

    public function indexMedicos(Request $request)
    {
       //dd($request->get('nombre'));//imprimir arreglo con el resultado que se está mandando como búsqueda
        $registrosMedicos=DB::table('users')
        ->select( 'users.id','users.nombre','users.apellido','users.email','rol.rol as rol')
        ->where('rol_id',"2")
        ->join('rol', 'rol.id', '=', 'users.rol_id')
        ->get();
        $registros=DB::table('rol')
        ->select('rol.id','rol.rol','rol.descripcion')
        ->get();
        return view('superAdmin.indexMedicos',compact('registros','registrosMedicos'));
    }

    public function addMedico(Request $request)
{
    request()->validate([
        
        'nombre'=>'required',
        'apellido'=>'required',
        'email'=>'required',
        'password'=>'required',
    ],
    [
        'nombre.required'=>'El nombre del registro es obligatorio',
        'apellido.required'=>'El apellido del registro es obligatorio',
        'email.required'=>'El email del registro es obligatoria',
        'password.required'=>'La contraseña del registro es obligatorio'
    ]);
    
    $registro=new User();
    $registro->nombre=Input::get('nombre');
    $registro->apellido=Input::get('apellido');
    $registro->email=Input::get('email');
    $contraEncrip=Hash::make(Input::get('password'));
    $registro->password=$contraEncrip;
    $registro->rol_id=Input::get('rol_id');
    $contraNoEncrip = Input::get('password');
    $this->enviarCorreoNotificacion($registro,$contraNoEncrip);
    $registro->save();
    
    return \Redirect::to('indexMedicos')->with('msj','Registro añadido correctamente');
}

    public function enviarCorreoNotificacion($registro,$password){
        $registro->password = $password;
        Mail::to($registro->email)->send(new MensajeNotificacion($registro));
    }
//Función para eliminar registro
public function eliminarMedico($id)
{
    $medico=User::findOrFail($id);
    if(!is_null($medico->imagen)){
        $archivo=explode("/",$med->imagen);
        Storage::disk('disco')->delete($archivo[2]);
    }
    $medico->delete();
    $medico->deleteData('id',$id,$medico);
    return \Redirect::to('indexMedicos')->with('msj','Médico eliminado correctamente');
}

//Mostrar para editar
public function mostrarDatosMedico($id)
{
    //dd($id);
   $medico=DB::table('users')
    ->select('users.id','users.nombre','users.apellido','users.email','users.password')
    ->where('id',$id) //Aquí hace la comparación del id que recibe con el de la base de datos
    ->get();
        return view('superAdmin.editarMedico',compact('medico'));
}

//Actualizar la información para la edición
public function actualizar(Request $request,$id)
{
    //Creamos el objeto que va a almacenar nuestra Peli
    $med=User::findOrFail($id);
    $med->nombre=$request->nombre;
    $med->apellido=$request->apellido;
    $med->email=$request->email;
    $contraEncrip=Hash::make(Input::get('password'));
    $med->password=$contraEncrip;
    $med->updateData('id',$id,$med);
    return \Redirect::to('indexMedicos')->with('msj','Se Editó correctamente');
}

}
