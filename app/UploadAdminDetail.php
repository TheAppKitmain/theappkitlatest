<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadAdminDetail extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'password',
        'url'
    ];
}
