<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class TempSignupSetting extends Model
{
    protected $table = 'ecommerce_temp_signup_settings';

    protected $fillable = [

        'user_id','template_id', 'signup_bg_image', 'signup_bg_color', 'signup_btn_color','signup_btn_font_size','status',
        
    ];
}
