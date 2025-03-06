<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Trajet;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $trajet;

    public function __construct(Trajet $trajet) 
    {
        $this->trajet = $trajet;
    }

    public function build()
    {
        $qrCodeData = json_encode([
            'id' => $this->trajet->id,
            'date' => $this->trajet->date,
            'lieu' => $this->trajet->lieu,
            'destination' => $this->trajet->destination,
            'passager' => $this->trajet->id_passager,
        ]);

        $qrCode = QrCode::size(200)->format('png')->generate($qrCodeData);
        
        return $this->view('passager.accepter')
                    ->subject('Votre réservation a été acceptée')
                    ->with([
                        'trajet' => $this->trajet,
                    ])
                    ->attachData($qrCode, 'qr_code.png', [
                        'mime' => 'image/png',
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de réservation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name', // Changez ici si nécessaire
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
