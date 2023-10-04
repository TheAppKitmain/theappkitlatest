<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    protected $fillable = [

        'user_id','privacy_title','privacy_content',

    ];
    
}
