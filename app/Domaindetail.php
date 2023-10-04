<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domaindetail extends Model
{
    protected $fillable = [
        'user_id','domain_details', 'domain_provider', 'domain_email', 'domain_password','app_id'
    ];
}
