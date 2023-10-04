<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignpm extends Model
{
    protected $table = 'assign_pm';
    protected $fillable = [
        'project_manager_id', 'customer_id'
    ];

    public function customers()
    {
        return $this->hasMany('App\User', 'id', 'customer_id');
    }
}
