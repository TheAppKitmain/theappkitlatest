<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodFeaturedProduct extends Model
{
    protected $fillable=['product_attribute_id','product_id','position'];
    protected $hidden =['created_at','updated_at'];
    
    public function product()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodProduct');
    }
}
