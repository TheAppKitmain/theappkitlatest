<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalUpdates extends Model
{
    protected $fillable = [
        'user_id','customer_id', 'notes', 'status',
    ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');  
    }

    public function customer(){
        return $this->hasOne('App\User','id','customer_id');  
    }
}
