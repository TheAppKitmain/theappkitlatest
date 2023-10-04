<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodCartItem extends Model
{
    protected $hidden = ['created_at','updated_at'];
    public function products()
    {
    	return $this->hasMany('App\Models\Template\Food_Delivery\FoodProduct','id','product_id');
    }
	
	public function cart()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodCart','id','cart_id');
    }

    public function product_informations()
    {
        return $this->hasMany('App\Models\Template\Food_Delivery\FoodProductInformation','id','product_information_id');
    }
}
