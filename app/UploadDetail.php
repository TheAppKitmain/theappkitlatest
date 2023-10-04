<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadDetail extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'password'  
    ];
}
