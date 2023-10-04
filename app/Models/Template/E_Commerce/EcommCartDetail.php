<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class EcommCartDetail extends Model
{
    protected $fillable = ['cart_id','product_id', 'qty','price','size','color'];
    protected $hidden = ['created_at','updated_at'];

    public function cart()
    {
    	return $this->belongsTo('App\Models\Template\E_Commerce\EcommCart');
    }

    public function products(){
        return $this->hasOne('App\Models\Template\E_Commerce\Product','id','product_id');  
    }
}
