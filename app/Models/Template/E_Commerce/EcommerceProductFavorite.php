<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class EcommerceProductFavorite extends Model
{
    protected $fillable = [
        'app_user_id',
        'product_id',    
    ];
}
