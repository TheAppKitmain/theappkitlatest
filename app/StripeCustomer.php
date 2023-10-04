<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeCustomer extends Model
{
    protected $fillable = [
        'stripe_customer_id','user_id',
    ];
}
