<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogmeta extends Model
{
    //
    public function blog()
    {
    	return $this->belongsTo('App\Blog');
    }
}
