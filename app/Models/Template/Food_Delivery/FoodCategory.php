<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    public function parent()
    {
        return $this->belongsTo('App\Models\Template\Food_Delivery\FoodCategory', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Template\Food_Delivery\FoodCategory', 'parent_id');
    }

    public function product()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodProduct');
    }

    public function products()
    {
    	return $this->hasMany('App\Models\Template\Food_Delivery\FoodProduct');
    }
}
