<?php

namespace App\Mail;

use App\Models\Kunjungan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KunjunganResponNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Kunjungan $kunjungan,
        public string $respon
    ) {
    }

    public function envelope(): Envelope
    {
        $fromAddress = config('mail.from.address') ?: 'pantisusana@gmail.com';
        $fromName = config('mail.from.name') ?: 'Panti Asuhan Santa Susana Timika';

        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address($fromAddress, $fromName),
            subject: 'Respon Permohonan Kunjungan – Panti Asuhan Santa Susana Timika',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.kunjungan-respon',
            with: [
                'kunjungan' => $this->kunjungan,
                'respon' => $this->respon,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
