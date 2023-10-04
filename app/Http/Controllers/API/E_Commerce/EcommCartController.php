<?php

namespace App\Http\Controllers\API\E_Commerce;

use App\Http\Controllers\Controller;
use App\Models\Template\E_Commerce\EcommCart;
use App\Models\Template\E_Commerce\EcommCartDetail;
use Illuminate\Http\Request;
use Validator;

class EcommCartController extends Controller
{
    
    public function addtobag(Request $request)
	{
		$rules = [ 'owner_id'=>'required','product_id'=>'required','app_user_id'=>'required'];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {

            $cart = EcommCart::where('user_id',$request->user_id)->where('status', 0)->first();

				if(!is_null($cart))
				{
					$product = Product::find($request->product_id);

					if(!is_null($product)):

						if($product->product_type == "simple"):

							$item = EcommCartDetail::where('cart_id',$cart->id)->where('product_id',$request->product_id)->first();

							if(is_null($item)):

								$items = new EcommCartDetail;

								$items->product_id = $request->product_id;
								$items->qty = $request->qty;
								$items->cart_id = $cart->id;

								if($items->save())
								{
									return response()->json(['status'=>true,'message'=>'Items added in your cart.']);
								}
								else
								{
									return response()->json(['status'=>false,'message'=>'Something error while adding item in your cart.']);
								}
							else:
								$item->qty = $item->qty+1;
								if($item->save())
								{
									return response()->json(['status'=>true,'message'=>'Items updated in your cart.']);
								}
								else
								{
									return response()->json(['status'=>false,'message'=>'Something error while adding item in your cart.']);
								}
							endif;
						endif;

						if($product->product_type == "variable"):
							if(!empty($request->product_information_id)):
								$item = CartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->where('product_information_id',$request->product_information_id)->first();
								if(is_null($item)):
									$items = new CartItem;
									$items->product_id = $request->product_id;
									$items->product_information_id = $request->product_information_id;
									$items->qty = $request->qty;
									$items->cart_id = $cart->id;
									if($items->save())
									{
										return response()->json(['status'=>true,'message'=>'Items added in your cart.']);
									}
									else
									{
										return response()->json(['status'=>false,'message'=>'Something error while adding item in your cart.']);
									}
								else:
									$item->qty = $item->qty+1;
									if($item->save())
									{
										return response()->json(['status'=>true,'message'=>'Items updated in your cart.']);
									}
									else
									{
										return response()->json(['status'=>false,'message'=>'Something error while adding item in your cart.']);
									}
								endif;
							else:
								$item = CartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->first();
								if(is_null($item)):
									$items = new CartItem;
									$items->product_id = $request->product_id;
									$items->qty = $request->qty;
									$items->cart_id = $cart->id;
									if($items->save())
									{
										return response()->json(['status'=>true,'message'=>'Items added in your cart.']);
									}
									else
									{
										return response()->json(['status'=>false,'message'=>'Something error while adding item in your cart.']);
									}
								else:
									$item->qty = $item->qty+1;
									if($item->save())
									{
										return response()->json(['status'=>true,'message'=>'Items updated in your cart.']);
									}
									else
									{
										return response()->json(['status'=>false,'message'=>'Something error while adding item in your cart.']);
									}
								endif;
							endif;
						endif;
					else:
						return response()->json(['status'=>false,'message'=>'Product not found.']);
					endif;
				}
				else
				{
					$product = Product::find($request->product_id);
					if(!is_null($product)):
						$newCart = new Cart;
						$newCart->device_id = $request->device_id;
						$newCart->user_id = $request->user_id;
						$newCart->type = $request->type;
						if($newCart->save())
						{
							$items = new CartItem;
							$items->product_id = $request->product_id;
							if($product->product_type == "variable"):							
								$items->product_information_id = $request->product_information_id;
							endif;
							$items->qty = $request->qty;
							$items->cart_id = $newCart->id;
							if($items->save())
							{
								return response()->json(['status'=>true,'message'=>'Items added in your cart.']);
							}
							else
							{
								return response()->json(['status'=>false,'message'=>'Something error while adding item in your cart.']);
							}
						}
						else
						{
							return response()->json(['status'=>false,'message'=>'Something error while adding item in your cart.']);
						}
					else:
						return response()->json(['status'=>false,'message'=>'Product not found.']);
					endif;
				}
		
		}
	}

}
