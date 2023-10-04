<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodShop extends Model
{
    protected $fillable = ['shop_name','template_id','shop_descrption','shop_image','shop_location','shop_lat','shop_long','currency','currency_symbol','status','app_user_id','delivery_charges'];

    public function product()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodProduct');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodAppUser');
    }
}
