<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
	protected $table="timeline";
     protected $fillable = [
        'user_id',
        'app_id',
        'task_type',
        'task_description',
        'status',
    ];
}
