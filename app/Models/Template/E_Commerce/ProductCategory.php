<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'ecommerce_product_categories';

    protected $fillable = [
        'user_id','product_id','collection_id', 
    ];
}
