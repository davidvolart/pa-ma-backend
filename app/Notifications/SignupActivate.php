<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SignupActivate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct()
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('http://127.0.0.1:8000/api/auth/signup/activate/' . $notifiable->activation_token);
        return (new MailMessage)
            ->subject('Confirma tu cuenta')
            ->line('Gracias por registrate en ' . config('app.name') . '! Antes de continuar, debes confirmar tu cuenta.')
            ->action('Confirmar tu cuenta', url($url))
            ->line('Muchas gracias por utilizar ' . config('app.name') . '!');
    }
}
