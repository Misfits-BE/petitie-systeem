<?php

namespace Misfits\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUser extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var User $user The entity from the newly created user in the system. */
    public $user;

    /** @var string $password The random generated string from the controller. */
    public $password;

    /**
     * Create a new notification instance.
     *
     * @param  User   $user      The entity from the newly created user in the system.
     * @param  string $password  The random generated string from the controller.
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable No-tification builder instance
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable Notification builder instance
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('Er is een login op '. config('app.name') .' voor u aangemaakt.')
                ->greeting('Geachte,')
                ->line('Een adminstrator heeft voor jouw een login aangemaakt op activisme.be')
                ->line("U kunt zich aanmelden met uw email adres en het volgende wachtwoord ( {$this->password} ).")
                ->action('Ga naar de website', config('app.url'));
    }
}
