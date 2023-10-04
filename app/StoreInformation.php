<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreInformation extends Model
{
    protected $fillable = [
    'user_id','app_id','promotional_text','app_subtitle','keywords','support_url','marketing_url','app_description','age_rating','app_country',
    'privacy_policy_url','primary_language','primary_app_category','secondary_app_category','app_price','screenshots','first_name','last_name','email',
    'number','address','created_at','updated_at',
    ];
}
