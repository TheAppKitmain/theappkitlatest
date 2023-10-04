<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class app_chat_images extends Model
{
    protected $fillable = [
        'user_id', 'images'
    ];
}
