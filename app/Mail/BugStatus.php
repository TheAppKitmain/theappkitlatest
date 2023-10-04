<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BugStatus extends Mailable
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
        // return $this->from($address = 'support@theappkit.co.uk', $name = 'TheAppKit')
        // ->subject('TheAppKit - Bug Report')
        // ->markdown('emails.bugstatus');

        if($this->bugstatus['multiple'] == 1){
            return $this->from($address = 'support@theappkit.co.uk', $name = 'TheAppKit')
                    ->subject('TheAppKit - Bug Report')
                    ->markdown('emails.bugsstatusmultiple');
        }else{
                return $this->from($address = 'support@theappkit.co.uk', $name = 'TheAppKit')
                ->subject('TheAppKit - Bug Report')
                ->markdown('emails.bugstatus'); 
        }
    }
}
