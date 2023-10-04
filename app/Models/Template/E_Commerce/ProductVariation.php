<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $table = 'ecommerce_product_variations';

    protected $fillable = [
        'user_id', 'product_id', 'variant_name','variant_price', 'variant_qty','variant_image',
     ];
}
