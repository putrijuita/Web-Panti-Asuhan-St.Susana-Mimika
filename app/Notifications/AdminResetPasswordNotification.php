<?php

namespace App\Notifications;

use App\Mail\AdminResetPasswordMail;
use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $token
    ) {
    }

    /** @return list<string> */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(Admin $notifiable): AdminResetPasswordMail
    {
        return new AdminResetPasswordMail($notifiable, $this->token);
    }
}
