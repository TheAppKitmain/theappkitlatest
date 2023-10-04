<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $table = 'ecom_shipping_address';

    protected $fillable = [
        'app_user_id','full_name','number','pincode', 'state','city', 'house_no', 'area', 'landmark','status',
     ];
}
