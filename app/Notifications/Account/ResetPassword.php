<?php

namespace App\Notifications\Account;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification implements ShouldQueue
{
    private $user;
    private $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Wachtwoord vergeten')
            ->markdown('emails.account.reset-password', [
                'user' => $this->user,
                'token' => $this->token,
            ]);
    }
}
