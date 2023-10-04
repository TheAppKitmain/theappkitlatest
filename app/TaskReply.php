<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskReply extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
        'task_reply',
        'status'  
    ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');  
    }
}


