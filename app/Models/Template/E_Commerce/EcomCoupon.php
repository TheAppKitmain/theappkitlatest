<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class EcomCoupon extends Model
{
    protected $table = 'ecom_coupons';

    protected $fillable =['coupon_code',
    'limit',
    'discount',
    'status',
    'owner_id',
    'template_id',
    'cart_amount',
    'discount_type',
    'limit',
    'status',
    'description'
];
}



