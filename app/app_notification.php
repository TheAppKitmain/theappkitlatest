<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class app_notification extends Model
{
    protected $table = "app_notifications";
    protected $fillable = [
        'user_id', 'owner_id', 'app_id', 'message',
    ];
}
