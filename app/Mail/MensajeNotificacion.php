<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MensajeNotificacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $msj;

    public function __construct($msj)
    {
        $this->msj = $msj;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() //Retorna una vista
    {
        //dd($this); //Mostrar array $this con toda la información
        /*Accede al array que se recibe del correo y se
        asgigna a la variable $asunto*/
        /*Retorna a la vista deseada con un asunto en el correo.*/
        return $this->view('correos.mensajeNotificacion')->subject('Registro exitoso');
    }
}
