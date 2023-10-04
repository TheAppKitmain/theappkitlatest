<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'user_id', 'template_id', 'shipping_name','shipping_price',
     ];
}
