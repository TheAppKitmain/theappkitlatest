<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Payment_card extends Model
{
    protected $fillable = [
        'first_name','last_name','card_number','expiry_date','security_code', 'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
     }
}
