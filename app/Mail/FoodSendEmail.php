<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Template\Food_Delivery\FoodSendMail;

class FoodSendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $send_mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(FoodSendMail $send_mail)
    {
        $this->send_mail = $send_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mail.food_sendmail');
    }
}
