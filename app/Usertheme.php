<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ThemeCategory;
use App\ThemeTemplate;

class Usertheme extends Model
{
    protected $fillable = ['user_id','user_category','user_template','template_id'];

    public function user(){
        return $this->belongsTo('App\User');
   }
     public function themeCategories(){
      return $this->hasMany('App\ThemeCategory','id','category_name');
   }
   public function themeTemplates(){
    return $this->hasMany('App\ThemeTemplate','id','template_name');
 }

}
