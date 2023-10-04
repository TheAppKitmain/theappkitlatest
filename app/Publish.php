<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publish extends Model
{
    protected $fillable = [
        'user_id', 'app_details','about_app',
    ];
}
