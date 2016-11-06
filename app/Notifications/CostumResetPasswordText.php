<?php

namespace Brood\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CostumResetPasswordText extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Je ontvangt dit bericht omdat we een wachtwoord reset aanvraag hebben ontvangen voor uw account.')
            ->action('Reset wachtwoord', url('password/reset', $this->token))
            ->line('Als je dit wachtwoord reset verzoek niet hebt aangevraag, dan hoef je verder niets te doen.');
    }
}
