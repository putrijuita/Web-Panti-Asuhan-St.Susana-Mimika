<?php

namespace App\Mail;

use App\Models\Donasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonasiKonfirmasi extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Donasi $donasi) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Konfirmasi Donasi – Panti Asuhan Santa Susana Timika',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.donasi-konfirmasi',
            with: ['donasi' => $this->donasi],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
