<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutapp extends Model
{
    protected $fillable = [
        'app_id', 'app_name', 'user_id', 'wireframes', 'app_idea', 'idea', 'lookfor', 'website', 'platform_type', 'domain'
    ];

    public function designdetail()
    {
        return $this->hasOne('App\Designdetail', 'app_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function bug()
    {
        return $this->belongsTo('App\Bug');
    }
}
