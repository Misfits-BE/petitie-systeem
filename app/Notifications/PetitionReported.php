<?php

namespace Misfits\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class PetitionReported
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     \Misifts\Notifications
 */
class PetitionReported extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * variable for the database collection from the petition.
     */
    public $petition; 

    /**
     * Create a new notification instance.
     *
     * @param  Petition $petition The database collection from the petition
     * @return void
     */
    public function __construct($petition)
    {
        $this->petition = $petition;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'text' => 'Er is een petitie (' . ucfirst($this->petition->title) . ') is gerappporteerd gerapporteerd.'
        ];
    }
}
