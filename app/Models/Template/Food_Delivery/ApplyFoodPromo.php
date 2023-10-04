<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class ApplyFoodPromo extends Model
{
    protected $fillable=['cart_id','app_user_id','promo_id','total','grand_total','discount_price'];
    public function promo()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodPromo');
    }
    public function user()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodUser');
    }

    public function order()
    {
    	return $this->hasOne('App\Models\Template\Food_Delivery\ApplyFoodPromo');
    }
}
