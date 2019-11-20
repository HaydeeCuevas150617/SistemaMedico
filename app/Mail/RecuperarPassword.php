<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecuperarPassword extends Mailable
{

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $msj;
    public $subject;

    public function __construct($msj)
    {
        $this->msj =$msj;
        //dd($msj);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*Accede al array que se recibe del correo y se
        asgigna a la variable $asunto*/
       // $asunto = $this->msj['asunto']; 
        /*Retorna a la vista deseada y se le asigna la variable 
        $asunto al ASUNTO DEL CORREO ENVIADO.*/
        return $this->view('correos.recuperacionPass')->subject('Recuperación de Contraseña');
    }
}
