<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUsersList extends Mailable
{
use Queueable, SerializesModels;

/* Declare an array variable */
public $userList= array();

/**
* Create a new message instance.
*
* @return void
*/

public function __construct($userList)
{
/* Initialize the array variable by the variable passed by the
object creation of the class. */
$this->userList = $userList;
}

/**
* Build the message.
*
* @return $this
*/
public function build()
{
/* Diaplay the view file with the values of the array variable */
return $this->view('registeredList')->with('userList',$this->userList);
}

}