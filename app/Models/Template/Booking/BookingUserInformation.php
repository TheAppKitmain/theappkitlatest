<?php

namespace App\Models\Template\Booking;

use Illuminate\Database\Eloquent\Model;

class BookingUserInformation extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\Models\Template\Booking\BookingAppUser');
    }
}
