<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $fillable = [
        'user_id',
        'bug_type',
        'bug_estimated_time',
        'bug_estimated_date',
        'bugby',
        'bug_description',
        'bug_screenshot',
        'bugforclient',
    ];

    public function about_app()
    {
        return $this->hasOne('App\Aboutapp','id','app_id');
    }

}
