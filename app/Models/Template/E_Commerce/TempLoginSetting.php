<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class TempLoginSetting extends Model
{
    protected $table = 'ecommerce_temp_login_settings';

    protected $fillable = [
        'user_id','template_id', 'login_bg_image', 'login_bg_color', 'login_btn_color','login_btn_font_size'
     ];
}
