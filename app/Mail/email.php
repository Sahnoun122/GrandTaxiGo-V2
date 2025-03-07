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
    public $qrCodeBase64;

    
        public function __construct($details) 
        {
            $this->trajet = $details['trajet'];
            $this->qrCodeBase64 = $details['qrCode'];
        }
    
        public function build()
        {
            return $this->view('passager.accepter')
                        ->subject('Votre réservation a été acceptée')
                        ->with([
                            'trajet' => $this->trajet,
                        ])
                        ->attachData(base64_decode($this->qrCodeBase64), 'qr_code.png', [
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
