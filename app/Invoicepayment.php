<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoicepayment extends Model
{
    protected $fillable = [
        'user_id','invoice_link',
    ];
}
