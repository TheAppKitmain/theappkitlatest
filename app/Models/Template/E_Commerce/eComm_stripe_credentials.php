<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class eComm_stripe_credentials extends Model
{
    protected $table = 'e_comm_stripe_credentials';

    protected $fillable =['stripe_key', 'stripe_secret'];
}
