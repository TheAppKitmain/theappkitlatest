<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutappNote extends Model
{
    protected $fillable = [
        'user_id','app_id','add_note'
    ];
}
