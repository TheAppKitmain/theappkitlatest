<?php

namespace App\Http\Controllers\API\E_Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\E_Commerce\AppUser;
use App\Models\Template\E_Commerce\EcomCoupon;
use App\Models\Template\E_Commerce\Product;
use App\Models\Template\E_Commerce\EcommCart;
use Validator;
use session;


class CouponController extends Controller{
public function index()
{
    $coupon = EcomCoupon::all();
    return response()->json(['success' => $coupon]);
}

public function Coupon_details()
{
    $current_date = date('Y-m-d ');
    $coupon = EcomCoupon::whereDate('to_date','>=',$current_date)->select('id','owner_id','template_id','coupon_code','discount','description')->get();
    if(count($coupon) == 0)
    {
        return response()->json(['status'=>false, 'message' => 'Coupon does not exist.']);
    }
    else{
            return response()->json(['status'=>true, 'success' => $coupon]);
         }

}

public function apply_coupon(Request $request){
    $rules = [
        'coupon_code' => 'required',
        'cart_id' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails())
    {
      return response()->json(['status' => false,'message' => $validator->errors()->first()]);
    }
    else
    {
     $total=0;
     $current_date = date('Y-m-d ');
     $user = AppUser::find(auth('app_user_api')->user()->id);
      if(!is_null($user))
    {
     $carts = EcommCart::where('app_user_id',$user->id)->where('status',0)->find($request->cart_id);

     if(!is_null($carts))
    {
        $total += $carts->sub_total;
        $couponDetails =EcomCoupon::where('coupon_code',$request['coupon_code'])->where('status',1)->first();
        if($couponDetails !== null)
      {
        $fromDate = date('Y-m-d',strtotime($couponDetails->from_date));
        $toDate = date('Y-m-d',strtotime($couponDetails->to_date));
        if( $current_date >= $fromDate  && $current_date <= $toDate )
        {
         if($carts->grand_total >= $couponDetails->cart_amount)
         {
          if($couponDetails->discount_type == "percentage")
          {
            $coupon_discount = $couponDetails->discount;
            $coupondiscount = ($total*$coupon_discount)/100;
          }
          else
          {
            $coupondiscount = $couponDetails->discount;
          }
          $discount =  (string)$coupondiscount;

          $sub_total = $carts->sub_total - $coupondiscount;
          session()->put('coupon_id',$couponDetails->id);
          $carts->coupon_id = $couponDetails->id;
          $carts->discount = $discount;
          //$carts->sub_total =  (string)$sub_total;
          $carts->grand_total =  (string)$sub_total;
          if(count($carts->cart_details)>0)
          {
            foreach($carts->cart_details as $detail)
            {
              $product = Product::find($detail->product_id);
              if(!is_null($product))
              {
                $detail->product_name = $product->product_name;
                $detail->product_description = $product->product_description;
                $detail->product_image = $product->product_image;
              }
              else
              {
                $detail->product_name = "";
                $detail->product_description = "";
                $detail->product_image = "";
              }
            }
          }
          return response()->json(['status'=>true,'message' => 'Coupon has been applied successfully.','cart_payload'=> $carts]);
        }
        else
        {
          return response()->json(['status'=>false, 'message' => 'You need to buy more products for apply this coupon.',]);
        }
    }
    else
      {
        return response()->json(['status'=>false, 'message' => 'Enter a valid coupon code.']);
      }
}
else
{
  return response()->json(['status'=>false, 'message' => 'coupon code is not valid.']);
}
}
else
{
  return response()->json(['status'=>false, 'message' => 'coupon code not applied.']);
}
}
else
    	{
    		return response()->json(['status'=>false,'message'=>'User not found']);
    	}
}
}

}
