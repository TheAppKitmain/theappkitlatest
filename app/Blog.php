<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    public function blog_meta()
    {
        return $this->hasOne('App\Blogmeta');
    }

    public function blogcategory()
    {
    	return $this->belongsTo('App\Blogcategories');
    }
}
