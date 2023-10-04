<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class EcommDeviceType extends Model
{
    protected $fillable = [

        'owner_id','template_id', 'app_user_id','firebase_token','device_id','device_type','updated_at','created_at',

    ];
}
