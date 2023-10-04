<?php

namespace App\Models\Template\Booking;

use Illuminate\Database\Eloquent\Model;

class BookingOrder extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cartype()
    {
    	return $this->belongsTo('App\Cartype');
    }

    public function deal()
    {
        return $this->belongsTo('App\Deal');
    }

    public function apply_promo()
    {
        return $this->belongsTo('App\ApplyPromo');
    }
}
