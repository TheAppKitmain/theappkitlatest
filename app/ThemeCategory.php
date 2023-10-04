<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Usertheme;
use App\ThemeTemplate;

class ThemeCategory extends Model
{
    protected $fillable = [
        'category_name','slug',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function usertheme(){
        return $this->belongsTo('App\Usertheme');
    }

    public function themeTemplates(){
        return $this->hasMany('App\ThemeTemplate');
    }

    public function theme_template()
    {
        return $this->hasOne('App\ThemeTemplate');
    }
}
