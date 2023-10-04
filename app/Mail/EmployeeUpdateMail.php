<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeeUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employee_update= array();

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employee_update) 
    {
        $this->employee_update = $employee_update;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $gggg = $this->employee_update->user_name. ' - Employee update';
        return $this->from($address = 'support@theappkit.co.uk', $name = 'TheAppKit')
        ->subject($gggg)->markdown('emails.employee_mail');
    }
}
