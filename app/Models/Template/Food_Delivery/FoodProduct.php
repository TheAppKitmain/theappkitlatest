<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodProduct extends Model
{
    protected $fillable = ['owner_id','template_id','product_name','category_id','price','product_image','short_description','long_description','status'];
    protected $hidden = ['product_qty','created_at','updated_at','status','product_stock'];



    public function categories()
    {
    	return $this->hasMany('App\Models\Template\Food_Delivery\FoodCategory','id','category_id');
    }

    public function shops()
    {
    	return $this->hasMany('App\Models\Template\Food_Delivery\FoodShop','id','shop_id');
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodCategory');
    }

	public function cart_item()
    {
    	return $this->belongsTo('App\Models\Template\Food_Delivery\FoodCartItem','id','product_id');
    }

    public function product_informations()
    {
        return $this->hasMany('App\Models\Template\Food_Delivery\FoodProductInformation','product_id');
    }

    public function product_images()
    {
        return $this->hasMany('App\Models\Template\Food_Delivery\FoodProductImage','product_id')->orderBy('id','desc');
    }

    public function featured_product()
    {
        return $this->hasOne('App\Models\Template\Food_Delivery\FoodFeaturedProduct')->orderBy('position','desc');
    }
}
