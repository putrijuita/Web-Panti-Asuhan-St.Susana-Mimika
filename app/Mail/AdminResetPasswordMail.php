<?php

namespace App\Mail;

use App\Models\Admin;
use App\Support\AdminPanel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $resetUrl;

    public int $expireMinutes;

    public function __construct(
        public Admin $admin,
        public string $token
    ) {
        $this->resetUrl = AdminPanel::url('reset-password/'.$token, [
            'email' => $admin->getEmailForPasswordReset(),
        ]);
        $this->expireMinutes = (int) config('auth.passwords.admins.expire', 60);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset kata sandi — Panel Admin Panti Asuhan Santa Susana',
            to: [new Address($this->admin->email, $this->admin->name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-password-reset',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
