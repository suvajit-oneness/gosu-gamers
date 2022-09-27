<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'test@em6029.apexdivision.com';
        $name = 'Apex Division';

        return $this->view('email.GenericEmail')
//            ->from($address, $name)
//            ->cc($address, $name)
//            ->bcc($address, $name)
//            ->replyTo($address, $name)
            ->subject($this->data['subject'])
            ->with([
                'message_content' => $this->data['mail_body']
            ]);
    }
}
