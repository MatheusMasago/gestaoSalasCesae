<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNeedsRoleNotification extends Notification
{
    use Queueable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Enviar por e-mail e também salvar no banco
    }

    public function shouldQueue()
    {
        return true; // Adiciona a notificação na fila
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Novo Usuário Precisa de Atribuição de Perfil')
            ->greeting('Olá, Administrador!')
            ->line('Um novo usuário foi registrado e está aguardando atribuição de tipo de perfil.')
            ->line('Nome: ' . $this->user->name)
            ->line('E-mail: ' . $this->user->email)
            ->action('Gerenciar Usuários', route('users.index')) // Alterar a URL conforme necessário
            ->line('Obrigado por usar nosso sistema!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Um novo usuário foi registrado e precisa de atribuição de perfil.',
            'user_name' => $this->user->name,  // Nome do usuário que se registrou
            'user_email' => $this->user->email,  // E-mail do usuário que se registrou
            'user_id' => $this->user->id,   // ID do usuário que se registrou
        ];
    }
}
