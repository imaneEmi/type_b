<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    private $objet;
    private $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$objet,$msg)
    {
        $this->name = $name;
        $this->objet = $objet;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'UCA Présidence')
        ->subject($this->objet)
        ->markdown('emails.customEmail')
        ->with([
            'name' => $this->name,
            'msg' => $this->msg,
        ]);
    }
}
