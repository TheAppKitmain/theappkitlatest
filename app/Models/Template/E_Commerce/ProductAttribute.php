<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = 'ecommerce_product_attributes';

    protected $fillable = [
        'user_id', 'product_id', 'variant_color', 'variant_size',
     ];
}
