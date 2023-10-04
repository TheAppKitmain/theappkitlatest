<?php

namespace App\Models\Template\Booking;

use Illuminate\Database\Eloquent\Model;

class BookingCartype extends Model
{
    public function orders()
    {
        return $this->hasMany('App\Models\Template\Booking\BookingOrder');
    }
}
