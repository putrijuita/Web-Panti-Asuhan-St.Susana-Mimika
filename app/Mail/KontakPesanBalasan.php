<?php

namespace App\Mail;

use App\Models\KontakPesan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KontakPesanBalasan extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public KontakPesan $kontakPesan,
        public string $balasan
    ) {}

    public function envelope(): Envelope
    {
        $fromAddress = config('mail.from.address') ?: 'pantisusana@gmail.com';
        $fromName = config('mail.from.name') ?: 'Panti Asuhan Santa Susana Timika';

        $subject = 'Balasan: '.$this->kontakPesan->subjek.' – Panti Asuhan Santa Susana Timika';
        if (strlen($subject) > 998) {
            $subject = 'Balasan pesan Anda – Panti Asuhan Santa Susana Timika';
        }

        return new Envelope(
            from: new Address($fromAddress, $fromName),
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.kontak-pesan-balasan',
            with: [
                'kontakPesan' => $this->kontakPesan,
                'balasan' => $this->balasan,
            ],
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
