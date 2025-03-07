<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Trajet;

class TrajetAccepte extends Notification
{
    use Queueable;

    public $trajet;
    public $qrCodeBase64;

    public function __construct(Trajet $trajet, $qrCodeBase64)
    {
        $this->trajet = $trajet;
        $this->qrCodeBase64 = $qrCodeBase64;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; 
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre réservation a été acceptée')
            ->line('Votre trajet prévu le ' . $this->trajet->date . ' a été accepté.')
            ->attachData(base64_decode($this->qrCodeBase64), 'qr_code.png', [
                'mime' => 'image/png',
            ])
            ->line('Merci de choisir notre service.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Votre réservation a été acceptée.',
            'trajet_id' => $this->trajet->id,
            'qr_code' => $this->qrCodeBase64,
        ];
    }
}
