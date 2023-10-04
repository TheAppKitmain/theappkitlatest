<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testbuild extends Model
{
     protected $fillable = ['user_id','app_id','androidbuild', 'iosbuild','status_i','status_a'];
}
