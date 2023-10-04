<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodProductAttribute extends Model
{
    protected $table = "food_product_attributes";
    protected $hidden = ['created_at','updated_at','status'];
}
