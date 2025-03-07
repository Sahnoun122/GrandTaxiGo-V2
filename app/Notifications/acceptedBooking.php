<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;

class acceptedBooking extends Notification
{


    protected $trajet;
    protected $qrCodeBase64;

    /**
     * Create a new notification instance.
     */
    public function __construct($trajet, $qrCodeBase64)
    {
        $this->trajet = $trajet;
        $this->qrCodeBase64 = $qrCodeBase64;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // Envoyer par e-mail et stocker en base de données
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre trajet a été accepté')
            ->line('Votre trajet a été accepté. Détails :')
            ->line('Référence : ' . $this->trajet->reference)
            ->line('Date : ' . $this->trajet->date)
            ->line('Heure : ' . $this->trajet->heure)
            ->line('Départ : ' . $this->trajet->depart)
            ->line('Destination : ' . $this->trajet->destination)
            ->line('QR Code :')
            ->line('<img src="data:image/png;base64,' . $this->qrCodeBase64 . '" alt="QR Code">')
            ->action('Voir le trajet', url('/trajets/' . $this->trajet->id))
            ->line('Merci d\'utiliser notre application !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Votre trajet a été accepté.',
            'reference' => $this->trajet->reference,
            'date' => $this->trajet->date,
            'heure' => $this->trajet->heure,
            'depart' => $this->trajet->depart,
            'destination' => $this->trajet->destination,
            'qr_code' => $this->qrCodeBase64,
        ];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
