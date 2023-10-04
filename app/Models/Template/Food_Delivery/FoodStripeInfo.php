<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodStripeInfo extends Model
{
    protected $fillable=['user_id','customer_id'];
    public function user()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodAppUser');
    }
}
