<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use App\Models\Mascota;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;


class HistorialGeneratedMail extends Mailable
{
    /*
    use Queueable, SerializesModels;
    public $user_owner;
    public $historial_clinico;


    public function __construct(Mascota $user_owner, string $historial_clinico)
    {
        $this->user_owner = $user_owner;
        $this->historial_clinico = $historial_clinico;
    }


    public function build()
    {
        return $this->subject('El historial medico de ' . $this->user_owner->name_pet)
            ->view('emails.send_historial');
    }
    */
    use Queueable, SerializesModels;

    public $filePath;
    public $data;

    public function __construct($filePath, $data)
    {
        $this->filePath = $filePath;
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Historia clinica de ' . $this->data->name_pet)
            ->view('emails.send_historial')
            ->attach(Storage::disk('public')->path($this->filePath));
    }
}
