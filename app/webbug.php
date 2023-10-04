<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webbug extends Model
{
    
     protected $fillable = [
     	'user_id',
        'bug_type',
        'bug_description',
        'bug_screenshot',
        'status',
    ];
}
