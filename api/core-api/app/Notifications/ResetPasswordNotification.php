<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    protected string $token;

    protected string $email;

    protected string $clientBaseUrl;

    protected string $resetPasswordUrl = 'authentication/reset-password';

    /**
     * Create a new notification instance.
     */
    public function __construct(string $email, string $token)
    {
        $this->email = $email;
        $this->token = $token;
        $this->clientBaseUrl = env('CLIENT_URL');
        $this->resetPasswordUrl = "{$this->clientBaseUrl}/{$this->resetPasswordUrl}?token={$this->token}&email={$this->email}";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Forgot password')
            ->action('Click to reset password', $this->resetPasswordUrl)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
