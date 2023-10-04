<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Model;

class TempPrivacyPolicy extends Model
{
    protected $fillable = [

        'owner_id','template_id','privacy_content',

    ];
}
