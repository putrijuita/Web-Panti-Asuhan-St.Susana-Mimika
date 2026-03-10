<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminCreatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Admin $admin,
        public string $plainPassword
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '👋 Akun Admin Anda Telah Dibuat – Panti Asuhan Santa Susana Timika',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-created',
            with: [
                'admin'         => $this->admin,
                'plainPassword' => $this->plainPassword,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

