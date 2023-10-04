<?php

namespace App\Http\Controllers\API\Food_Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\Food_Delivery\FoodCategory;
use App\Models\Template\Food_Delivery\FoodShop;
use App\Models\Template\Food_Delivery\FoodProduct;
use App\Models\Template\Food_Delivery\FoodCart;
use App\Models\Template\Food_Delivery\FoodCartItem;
use Validator;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        $rules = [ 'category_id'=>'required|integer'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $category = FoodCategory::with('children:parent_id,id,name,image')->where('status','active')->find($request->category_id,['id','name','image']);
            $results = FoodShop::first();
            $currency =  html_entity_decode($results->currency_symbol);
            if(!is_null($category))
            {
                $ids = $category->children->pluck('id')->toArray();
                $cat_id = (integer)$category->id;
                array_unshift($ids,$cat_id);
                $products = FoodProduct::with('product_informations','product_images')->where('status','active')->whereRaw('FIND_IN_SET(?,category_id)', [$ids])->orderByRaw('position = 0', 'ASC', 'position')->paginate(10);
                if(count($products)>0)
                {
                    foreach($products as $product):
                        $product->qty = 1;
                        if(count($product->product_informations)>0):
                            $variation_id = $product->product_informations->pluck('id')->first();
                            $product->product_information_id = $variation_id;
                        endif;
                        if(is_null($product->product_image)):
                            $product->product_image = asset('images/default.jpg');
                        endif;
                        if(isset($request->device_id) && !empty($request->device_id) || isset($request->user_id)):
                            if(isset($request->user_id) && !empty($request->user_id)):
                                $cart = FoodCart::where('user_id',$request->user_id)->whereStatus("0")->first();
                            else:
                                $cart = FoodCart::where('device_id',$request->device_id)->whereStatus("0")->first();
                            endif;
                            if(!is_null($cart)):
                                $cart_items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$product->id)->get();
                                $product->cart_items = $cart_items;
                            endif;
                        endif;
                    endforeach;
                    return response()->json(['status'=>true,'payload'=>array("categories"=>$category,"products"=>$products),'currency'=>$currency,'message'=>'List of all products.']);
                }
                else
                {
                    return response()->json(['status'=>false,'message'=>'No product found.']);
                }
            }
            else
            {
                return response()->json(['status'=>false,'message'=>'No category found.']);
            }
        }
    }
}
