<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodProductImage extends Model
{
    protected $fillable=['product_id','product_image'];
    protected $hidden=['created_at','updated_at'];
    
    public function product()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodProduct');
    }
  
}
