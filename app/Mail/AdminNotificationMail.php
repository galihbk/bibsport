<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $jenis; // daftar akun / daftar event

    /**
     * Create a new message instance.
     */
    public function __construct($id, $jenis)
    {
        $this->id = $id;
        $this->jenis = $jenis;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Notifikasi ' . ucfirst($this->jenis) . ' Baru')
            ->view('emails.admin_notification');
    }
}
