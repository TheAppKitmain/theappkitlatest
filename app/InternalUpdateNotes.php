<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalUpdateNotes extends Model
{
    protected $fillable = [
        'note_id','user_id','note_reply','status',
    ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');  
    }
}
