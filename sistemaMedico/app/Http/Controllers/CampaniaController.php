<?php

namespace App\Http\Controllers;
//namespace Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\MensajeRecibido; 
use DB;
use App\User;
use Hash;

class CampaniaController extends Controller
{
    /*public function enviarCorreo(Request $mensaje){
        $mensaje = request()->validate([
            'asunto' => 'required',
            'email' => 'required',
            'descripcion' => 'required',
            'archivo' => 'required',
        ]);
        dd($mensaje);
        Mail::to($mensaje['email'])->send(new MensajeRecibido($mensaje));
        return \Redirect::to('/EnviarCampanias')->with('msj','Mensaje Enviado');
        //return 'Mensaje Enviado';
    }
*/
    public function enviarCorreo(Request $request){
        $title = $request['asunto'];
        
        // Get the uploades file with name document
        $document = $request['archivo'];
    
        // Required validation
        $request->validate([
            'email' => 'required',
            'asunto' => 'required',
            'archivo' => 'required',
        ],
        [
            'archivo.required'=>'La imagen es obligatoria para el envio de campañas',
        ]);
    
        // Check if uploaded file size was greater than 
        // maximum allowed file size
        if ($document->getError() == 1) {
            $max_size = $document->getMaxFileSize() / 1024 / 1024;  // Get size in Mb
            $error = 'The document size must be less than ' . $max_size . 'Mb.';
            return redirect()->back()->with('flash_danger', $error);
        }
        
        $data = [
            'document' => $document
        ];
        
        // If upload was successful
        // send the email
        
        Mail::to($request['email'])->send(new MensajeRecibido($request));
        return \Redirect::to('/EnviarCampanias')->with('msj','Mensaje Enviado');
    }
}
