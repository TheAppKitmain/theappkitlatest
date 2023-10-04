<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogcategories extends Model
{
    protected $table = 'blogcategories';

    public function blog()
    {
        return $this->hasOne('App\Blog');
    }
}
