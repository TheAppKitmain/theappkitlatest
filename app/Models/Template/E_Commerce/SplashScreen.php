<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class SplashScreen extends Model
{
    protected $table = 'ecommerce_splash_screens';

    protected $fillable = [
       'user_id', 'template_name','template_id', 'splash_logo', 'splash_background_image', 'splash_background_color'
    ];
}
