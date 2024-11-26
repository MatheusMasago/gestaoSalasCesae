<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the notification's mail representation.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Confirme seu endereço de e-mail')
                    ->line('Obrigado por se registrar conosco!')
                    ->line('Por favor, clique no botão abaixo para verificar seu e-mail.')
                    ->action('Verificar E-mail', url('/email/verify/'.$notifiable->getKey()).'?hash='.sha1($notifiable->getEmailForVerification()))
                    ->line('Se você não criou uma conta, nenhuma outra ação é necessária.');
    }
}
