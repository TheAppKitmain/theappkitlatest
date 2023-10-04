<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OurWork extends Model
{
    protected $fillable = [
        'app_name','app_logo', 'app_type','app_screenshots','app_reviews', 'client_name', 'client_designation','app_android_link','app_links'
    ];
}
