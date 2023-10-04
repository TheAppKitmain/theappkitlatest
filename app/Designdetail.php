<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designdetail extends Model
{
    protected $fillable = [
        'user_id','dp1', 'dp2', 'dp3', 'dp4', 'logo', 'design_details','xd_link'
    ];
}
