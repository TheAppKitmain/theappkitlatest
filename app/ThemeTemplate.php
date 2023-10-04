<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Usertheme;
use App\ThemeCategory;

class ThemeTemplate extends Model
{
    protected $fillable = [
        'category_id','theme_name','slug','theme_details','theme_code','theme_screenshots','theme_thumbnail','monthly_gbp','yearly_gbp','monthly_usd','yearly_usd'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function usertheme(){
        return $this->belongsTo('App\Usertheme');
    }

    public function themeCategory(){
        return $this->belongsTo('App\ThemeCategory');
    }

    public function theme_category()
    {
        return $this->belongsTo('App\ThemeCategory','category_id');
    }
}
