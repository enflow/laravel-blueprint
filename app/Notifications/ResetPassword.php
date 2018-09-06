<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->subject('Wachtwoord vergeten')
            ->line('Je hebt aangegeven dat je je wachtwoord bent vergeten. Hierbij de link om je wachtwoord opnieuw in te stellen.')
            ->action('Wachtwoord opnieuw instellen', url('password/reset', $this->token))
            ->line('Als je dit verzoek niet hebt aangevraagd is verdere actie niet nodig.')
            ->salutation('Het team van ' . config('app.name'));
    }
}
