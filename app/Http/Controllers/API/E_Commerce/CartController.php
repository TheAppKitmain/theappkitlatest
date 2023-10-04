<?php

namespace App\Http\Controllers\API\E_Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Template\E_Commerce\AppUser;
use App\Models\Template\E_Commerce\Product;
use App\Models\Template\E_Commerce\ProductVariation;
use App\Models\Template\E_Commerce\EcommCart;
use App\Models\Template\E_Commerce\EcommCartDetail;
use App\Models\Template\E_Commerce\ShippingAddress;
use App\Models\Template\E_Commerce\EcomCoupon;
use App\Models\Template\E_Commerce\Shipping;
use session;
use Auth;

class CartController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:app_user')->except('logout');
    }

	public function add_to_cart(Request $request)
    {
    	$rules = ['owner_id'=>'required','template_id'=>'required','product_id'=>'required','qty'=>'required','price'=>'required','type'=>'required'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $total = 0;
        	$user = AppUser::find(auth('app_user_api')->user()->id);
        	if(!is_null($user))
        	{
				session()->put('coupon_id',0);

        		$product = Product::find($request->product_id);
				$carts = EcommCart::with('cart_details')->where('app_user_id',$user->id)->where('status',0)->first();

				$carts->product_count = EcommCartDetail::where('cart_id',$carts->id)->count();

				if(session('address_id') != null){
				$address_id = session('address_id');
					$address =  ShippingAddress::where('id',$address_id)->where('status',0)->where('is_default',1)->first();
				}else{
					$address =  ShippingAddress::where('app_user_id',$user->id)->where('status',0)->where('is_default',1)->first();
				}

				$shipping =  Shipping::where('user_id',$user->owner_id)->where('template_id',$user->template_id)->first();

        		if(!is_null($product))
        		{
        			$price = $request->price*$request->qty;

        			$carts = EcommCart::where('app_user_id',$user->id)->where('status',0)->first();
	        		if(!is_null($carts))
	        		{
                        $cart_detail =  EcommCartDetail::where('cart_id',$carts->id)->where('product_id',$product->id)->first();

						if(!is_null($cart_detail))
                        {
                            $product_added = True;

                        }else{
							$product_added = False;
						}

                        if(!is_null($cart_detail))
                        {
                            if($request->qty == 1 && $request->type == "add")
                            {
                                $request['qty'] = $request->qty+1;
                            }
							
                        }   

	        			EcommCartDetail::updateOrCreate(['product_id'=>$product->id,'cart_id'=>$carts->id],['qty'=>$request->qty,'price'=>$request->price,'size'=>$request->size ?? null,'color'=>$request->color ?? null]);
						
	        			$cart_details = EcommCartDetail::where('cart_id',$carts->id)->get();

                        if(count($cart_details)>0)
                        {
                            foreach($cart_details as $detail)
                            {
                                $total += $detail->price*$detail->qty;
                            }
                        }
	        			$carts->sub_total = $total;
	        			$carts->grand_total = $total;
	        			$carts->save();

	        		}
	        		else
	        		{
	        			$cart = EcommCart::create(['app_user_id'=>$user->id,'owner_id'=>$request->owner_id,'template_id'=>$request->template_id,'sub_total'=>$price,'grand_total'=>$price,'status'=>0]);
	        			EcommCartDetail::create(['product_id'=>$product->id,'cart_id'=>$cart->id,'qty'=>$request->qty,'price'=>$request->price,'size'=>$request->size ?? null,'color'=>$request->color ?? null]);
						$product_added = True;
	        		}

	        		return response()->json(['status'=>true, 'cart_details' => $cart_details , 'product_added' => $product_added ,'message'=>'Your product has been added to the cart.']);
        		}
        		else
        		{
        			return response()->json(['status'=>false,'message'=>'No product found']);
        		}
        	}
        	else
        	{
        		return response()->json(['status'=>false,'message'=>'User not found']);
        	}
        }
    }

    public function remove_cart(Request $request)
    {
    	$rules = ['cart_detail_id'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
	    	$user = AppUser::find(auth('app_user_api')->user()->id);
	    	if(!is_null($user))
	    	{
				$total = 0;
	    		$detail = EcommCartDetail::find($request->cart_detail_id);
	    		if(!is_null($detail))
	    		{
					$cart = EcommCart::find($detail->cart_id);
					if(!is_null($cart))
					{
						session()->put('coupon_id',0);
						$detail->delete();
						$cart_details = EcommCartDetail::where('cart_id',$cart->id)->get();
                        if(count($cart_details)>0)
                        {
                            foreach($cart_details as $detail)
                            {
                                $total += $detail->price*$detail->qty;
                            }
                        }
						$cart->sub_total = $total;
						$cart->grand_total = $total;
						$cart->save();

						return response()->json(['status'=>true, 'cart_details' => $cart_details, 'message'=>'Item has been removed from the cart.']);
					}
	    			else
					{
						return response()->json(['status'=>false,'message'=>'Cart not found']);
					}
	    		}
	    		else
	    		{
	    			return response()->json(['status'=>false,'message'=>'Cart item not found']);
	    		}
	    	}
	    	else
	    	{
	    		return response()->json(['status'=>false,'message'=>'User not found']);
	    	}
	    }
    }

	public function address()
    {
		$app_user_id =  Auth::guard('app_user_api')->user()->id;		
		$address =  ShippingAddress::where('app_user_id',$app_user_id)->where('status',0)->get();
		
		if(count($address) == 0){
            return response()->json(['status'=>False,'address' => $address]);
        }
        else{
            return response()->json(['status'=>True,'address' => $address]);
        }
    }

	public function storeaddress(Request $request)
    {
		$rules = [
            'full_name' => ['required', 'string', 'max:255'],
            'number' => ['required'],
            'pincode' => ['required'],
			'state' => ['required', 'string', 'max:255'],
			'city' => ['required', 'string', 'max:255'],
			'house_no' => ['required', 'string', 'max:255'],
			'area' => ['required', 'string', 'max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);

		$app_user_id =  Auth::guard('app_user_api')->user()->id;		

	    if ($validator->fails())
	    {
	      return response()->json(['status' => false,'message' => $validator->errors()->first()]);
	    }
	    else
	    {
            $shipping_address =  ShippingAddress::create([

				'app_user_id' => $app_user_id,
                'full_name' => $request['full_name'],
                'number' => $request['number'],
				'pincode' => $request['pincode'],
				'state' => $request['state'],
				'city' => $request['city'],
				'house_no' => $request['house_no'],
				'area' => $request['area'],
                'landmark' => $request['landmark'],
                

            ]);

            return response()->json(['status'=>True, "message" => "address is created"]);
        }

    }

	public function storeaddressupdate(Request $request)
    {
		$rules = [
            'full_name' => ['required', 'string', 'max:255'],
            'number' => ['required'],
            'pincode' => ['required'],
			'state' => ['required', 'string', 'max:255'],
			'city' => ['required', 'string', 'max:255'],
			'house_no' => ['required', 'string', 'max:255'],
			'area' => ['required', 'string', 'max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);
		
	    if ($validator->fails())
	    {
	      return response()->json(['status' => false,'message' => $validator->errors()->first()]);
	    }
	    else
	    {
            ShippingAddress::where('id',$request->id)->update([

                'full_name' => $request['full_name'],
                'number' => $request['number'],
				'pincode' => $request['pincode'],
				'state' => $request['state'],
				'city' => $request['city'],
				'house_no' => $request['house_no'],
				'area' => $request['area'],
                'landmark' => $request['landmark'],
                

            ]);

            return response()->json(['status'=>True, "message" => "address is updated"]);
        }

    }

	public function deleteaddress(Request $request)
    {
		$address =  ShippingAddress::where('id',$request->id)->first();

		ShippingAddress::whereId($request->id)->update(['status'=>'1']);
		
		if(count($address) == 0){
            return response()->json(['status'=>False,"message" => "address is not deleted"]);
        }
        else{
            return response()->json(['status'=>True,"message" => "address is deleted"]);
        }
    }

	public function showaddress(Request $request)
    {
		session()->put('address_id',$request->id);

		ShippingAddress::whereId($request->id)->update(['is_default'=>'1']);

		$address =  ShippingAddress::where('id',$request->id)->where('status',0)->first();
	
        return response()->json(['status'=>True,'address' => $address]);
        
    }

	public function apply_coupon(Request $request)
	{
		$rules = [ 'coupon_code' => 'required','cart_id' => 'required', ];
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
								session(['coupon_id'=>$couponDetails->id]);
								$carts->coupon_id = $couponDetails->id;
								$carts->discount = $discount;
								$carts->coupon_name = $couponDetails->coupon_code;
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
										if(!is_null($detail->color))
										{
											$variant_name = $detail->color.'/'.$detail->size;
											$productvariant =  ProductVariation::where('product_id',$detail->product_id)->where('variant_name',$variant_name)->first(); 
											if(!is_null($productvariant)){
												$detail->product_image = $productvariant->variant_image;	
											}else{
												$detail->product_image = $product->product_image;
											}												
										}
										else
										{
											$detail->product_image = $product->product_image;
										}																							
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

	public function carts(Request $request)
    {
   		$user = AppUser::find(auth('app_user_api')->user()->id);
		$total = 0;
		$current_date = date('Y-m-d ');
    	if(!is_null($user))
    	{
    		$carts = EcommCart::with('cart_details')->where('app_user_id',$user->id)->where('status',0)->first();

			$carts->product_count = EcommCartDetail::where('cart_id',$carts->id)->count();

			if(session('address_id') != null){
			$address_id = session('address_id');
				$address =  ShippingAddress::where('id',$address_id)->where('status',0)->where('is_default',1)->first();
			}else{
				$address =  ShippingAddress::where('app_user_id',$user->id)->where('status',0)->where('is_default',1)->first();
			}

			$shipping =  Shipping::where('user_id',$user->owner_id)->where('template_id',$user->template_id)->first();

    		if(!is_null($carts))
    		{
				$coupon_id =  session('coupon_id');
				if(!empty($coupon_id))
				{
					$total += $carts->sub_total;
					$couponDetails =EcomCoupon::find($coupon_id);
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
								$carts->coupon_id = $couponDetails->id;
								$carts->coupon_name = $couponDetails->coupon_code;
								$carts->discount = $discount;
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

										if(!is_null($detail->color))
										{
											$variant_name = $detail->color.'/'.$detail->size;
											$productvariant =  ProductVariation::where('product_id',$detail->product_id)->where('variant_name',$variant_name)->first(); 
											if(!is_null($productvariant)){
												$detail->product_image = $productvariant->variant_image;	
											}else{
												$detail->product_image = $product->product_image;
											}	
										}
										else
										{
											$detail->product_image = $product->product_image;
										}	
																						
										}
										else
										{
											$detail->product_name = "";
											$detail->product_description = "";
											$detail->product_image = "";
										}
									}
					  			}
					  			return response()->json(['status'=>true,'message' => 'Your cart','cart_payload'=> $carts,'address'=>$address,'shipping'=>$shipping]);
							}	
							else
							{
								if(count($carts->cart_details)>0)
								{
									$carts->coupon_name = null;
									foreach($carts->cart_details as $detail)
									{
										$product = Product::find($detail->product_id);
										

										if(!is_null($product))
										{
											$detail->product_name = $product->product_name;
											$detail->product_description = $product->product_description;
											if(!is_null($detail->color))
											{
												$variant_name = $detail->color.'/'.$detail->size;
												$productvariant =  ProductVariation::where('product_id',$detail->product_id)->where('variant_name',$variant_name)->first(); 
												if(!is_null($productvariant)){
													$detail->product_image = $productvariant->variant_image;	
												}else{
													$detail->product_image = $product->product_image;
												}												
											}
											else
											{
												$detail->product_image = $product->product_image;
											}																						
										}
										else
										{
											$detail->product_name = "";
											$detail->product_description = "";
											$detail->product_image = "";
										}
									}
									return response()->json(['status'=>true,'message'=>'Your cart','cart_payload'=>$carts,'address'=>$address,'shipping'=>$shipping]);
								}
								else
								{
									return response()->json(['status'=>false,'message'=>'Your cart is empty.']);
								}
							}
						}
						else
				  		{
							if(count($carts->cart_details)>0)
							{
								$carts->coupon_name = null;
								foreach($carts->cart_details as $detail)
								{
									$product = Product::find($detail->product_id);


									if(!is_null($product))
									{

										$detail->product_name = $product->product_name;
										$detail->product_description = $product->product_description;

										if(!is_null($detail->color))
										{
											$variant_name = $detail->color.'/'.$detail->size;
											$productvariant =  ProductVariation::where('product_id',$detail->product_id)->where('variant_name',$variant_name)->first(); 
											if(!is_null($productvariant)){
												$detail->product_image = $productvariant->variant_image;	
											}else{
												$detail->product_image = $product->product_image;
											}
											
										}
										else
										{
											$detail->product_image = $product->product_image;
										}	
										
										
									}
									else
									{
										$detail->product_name = "";
										$detail->product_description = "";
										$detail->product_image = "";
									}
								}
								return response()->json(['status'=>true,'message'=>'Your cart','cart_payload'=>$carts,'address'=>$address,'shipping'=>$shipping]);
							}
							else
							{
								return response()->json(['status'=>false,'message'=>'Your cart is empty.']);
							}
				  		}
					}
					else
					{
						if(count($carts->cart_details)>0)
						{
							$carts->coupon_name = null;
							foreach($carts->cart_details as $detail)
							{
								$product = Product::find($detail->product_id);

								if(!is_null($product))
								{

									$detail->product_name = $product->product_name;
									$detail->product_description = $product->product_description;

									if(!is_null($detail->color))
									{
										$variant_name = $detail->color.'/'.$detail->size;
										$productvariant =  ProductVariation::where('product_id',$detail->product_id)->where('variant_name',$variant_name)->first(); 
										if(!is_null($productvariant)){
											$detail->product_image = $productvariant->variant_image;	
										}else{
											$detail->product_image = $product->product_image;
										}
										
									}
									else
									{
										$detail->product_image = $product->product_image;
									}	
									
									
								}
								else
								{
									$detail->product_name = "";
									$detail->product_description = "";
									$detail->product_image = "";
								}
							}
							return response()->json(['status'=>true,'message'=>'Your cart','cart_payload'=>$carts,'address'=>$address,'shipping'=>$shipping]);
						}
						else
						{
							return response()->json(['status'=>false,'message'=>'Your cart is empty.']);
						}
					}
				}
				else
				{
					if(count($carts->cart_details)>0)
					{
						$carts->coupon_name = null;
						foreach($carts->cart_details as $detail)
						{
							$product = Product::find($detail->product_id);

							if(!is_null($product))
							{

								$detail->product_name = $product->product_name;
								$detail->product_description = $product->product_description;

								if(!is_null($detail->color))
								{
									$variant_name = $detail->color.'/'.$detail->size;
									$productvariant =  ProductVariation::where('product_id',$detail->product_id)->where('variant_name',$variant_name)->first(); 
									if(!is_null($productvariant)){
										$detail->product_image = $productvariant->variant_image;	
									}else{
										$detail->product_image = $product->product_image;
									}

								}
								else
								{
									$detail->product_image = $product->product_image;
								}	
								
								
							}
							else
							{
								$detail->product_name = "";
								$detail->product_description = "";
								$detail->product_image = "";
							}
						}
						return response()->json(['status'=>true,'message'=>'Your cart','cart_payload'=>$carts,'address'=>$address,'shipping'=>$shipping]);
					}
					else
					{
						return response()->json(['status'=>false,'message'=>'Your cart is empty.']);
					}
				}
			}
			else
			{
				return response()->json(['status'=>false,'message'=>'Your cart is empty.']);
			}
    	}
    	else
    	{
    		return response()->json(['status'=>false,'message'=>'User not found']);
    	}
    }
}
