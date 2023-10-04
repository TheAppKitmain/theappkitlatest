<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quote extends Model
{
    protected $fillable = [
        'user_id',
        'app_id',
        'quote_title',
        'quote_doc',
        'quote_price',
        'date',
        'status'
    ];

    public function tiers(){
        return $this->hasMany('App\QuoteTier','quote_id');
    }  

    public function user(){
        return $this->hasOne('App\User','id','user_id');  
    }
}
