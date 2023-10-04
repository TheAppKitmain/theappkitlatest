<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateOTP extends Model
{
    public function app_user()
    {
    	return $this->belongsTo('App\Models\Template\E_Commerce\AppUser');
    }
}
