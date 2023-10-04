<?php

namespace App\Models\Template\E_Commerce;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'ecommerce_products';
    
    protected $fillable = [
        'user_id',
        'template_id',
        'collection_id',
        'product_name',
        'slug',
        'product_description',
        'product_image',
        'product_display_image_1',
        'product_display_image_2',
        'product_display_image_3',
        'product_price',
        'sale_price',
        'stock_unit',
        'stock_qty',
        'product_type',
        'shipping_weight',
        'shipping_length',
        'shipping_width',
        'shipping_height',
    ];
   
    public function get_collection_name(){
        return $this->hasOne('App\Models\Template\E_Commerce\EcommerceCollection','id','collection_id');  
    }

    public function carts(){
        return $this->belongsTo('App\Models\Template\E_Commerce\EcommCartDetail');
    }

    public function orders(){
        return $this->belongsTo('App\Models\Template\E_Commerce\Order');
    }
    
}
