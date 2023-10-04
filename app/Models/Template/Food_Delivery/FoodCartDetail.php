<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodCartDetail extends Model
{
    protected $fillable = ['app_user_id','card_no','exp_year','exp_month'];

    public function user()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodAppUser');
    }
}
