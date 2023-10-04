<?php

namespace App\Models\Template\Booking;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;

class BookingAppUser extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'booking_app_user';

    public function user_information()
    {
        return $this->hasOne('App\Models\Template\Booking\BookingUserInformation');
    }

    public function carinfo()
    {
        return $this->hasOne('App\Models\Template\Booking\BookingUserCarData');
    }

    public function shop()
    {
        return $this->hasOne('App\Models\Template\Booking\BookingShop');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Template\Booking\BookingOrder');
    }

}
