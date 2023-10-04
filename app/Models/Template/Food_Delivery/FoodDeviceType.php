<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodDeviceType extends Model
{
    protected $fillable = [
        'owner_id','template_id', 'app_user_id','firebase_token','device_type','updated_at','created_at',
    ];
}
