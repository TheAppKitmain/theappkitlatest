<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodOtp extends Model
{
    public function user()
    {
    return $this->belongsTo('App\Models\Template\Food_Delivery\FoodAppUser');
    }
}
