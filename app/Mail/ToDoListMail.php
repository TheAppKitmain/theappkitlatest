<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ToDoListMail extends Mailable
{
    use Queueable, SerializesModels;
    public $bugstatus= array();

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bugstatus) 
    {
        $this->bugstatus = $bugstatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($address = 'support@theappkit.co.uk', $name = 'TheAppKit')
        ->subject('To Do List')
        ->markdown('emails.to_do_list');
    }
}
