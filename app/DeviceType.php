<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $table = "device_types";
    protected $fillable = [
        'user_id', 'device_id', 'device_type', 'firebase_token',
    ];
}
