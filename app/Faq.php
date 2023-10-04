<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question','answer'];
    protected $hidden = ['created_at','updated_at'];
}
