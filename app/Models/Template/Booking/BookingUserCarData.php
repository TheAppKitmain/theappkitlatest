<?php

namespace App\Models\Template\Booking;

use Illuminate\Database\Eloquent\Model;

class BookingUserCarData extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\Models\Template\Booking\BookingUserCarData');
    }
}
