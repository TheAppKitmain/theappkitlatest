<?php

namespace App\Http\Controllers\API\Food_Delivery;

use Illuminate\Http\Request;
use App\Models\Template\Food_Delivery\ApplyFoodPromo;
use App\Models\Template\Food_Delivery\FoodCartItem;
use App\Models\Template\Food_Delivery\FoodProduct;
use App\Models\Template\Food_Delivery\FoodCategory;
use App\Models\Template\Food_Delivery\FoodPromo;
use App\Models\Template\Food_Delivery\FoodCart;
use App\Models\Template\Food_Delivery\FoodShop;
use App\Models\Template\Food_Delivery\FoodWorkingday;
use App\Models\Template\Food_Delivery\FoodProductInformation;
use App\Models\Template\Food_Delivery\FoodAppUser;
use Validator;
use Auth;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
	public function addToCart(Request $request)
	{
		
		$rules = [ 'device_id'=>'required','product_id'=>'required','qty'=>'required','type'=>'required','user_id'=>'required' ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
        	// Europe/London
			$today_datetime = \Carbon\Carbon::now('Europe/London');
			$today_date = $today_datetime->toDateString();
			$day = \Carbon\Carbon::parse($today_date)->format('l');
			$days = FoodWorkingday::where('day_name',$day)->where('status','active')->first();
 
        	if(!is_null($days))
			{
	        	$today_datetime = \Carbon\Carbon::now('Europe/London');
	        	$today_date = $today_datetime->toDateString();
	        	$start_datetime = date('H:i',strtotime($days->start_time));
				$end_datetime = date('H:i',strtotime($days->end_time));
	        	$datetime = $today_datetime->format('H:i');
	        	$prev_date = \Carbon\Carbon::now()->subDay(1);

				if($datetime >= $start_datetime && $datetime < $end_datetime)
	        	{  
					if($request->type == "device"):
						$cart = FoodCart::where('device_id',$request->device_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->whereStatus("0")->first();
					else:
						$cart = FoodCart::where('app_user_id',$request->user_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->whereStatus("0")->first();
					endif;

					if(!is_null($cart))
					{
						$product = FoodProduct::find($request->product_id);
						if(!is_null($product)):
							if($product->product_type == "simple"):
								$item = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->first();
								if(is_null($item)):
									$items = new FoodCartItem;
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
									$item = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->where('product_information_id',$request->product_information_id)->first();
									if(is_null($item)):
										$items = new FoodCartItem;
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
									$item = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->first();
									if(is_null($item)):
										$items = new FoodCartItem;
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
						$product = FoodProduct::find($request->product_id);
						if(!is_null($product)):
							$newCart = new FoodCart;
							$newCart->device_id = $request->device_id;
							if($request->user_id != "0"):
								$newCart->app_user_id = $request->user_id;
							endif;	
							$newCart->type = $request->type;
							if($newCart->save())
							{
								$items = new FoodCartItem;
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
				}elseif($datetime >= $start_datetime || $datetime < $end_datetime){

					if($request->type == "device"):
						$cart = FoodCart::where('device_id',$request->device_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->whereStatus("0")->first();
					else:
						$cart = FoodCart::where('app_user_id',$request->user_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->whereStatus("0")->first();
					endif;

					if(!is_null($cart))
					{
						$product = FoodProduct::find($request->product_id);
						if(!is_null($product)):
							if($product->product_type == "simple"):
								$item = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->first();
								if(is_null($item)):
									$items = new FoodCartItem;
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
									$item = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->where('product_information_id',$request->product_information_id)->first();
									if(is_null($item)):
										$items = new FoodCartItem;
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
									$item = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->first();
									if(is_null($item)):
										$items = new FoodCartItem;
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
						$product = FoodProduct::find($request->product_id);
						if(!is_null($product)):
							$newCart = new FoodCart;
							$newCart->device_id = $request->device_id;
							if($request->user_id != "0"):
								$newCart->app_user_id = $request->user_id;
							endif;	
							$newCart->type = $request->type;
							if($newCart->save())
							{
								$items = new FoodCartItem;
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
	        	else
	        	{
	        		return response()->json(['status'=>false,'message'=>"Sorry, You can't order at this time.",'start_datetime'=>$start_datetime,'end_datetime'=>$end_datetime]);
	        	}
	        }
		
	        else
        	{
        		return response()->json(['status'=>false,'message'=>"Sorry! We’re closed right now. We open at 5, see you then!!"]);
        	}

		}
	}
	
	public function updateCart(Request $request)
	{
		$rules = [ 'device_id'=>'required','product_id'=>'required','qty'=>'required','type'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
        	$today_datetime = \Carbon\Carbon::now('Europe/London');
			$today_date = $today_datetime->toDateString();
			$day = \Carbon\Carbon::parse($today_date)->format('l');
			$days = FoodWorkingday::where('day_name',$day)->where('status','active')->first();

			if(!is_null($days))
			{
	        	$today_datetime = \Carbon\Carbon::now('Europe/London');
	        	$today_date = $today_datetime->toDateString();
	        	$start_datetime = date('H:i',strtotime($days->start_time));
				$end_datetime = date('H:i',strtotime($days->end_time));
	        	$datetime = $today_datetime->format('H:i');
	        	$prev_date = \Carbon\Carbon::now()->subDay(1);
	        	$sameer = 10;
				if($datetime >= $start_datetime && $datetime < $end_datetime)
	        	// if($sameer == 10)
	        	{  
					//$request->user_id = isset($request->user_id) ?? null;
					if($request->type == "device"):
						$cart = FoodCart::where('device_id',$request->device_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->whereStatus("0")->first();
					else:
						$cart = FoodCart::where('app_user_id',$request->user_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->whereStatus("0")->first();
					endif;

					if(!is_null($cart))
					{
						$product = FoodProduct::find($request->product_id);
						if(!is_null($product)):
							if($product->product_type == "variable" && !empty($request->product_information_id)):
								$items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->where('product_information_id',$request->product_information_id)->first();
							else:
								$items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->first();
							endif;
							if(!is_null($items))
							{
								$items->qty = $request->qty;
								$items->save();
								return response()->json(['status'=>true,'message'=>'Items updated in your cart.']);
							}
							else
							{
								return response()->json(['status'=>false,'message'=>'Item not found in your cart.']);
							}
						else:
							return response()->json(['status'=>false,'message'=>'Product not found.']);
						endif;
					}
					else
					{
						return response()->json(['status'=>false,'message'=>'Something error while updating item in your cart.']);
					}
				}
				else
				{
					return response()->json(['status'=>false,'message'=>"Sorry, You can't order at this time.",'start_datetime'=>$start_datetime,'end_datetime'=>$end_datetime]);
				}
			}
			else
			{
				return response()->json(['status'=>false,'message'=>"Sorry! We’re closed right now. We open at 5, see you then!!"]);
			}
		}

	}
	
	public function deleteCart(Request $request)
	{
		$rules = [ 'device_id'=>'required','product_id'=>'required','type'=>'required','user_id'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
        	$today_datetime = \Carbon\Carbon::now('Europe/London');
        	$today_date = $today_datetime->toDateString();
        	$prev_date = \Carbon\Carbon::now()->subDay(1);
			//$request->user_id = isset($request->user_id) ?? null;
			if($request->type == "device"):
				$cart = FoodCart::where('device_id',$request->device_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->whereStatus("0")->first();
			else:
				$cart = FoodCart::where('app_user_id',$request->user_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->where('status',"0")->first();
			endif;
			if(!is_null($cart))
			{
				if(isset($request->product_information_id) && !empty($request->product_information_id)):
				$items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->where('product_information_id',$request->product_information_id)->first();
				else:
				$items = FoodCartItem::where('cart_id',$cart->id)->where('product_id',$request->product_id)->first();
				endif;
				if(!is_null($items))
				{
					$items->delete();
					return response()->json(['status'=>true,'message'=>'Items removed from your cart.']);
				}
				else
				{
					return response()->json(['status'=>false,'message'=>'You have not items in your cart.']);
				}
			}
			else
			{
				return response()->json(['status'=>false,'message'=>'Something error while deleting item in your cart.']);
			}
		}
	}
	
	public function cart(Request $request)
	{
		$rules = [ 'device_id'=>'required','type'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
        	$today_datetime = \Carbon\Carbon::now('Europe/London');
        	$today_date = $today_datetime->toDateString();
        	$prev_date = \Carbon\Carbon::now()->subDay(1);
        	$total=0; $total_qty=0;
			$charge_amount = "2";
			//$request->user_id = isset($request->user_id) ?? null;
			if($request->type == "device"):
				$cart = FoodCart::where('device_id',$request->device_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->whereStatus("0")->first();
			else:
				$cart = FoodCart::where('app_user_id',$request->user_id)->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->whereStatus("0")->first();
			endif;
			$results = FoodShop::first();
			$currency =  html_entity_decode($results->currency_symbol);
			if(!is_null($cart))
			{
				$items = FoodCartItem::where('cart_id',$cart->id)->get();
				if(count($items)>0)
				{
					foreach($items as $item):
						$products = FoodProduct::find($item->product_id);
						if(!is_null($item->product_information_id)):
							$variation = FoodProductInformation::find($item->product_information_id);
							$products->product_informations = $variation;
							$total += $variation->product_price * $item->qty;
						endif;
						if(is_null($products->product_image)):
	                        $products->product_image = asset('images/default.jpg');
	                    endif;
						$item->product = $products;
						$total += $products->price * $item->qty;
						$total_qty += $item->qty;
					endforeach;
					if($total <= "7.5"){
						$results->delivery_charges += $charge_amount;
						$results->delivery_charges = (string)$results->delivery_charges;	
					}
					$grand_total = $results->delivery_charges+$total;
					return response()->json(['status'=>true,'message'=>'Items in your cart.','payload'=>array('products'=>$items,'currency'=>$currency,"total"=>number_format($total,2),"cart_id"=>$cart->id,"delivery_charges"=>$results->delivery_charges,"grand_total"=>number_format($grand_total,2),'total_qty'=>$total_qty)]);
				}
				else
				{
					return response()->json(['status'=>false,'message'=>'No cart items found.']);
				}
			}
			else
			{
				return response()->json(['status'=>false,'message'=>'You have no cart item.']);
			}
		}
	}

	public function promo(Request $request)
	{
		$rules = ['promo_code'=>'required','total'=>'required','cart_id'=>'required|integer'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
        	$today_datetime = \Carbon\Carbon::now('Europe/London');
        	$today_date = $today_datetime->toDateString();
        	$prev_date = \Carbon\Carbon::now()->subDay(1);
        	$user = FoodAppUser::find(Auth::guard('food_app_user_api')->user()->id);
      		if(!is_null($user)):
      			$cart = FoodCart::where('status','0')->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->find($request->cart_id);
      			$results = FoodShop::first();
      			$subtotal = 0;
				$promo_charge_amount = "2"; 
      			if(!is_null($cart)):
					$promo = FoodPromo::wherePromoCode($request->promo_code)->whereStatus('active')->first();
					if(!is_null($promo)):
						$apply_promo = ApplyFoodPromo::wherePromoId($promo->id)->where('app_user_id',$user->id)->first();
						if(!is_null($apply_promo)):
							if($apply_promo->promo->user_limit == "single"):
								return response()->json(['status'=>false,'message'=>'Promo code already applied.']);
							else:
								$currency =  html_entity_decode($results->currency_symbol);
								$items = FoodCartItem::where('cart_id',$cart->id)->get();
								if(count($items)>0)
								{
									foreach($items as $item):
										$products = FoodProduct::find($item->product_id);
										if(!is_null($item->product_information_id)):
											$variation = FoodProductInformation::find($item->product_information_id);
											$subtotal += $variation->product_price * $item->qty;
										endif;
										$subtotal += $products->price * $item->qty;
									endforeach;
								}
								if($promo->promo_type == "discount"):
									$promo->total = $currency."".$subtotal;
				        			$discount_price = ($subtotal*$promo->discount)/100;
				        			$total = $subtotal-$discount_price;
									if($total <= "7.5"){
										$results->delivery_charges += $promo_charge_amount;
										$results->delivery_charges = (string)$results->delivery_charges;		
									}
									$promo->delivery_charges = $results->delivery_charges;
				        			$grand_total=$total+$results->delivery_charges;
				        			$promo->grand_total = $currency."".number_format($grand_total,2);
				        			$promo->discount_price = $currency."".number_format($discount_price,2);
				        			$promo->discount = $promo->discount."%";
				        			$promo->makeHidden(['description','amount','cart_amount']);
				        			session(['promo' => $promo]);
				        			return response()->json(['status'=>true,'message'=>'Your promo code has been applied.','payload'=>$promo]);
			        			endif;
			        			if($promo->promo_type == "amount"):
			        				if($subtotal >= $promo->cart_amount)
			        				{
			        					$promo->total = $currency."".$subtotal;
			        					$total = $subtotal-$promo->amount;
										if($total <= "7.5"){
											$results->delivery_charges += $promo_charge_amount;
											$results->delivery_charges = (string)$results->delivery_charges;		
										}
										$promo->delivery_charges = $results->delivery_charges;
			        					$grand_total=$total+$results->delivery_charges;
			        					$promo->grand_total = $currency."".number_format($grand_total,2);
			        					$promo->discount_price = $currency."".number_format($promo->amount,2);
			        					$promo->makeHidden(['description','discount']);
			        					return response()->json(['status'=>true,'message'=>'Your promo code has been applied.','payload'=>$promo]);
			        				}
			        				else
			        				{
			        					return response()->json(['status'=>false,'message'=>'Your promo code is not applied. Please buy more products to apply this promo.']);
			        				}
			        			endif;
							endif;
						else:
							$currency =  html_entity_decode($results->currency_symbol);
							$items = FoodCartItem::where('cart_id',$cart->id)->get();
							if(count($items)>0)
							{
								foreach($items as $item):
									$products = FoodProduct::find($item->product_id);
									if(!is_null($item->product_information_id)):
										$variation = FoodProductInformation::find($item->product_information_id);
										$subtotal += $variation->product_price * $item->qty;
									endif;
									$subtotal += $products->price * $item->qty;
								endforeach;
							}
							if($promo->promo_type == "discount"):
								$promo->total = $currency."".$subtotal;
			        			$discount_price = ($subtotal*$promo->discount)/100;
			        			$total = $subtotal-$discount_price;
								if($subtotal <= "7.5"){
									$results->delivery_charges += $promo_charge_amount;
									$results->delivery_charges = (string)$results->delivery_charges;		
								}
								$promo->delivery_charges = $results->delivery_charges;
			        			$grand_total=$total+$results->delivery_charges;
			        			$promo->grand_total = $currency."".number_format($grand_total,2);
			        			$promo->discount_price = $currency."".number_format($discount_price,2);
			        			$promo->discount = $promo->discount."%";
			        			$promo->makeHidden(['description','amount','cart_amount']);
			        			session(['promo' => $promo]);
			        			return response()->json(['status'=>true,'message'=>'Your promo code has been applied.','payload'=>$promo]);
		        			endif;
		        			if($promo->promo_type == "amount"):
		        				if($subtotal >= $promo->cart_amount)
		        				{
		        					$promo->total = $currency."".$subtotal;
		        					$total = $subtotal-$promo->amount;
									if($subtotal <= "7.5"){
										$results->delivery_charges += $promo_charge_amount;
										$results->delivery_charges = (string)$results->delivery_charges;		
									}
									$promo->delivery_charges = $results->delivery_charges;
		        					$grand_total=$total+$results->delivery_charges;
		        					$promo->grand_total = $currency."".number_format($grand_total,2);
		        					$promo->discount_price = $currency."".number_format($promo->amount,2);
		        					$promo->makeHidden(['description','discount']);
		        					return response()->json(['status'=>true,'message'=>'Your promo code has been applied.','payload'=>$promo]);
		        				}
		        				else
		        				{
		        					return response()->json(['status'=>false,'message'=>'Your promo code is not applied. Please buy more products to apply this promo.']);
		        				}
		        			endif;

		        		endif;
		        	else:
				        return response()->json(['status'=>false,'message'=>'Promo code not found.']);
				    endif;
			    else:
			    	return response()->json(['status'=>false,'message'=>'cart not found.']);
			    endif;
        	else:
        		return response()->json(['status'=>false,'message'=>'User not found.']);
        	endif;
        }
	}

	public function review_basket(Request $request)
	{
		$rules = [ 'cart_id'=>'required|integer'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
        	$today_datetime = \Carbon\Carbon::now('Europe/London');
        	$today_date = $today_datetime->toDateString();
        	$prev_date = \Carbon\Carbon::now()->subDay(1);
        	$total=0;
			$charge_amount = "2";
        	$user = FoodAppUser::find(Auth::guard('food_app_user_api')->user()->id);
      		if(!is_null($user)):
      			$results = FoodShop::first();
				$currency =  html_entity_decode($results->currency_symbol);
				$cart = FoodCart::where('status','0')->whereBetween(\DB::raw('DATE(created_at)'),[$prev_date->toDateString(),$today_date])->find($request->cart_id);
      			if(!is_null($cart)):
      				//if(is_null($cart->user_id)):
	      				$cart->app_user_id = $user->id;
	      				$cart->type = "user";
	      				$cart->save();
	      			//endif;
      				$items = FoodCartItem::where('cart_id',$cart->id)->get();
					$havealcohol = 0; 
					if(count($items)>0)
					{
						foreach($items as $item):
							$item->qty = (int)$item->qty;
							$products = FoodProduct::find($item->product_id);

							$category = FoodCategory::where('id',$products->category_id)->first();

							if($category->parent_id == 1):	
								$products->alcohol = 1;
							else:
								$products->alcohol = 0;
							endif;

							if($products->alcohol == 1){
								$havealcohol = 1;
							}

							$products->price = (float)$products->price;
							if(!is_null($item->product_information_id)):
								$variation = FoodProductInformation::find($item->product_information_id);
								$variation->product_price = (float)$variation->product_price;
								$products->product_informations = $variation;
								$total += $variation->product_price * $item->qty;
							endif;
							if(is_null($products->product_image)):
		                        $products->product_image = asset('images/default.jpg');
		                    endif;
							$item->product = $products;
							$total += $products->price * $item->qty;
						endforeach;
						if($total <= "7.5"){
							$results->delivery_charges += $charge_amount;
							$results->delivery_charges = (string)$results->delivery_charges;		
						}
						$grand_total = $total+$results->delivery_charges;

						return response()->json(['status'=>true,'message'=>'Items in your cart.','payload'=>array('products'=>$items,'alcohol'=>$havealcohol,'currency'=>$currency,"total"=>number_format($total,2),"delivery_charges"=>$results->delivery_charges,"grand_total"=>number_format($grand_total,2))]);
					}
					else
					{
						return response()->json(['status'=>false,'message'=>'No cart items found.']);
					}
      			else:
      				return response()->json(['status'=>false,"message"=>'Cart not found.']);
      			endif;
      		else:
      			return response()->json(['status'=>false,"message"=>'User not found.']);
      		endif;
        }
    }
}