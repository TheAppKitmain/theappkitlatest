<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class EcommCart extends Model
{
    protected $fillable = [ 'owner_id','app_user_id', 'template_id','coupon_id','discount','sub_total','grand_total','status'];
    protected $hidden = ['created_at','updated_at'];
    public function cart_details()
    {
    	return $this->hasMany('App\Models\Template\E_Commerce\EcommCartDetail','cart_id');
    }
}
