<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodCart extends Model
{
    public function cart_items()
    {
    	return $this->hasMany('App\Models\Template\Food_Delivery\FoodCartItem','id','cart_id');
    }

    public function order()
    {
        return $this->hasOne('App\Models\Template\Food_Delivery\FoodOrder');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Template\Food_Delivery\FoodOrder');
    }
}
