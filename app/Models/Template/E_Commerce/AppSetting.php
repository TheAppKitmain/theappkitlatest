<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $table = 'ecommerce_app_settings';

    protected $fillable = [
        'user_id', 'theme_name','template_id','nav_bg_color', 'nav_heading_color',
         'nav_heading_font', 'heading_color', 'heading_font', 'sub_heading_color', 'sub_heading_font', 'paragraph_color',
          'paragraph_font', 'primary_btn_color', 'primary_btn_font', 'primary_btnbg_color', 'success_btn_color', 'success_btn_font', 'success_btnbg_color',
          'danger_btn_color', 'danger_btn_font', 'danger_btnbg_color', 'screen_bg_color',
     ];
}
