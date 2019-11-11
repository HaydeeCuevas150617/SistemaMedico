<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MensajeRecibido extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $msj;
    public $subject;

    public function __construct($msj=[])
    {
        $this->msj =$msj;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() //Retorna una vista
    {
       // dd($this); //Mostrar array $this con toda la información
        /*Accede al array que se recibe del correo y se
        asgigna a la variable $asunto*/
        $asunto = $this->msj['asunto']; 
        /*Retorna a la vista deseada y se le asigna la variable 
        $asunto al ASUNTO DEL CORREO ENVIADO.*/
        return $this->view('correos.mensajeEnviado')
        ->subject($asunto)
        ->attach($this->msj['archivo']->getRealPath(), //Obtener la ruta de carga temporal
                [
                    'as' => $this->msj['archivo']->getClientOriginalName(), //Obtener el nombre del archivo cargado
                    'mime' => $this->msj['archivo']->getClientMimeType(), //Obtener el tipo MIME del archivo cargado
                ]);
    }
}
