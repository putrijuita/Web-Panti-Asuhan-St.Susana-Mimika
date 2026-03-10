<?php

namespace App\Mail;

use App\Models\Kunjungan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KunjunganStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Kunjungan $kunjungan)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📅 Informasi Permohonan Kunjungan – Panti Asuhan Santa Susana Timika',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.kunjungan-status',
            with: [
                'kunjungan' => $this->kunjungan,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

