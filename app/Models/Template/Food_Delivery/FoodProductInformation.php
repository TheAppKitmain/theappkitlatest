<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodProductInformation extends Model
{
    protected $fillable = ['attribute_name','product_price','product_id'];
    protected $hidden = ['created_at','updated_at','stock'];
    
    public function product()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodProduct');
    }
    public function cart_item()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodCartItem','id','product_information_id');
    }
}
