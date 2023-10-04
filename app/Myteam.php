<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myteam extends Model
{
    protected $fillable = [
        'member_name','member_designation', 'profile_image'
    ];
}
