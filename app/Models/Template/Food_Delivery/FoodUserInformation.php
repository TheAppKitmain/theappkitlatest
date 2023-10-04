<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodUserInformation extends Model
{
    protected $hidden = [
        'country_id', 'state_id','city_id','zipcode_id','created_at','updated_at',
    ];

    public function user()
    {
    	return $this->hasMany(' App\Models\Template\Food_Delivery\FoodAppUser','id','app_user_id');
    }
}
