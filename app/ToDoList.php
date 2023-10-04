<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    protected $fillable = [
        'owner_id',
        'user_id',
        'message',
        'status'  
    ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');  
    }
    public function owner(){
        return $this->hasOne('App\User','id','owner_id');  
    }
}
