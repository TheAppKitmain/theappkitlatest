<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class E_Commerce_Owner extends Model
{
    
     protected $table = 'e_commerce_owner';

     protected $fillable = [
        'owner_id','busniess_name', 'email','updated_at','created_at'
    ];

    protected $connection = 'mysql2';
}
