<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChatMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataList= array();

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataList)
    {
        $this->dataList = $dataList;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('TheAppKit')->markdown('emails.chatmail');
    }
}
