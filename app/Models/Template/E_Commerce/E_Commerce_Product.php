<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class E_Commerce_Product extends Model
{
    protected $table = 'e_commerce_products';

    protected $fillable = [
        'owner_id','product_id', 'collection_name','updated_at','created_at',
    ];

    protected $connection = 'mysql2';
}
