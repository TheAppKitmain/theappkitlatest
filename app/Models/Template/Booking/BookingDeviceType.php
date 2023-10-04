<?php

namespace App\Models\Template\Booking;

use Illuminate\Database\Eloquent\Model;

class BookingDeviceType extends Model
{
    protected $fillable = [

        'owner_id','template_id', 'booking_user_id','firebase_token','device_id','device_type','updated_at','created_at',

    ];
}
