<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model
{
    protected $fillable = ['cart_id','app_user_id','template_id','apply_promo_id','order_no','total','subtotal','order_charges','order_customers','status','schedule'];
    protected $casts = ['order_charges' => 'json','order_customers'=>'json'];
    protected $appends = array('order_status');
    public function getCreatedAtAttribute($date)
    {
        // return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
        return \Carbon\Carbon::parse($date)->format('Y-m-d H:i:s');
    }
    public function getOrderStatusAttribute()
    {
        if($this->status == null)
        {
            return "Order Placed";
        }
        if($this->status == "0")
        {
            return "Confirmed";
        } 
        if($this->status == "1")
        {
            return "Completed";
        } 
        if($this->status == "2")
        {
            return "Delivered";
        }
    }



    public function user(){
        return $this->hasOne('App\Models\Template\Food_Delivery\FoodAppUser','id','app_user_id');    
    }

    public function cart()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodCart');
    }

    public function apply_promo()
    {
        return $this->belongsTo('App\Models\Template\Food_Delivery\ApplyFoodPromo');
    }
}
