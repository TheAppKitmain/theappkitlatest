<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class VerifyYourAccountApp extends Mailable
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
        return $this->from($address = 'support@theappkit.co.uk', $name = 'TheAppKit')
        ->subject('Verification code - The App Kit')
        ->markdown('emails.OTP.app_end_otp');
    }
}