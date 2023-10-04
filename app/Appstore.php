<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appstore extends Model
{
    protected $fillable = [
       'user_id', 'done_ios', 'done_android','app_id'
    ];
}
