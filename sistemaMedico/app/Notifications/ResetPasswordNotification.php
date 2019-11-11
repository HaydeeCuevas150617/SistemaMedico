<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;
 
    public $actionUrl;
 
    public function __construct($token)
    {
        $this->actionUrl = action('Auth\ResetPasswordController@showResetForm',$token);
    }
 
    public function via($notifiable)
    {
        return ['mail'];
    }
 
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Solicitud de reestablecimiento de contraseña')
            ->greeting('Hola '. $notifiable->name)
            ->line('Recibes este email porque se solicitó un restablecimiento de tu contraseña para tu cuenta.')
            ->action('Reestablecer Contraseña', $this->actionUrl)
            ->line('Si no realizaste está petición, puedes ignorar este correo y nada habrá cambiado.')
            ->salutation('¡Saludos!');
    }
 
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
