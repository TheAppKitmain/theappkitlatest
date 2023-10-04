<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        'owner_id',
        'template_id',
        'app_user_id',
        'cart_id',
        'cart_detail_id',
        'product_id',   
        'order_number',
        'total',
        'subtotal',
        'stripe_customer_id',
        'payment_status',
        'charge_id',
        'address_id',
        'delivery_at',
        
    ];

    public function app_user(){
        return $this->hasOne('App\Models\Template\E_Commerce\AppUser','id','app_user_id');    
    }

    public function products(){
        return $this->hasOne('App\Models\Template\E_Commerce\Product','id','product_id');  
    }
}
