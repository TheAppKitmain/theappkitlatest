<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterMail extends Mailable
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

        if($this->bugstatus['user_type'] == "shopify"){
            return $this->from($address = 'support@theappkit.co.uk', $name = 'TheAppKit')
            ->subject('TheAppKit -  New Client Shopify')
            ->markdown('emails.register_user_mail');

        }elseif($this->bugstatus['user_type'] == "custom"){
                return $this->from($address = 'support@theappkit.co.uk', $name = 'TheAppKit')
                ->subject('TheAppKit -  New Client Custom')
                ->markdown('emails.register_user_mail'); 

        }else{
            return $this->from($address = 'support@theappkit.co.uk', $name = 'TheAppKit')
            ->subject('TheAppKit -  New Client Template')
            ->markdown('emails.register_user_mail'); 
        }
    }
}
