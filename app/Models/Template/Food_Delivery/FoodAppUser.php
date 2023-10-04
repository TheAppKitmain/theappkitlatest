<?php

namespace App\Models\Template\Food_Delivery;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;

class FoodAppUser extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'food_app_user';

    protected $fillable = [
       'owner_id','template_id','name', 'email','profile','address','number','password','updated_at','created_at'
   ];

//    public function user_information()
//     {
//         return $this->hasOne('App\Models\Template\Food_Delivery\FoodUserInformation');
//     }

    public function user_information(){
        return $this->belongsTo('App\Models\Template\Food_Delivery\FoodUserInformation','id','app_user_id');
    }


    public function shop()
    {
        return $this->hasOne('App\Models\Template\Food_Delivery\FoodShop');
    }

    public function otp()
    {
        return $this->hasOne('App\Models\Template\Food_Delivery\FoodOtp');
    }

    // public function order()
    // {
    //     return $this->hasOne('App\Models\Template\Food_Delivery\FoodOrder');
    // }

    public function order(){
        return $this->belongsTo('App\Models\Template\Food_Delivery\FoodOrder');
    }


    public function apply_promo()
    {
        return $this->hasOne('App\Models\Template\Food_Delivery\FoodApplyPromo');
    } 

    // public function orders()
    // {
    //     return $this->hasMany('App\Models\Template\Food_Delivery\FoodOrder');
    // }

    public function stripe_info()
    {
        return $this->hasOne('App\Models\Template\Food_Delivery\FoodStripeInfo');
    }

    public function card_details()
    {
        return $this->hasMany('App\Models\Template\Food_Delivery\FoodCardDetail');
    }
}

