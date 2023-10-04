<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodPromo extends Model
{
    protected $hidden=['created_at','updated_at','status'];
    public function apply_promo()
    {
    	return $this->hasOne('App\Models\Template\Food_Delivery\ApplyFoodPromo');
    }
}
