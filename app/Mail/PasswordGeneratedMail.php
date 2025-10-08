<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use App\Models\User;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordGeneratedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $password;

    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }


    public function build()
    {
        return $this->subject('Tu contraseña de acceso a Store01')
            ->view('emails.generated-password');
    }
}
