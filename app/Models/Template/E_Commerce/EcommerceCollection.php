<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class EcommerceCollection extends Model
{
    protected $fillable = [

        'user_id',
        'template_id',
        'collection_name',
        'slug',
        'collection_description',
        'collection_image',
        
    ];

    public function products(){
        return $this->belongsTo('App\Models\Template\E_Commerce\Product');
    }

}
