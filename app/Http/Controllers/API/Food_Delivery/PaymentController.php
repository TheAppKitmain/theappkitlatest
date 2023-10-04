<?php

namespace App\Http\Controllers\API\Food_Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Mail\OrderPlace;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Template\Food_Delivery\FoodAppUser;
use App\Models\Template\Food_Delivery\FoodCart;
use App\Models\Template\Food_Delivery\FoodCartItem;
use App\Models\Template\Food_Delivery\FoodProduct;
use App\Models\Template\Food_Delivery\FoodShop;
use App\Models\Template\Food_Delivery\FoodPromo;
use App\Models\Template\Food_Delivery\ApplyFoodPromo;
use App\Models\Template\Food_Delivery\FoodOrder;
use Validator;
use App\Models\Template\Food_Delivery\FoodStripeInfo;
use Config;
use Auth;

class PaymentController extends Controller
{
	public function promo(Request $request)
	{
		$user = FoodAppUser::find($request->user()->id);
		if(!is_null($user)):
			$applied = ApplyFoodPromo::whereUserId($user->id)->pluck('promo_id');
			$promos = FoodPromo::whereNotIn('id',$applied)->orderBy('id','desc')->get();
			return response()->json(['status'=>true,'message'=>'List of all promos.','payload'=>$promos]);
		else:
			return response()->json(['status'=>false,'message'=>'User not found.']);
		endif;
	}

    public function generate_token()
    {
    	return config('stripe.stripe_secret');
    	Stripe::setApiKey(config('stripe.stripe_secret'));
    	// $connectionToken = \Stripe\Terminal\ConnectionToken::create();
    	// return $connectionToken;
    	$connectionToken = \Stripe\Token::create(['card' => [
		    'number' => '4242424242424242',
		    'exp_month' => 6,
		    'exp_year' => 2021,
		    'cvc' => '314',
		],]);
    	return $connectionToken;
    }

    public function generate_customer(Request $request)
    {
    	$user = FoodAppUser::find($request->user()->id);
		if(!is_null($user)):
			$billing_details=array("city"=>$user->user_information->city,"line1"=>$user->user_information->address,"line2"=>$user->user_information->address_line,"postal_code"=>$user->user_information->postcode);
			$stripe = Stripe::setApiKey(config('stripe.stripe_secret'));
			
        	$lists = FoodStripeInfo::whereUserId($user->id)->first();
        	if(!is_null($lists)):
				try
				{
					$update = Customer::createSource($lists->customer_id,['source' => $request->stripeToken]);
					return response()->json(["status"=>true,"payload"=>$customer]);
				} catch(\Stripe\Exception\CardException $e)
				{
				  // Since it's a decline, \Stripe\Exception\CardException will be caught
				  echo 'Status is:' . $e->getHttpStatus() . '\n';
				  echo 'Type is:' . $e->getError()->type . '\n';
				  echo 'Code is:' . $e->getError()->code . '\n';
				  // param is '' in this case
				  echo 'Param is:' . $e->getError()->param . '\n';
				  echo 'Message is:' . $e->getError()->message . '\n';
				} catch (\Stripe\Exception\RateLimitException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				} catch (\Stripe\Exception\InvalidRequestException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				} catch (\Stripe\Exception\AuthenticationException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				} catch (\Stripe\Exception\ApiConnectionException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				} catch (\Stripe\Exception\ApiErrorException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				}
				catch (Exception $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				}
        	else:
        		try
				{
					$customer = Customer::create(array(
					// 'name'=>$user->name,
		   //          'email'=>$user->email,
		   //          'address'=>$billing_details,
		   //          'shipping' => array("address"=>$billing_details,"name"=>$user->name,"phone"=>$user->mobile),
		            //'phone'=>$user->mobile,
		            'source'  => $request->stripeToken
	        		));
        			StripeInfo::create(['user_id'=>$user->id,'customer_id'=>$customer->id]);
        			return response()->json(["status"=>true,"payload"=>$customer]);
				} catch(\Stripe\Exception\CardException $e)
				{
				  // Since it's a decline, \Stripe\Exception\CardException will be caught
				  echo 'Status is:' . $e->getHttpStatus() . '\n';
				  echo 'Type is:' . $e->getError()->type . '\n';
				  echo 'Code is:' . $e->getError()->code . '\n';
				  // param is '' in this case
				  echo 'Param is:' . $e->getError()->param . '\n';
				  echo 'Message is:' . $e->getError()->message . '\n';
				} catch (\Stripe\Exception\RateLimitException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				} catch (\Stripe\Exception\InvalidRequestException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				} catch (\Stripe\Exception\AuthenticationException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				} catch (\Stripe\Exception\ApiConnectionException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				} catch (\Stripe\Exception\ApiErrorException $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				}
				catch (Exception $e)
				{
				  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
				}
        	endif;
		endif;
    }

    public function get_all_cards(Request $request)
    {
    	Stripe::setApiKey(config('stripe.stripe_secret'));
    	$user = \App\User::whereHas('roles',function($q){ $q->where('role_name','user'); })->find($request->user()->id);
		if(!is_null($user)):
			$customers = StripeInfo::whereUserId($user->id)->first();
			if(!is_null($customers)):
				$cards = Customer::allSources($customers->customer_id);
				return response()->json(['status'=>true,"message"=>"List of all cards","payload"=>$cards]);
			else:
				return response()->json(['status'=>false,"message"=>'No card details found.']);
			endif;
		else:
			return response()->json(['status'=>false,'message'=>'User not found.']);
		endif;
    }

    public function add_cards(Request $request)
    {
    	$user = \App\User::whereHas('roles',function($q){ $q->where('role_name','user'); })->find($request->user()->id);
		if(!is_null($user)):
			if($request->isMethod('post')):
				if(isset($request->card_id))
	        	{
	        		$cards = \App\CardDetail::whereUserId($user->id)->find($request->card_id);
					if(!is_null($cards))
					{
						$cards->delete();
						return response()->json(['status'=>true,'message'=>'Your card info has been deleted.']);
					}
					else
					{
						return response()->json(['status'=>false,'message'=>'Card info not found.']);
					}
	        	}
		        else
		        {
					$rules = ['card_no'=>'required','exp_year'=>'required|numeric','exp_month'=>'required|numeric'];
			        $validator = Validator::make($request->all(), $rules);
			        if ($validator->fails()) 
			        {
			          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
			        }
			        else
			        {
			        	$lists = \App\CardDetail::whereUserId($user->id)->where('card_no',$request->card_no)->get();
			        	if(count($lists)>0)
			        	{
			        		return response()->json(['status'=>false,'message'=>'Card Details already exists.']);
			        	}
			        	else
			        	{
			        		\App\CardDetail::create(['user_id'=>$user->id,'card_no'=>$request->card_no,'exp_year'=>$request->exp_year,'exp_month'=>$request->exp_month]);
							return response()->json(['status'=>true,'message'=>'New card info has been created.']);
			        	}
					}
				}
			endif;
			if($request->isMethod('get')):
				$cards = \App\CardDetail::whereUserId($user->id)->get();
				if(count($cards)>0)
				{
					return response()->json(['status'=>true,'message'=>'List of all cards.','payload'=>$cards]);
				}
				else
				{
					return response()->json(['status'=>false,'message'=>'No card detail found.']);
				}
			endif;
		else:
			return response()->json(['status'=>false,'message'=>'User not found.']);
		endif;
    }

    public function payment(Request $request)
	{
		$rules = ['stripeToken'=>'required','cart_id'=>'required|numeric','schedule'=>'required','total'=>'required','name'=>'required','billing_details'=>'required','shipping'=>'required','email'=>'required','mobile'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
			$stripe = Stripe::setApiKey(config('stripe.stripe_secret'));
			$sub_total = 0;
			$charge_amount = "2";
			$user = \App\User::whereHas('roles',function($q){ $q->where('role_name','user'); })->find($request->user()->id);
			if(!is_null($user)):
				$results = Shop::first();
				$currency =  html_entity_decode($results->currency_symbol);
				$cart = Cart::whereStatus('0')->whereUserId($user->id)->find($request->cart_id);
				if(!is_null($cart))
				{
					$items = CartItem::whereCartId($cart->id)->get();
					if(count($items)>0)
					{
						foreach($items as $item):
							$item->qty = (int)$item->qty;
							$products = Product::find($item->product_id);
							$products->price = $products->price;
							if(!is_null($item->product_information_id)):
								$variation = \App\ProductInformation::find($item->product_information_id);
								$variation->product_price = $variation->product_price;
								$products->product_informations = $variation;
								$sub_total += $variation->product_price * $item->qty;
							endif;
							$item->product = $products;
							$sub_total += $products->price * $item->qty;
						endforeach;

						if(!empty($request->promo_id) && isset($request->promo_id)):
							$value = session('promo');
						    $promo = Promo::find($request->promo_id);
						    if(!is_null($promo)):

			        			// $discount_price = ($sub_total*$promo->discount)/100;
			        			// $total = $sub_total-$discount_price;
			        			// $grand_total=$total+$results->delivery_charges;

						    	if($promo->promo_type == "discount")
						    	{
						    		$discount_price = ($sub_total*$promo->discount)/100;
				        			$total = $sub_total-$discount_price;
				        			if($total <= "10")
							    	{
							    		$results->delivery_charges += $charge_amount;
								        $results->delivery_charges = (string)$results->delivery_charges;
								        $grand_total = $results->delivery_charges+$total;	
									}
									else
									{
										$grand_total=$total+$results->delivery_charges;
									}
						    	}
						    	if($promo->promo_type == "amount")
						    	{
					    			$discount_price = $promo->amount;
				        			$total = $sub_total-$discount_price;

				        			if($total <= "10")
							    	{
							    		$results->delivery_charges += $charge_amount;
								        $results->delivery_charges = (string)$results->delivery_charges;
								        $grand_total = $results->delivery_charges+$total;	
									}
									else
									{
										$grand_total=$total+$results->delivery_charges;
									}
						    	}
			        			$apply_promo = ApplyPromo::create(['cart_id'=>$cart->id,'user_id'=>$user->id,'promo_id'=>$promo->id,'total'=>$total,'discount_price'=>$discount_price,'grand_total'=>$grand_total]);
					    		$amount = $apply_promo->grand_total;
					    		$apply_promo_id = $apply_promo->id;
					    	endif;
					    else:
					    	if($sub_total <= "10")
					    	{
					    		$results->delivery_charges += $charge_amount;
						        $results->delivery_charges = (string)$results->delivery_charges;
						        $amount = $results->delivery_charges+$sub_total;	
							}
							else
							{
								$amount = $sub_total+$results->delivery_charges;
							}
					    endif;
						// $apply_promo = ApplyPromo::whereUserId($user->id)->whereCartId($cart->id)->first();
						// if(!is_null($apply_promo)):
						// 	$amount = $apply_promo->grand_total;
						// else:
						// 	$amount = $sub_total+$results->delivery_charges;
						// endif;

						// $billing_details=array("city"=>$user->user_information->city,"line1"=>$user->user_information->address,"line2"=>$user->user_information->address_line,"postal_code"=>$user->user_information->postcode);
					    try
					    {
					    	$customer = Customer::create(array(
								'name'=>$request->name,
					            'email'=>$request->email,
					            'address'=>$request->billing_details,
					            'shipping' => array("address"=>$request->shipping,"name"=>$request->name,"phone"=>$request->mobile),
					            'phone'=>$request->mobile,
					            'source'  => $request->stripeToken
			        		));
					    }
						catch(\Stripe\Exception\CardException $e)
						{
						  // Since it's a decline, \Stripe\Exception\CardException will be caught
						  // echo 'Status is:' . $e->getHttpStatus() . '\n';
						  // echo 'Type is:' . $e->getError()->type . '\n';
						  // echo 'Code is:' . $e->getError()->code . '\n';
						  // // param is '' in this case
						  // echo 'Param is:' . $e->getError()->param . '\n';
						  // echo 'Message is:' . $e->getError()->message . '\n';
						  $payload = array("status"=>$e->getHttpStatus(),"type"=>$e->getError()->type,"code"=>$e->getError()->code,"param"=>$e->getError()->param,"message"=>$e->getError()->message);
						  return response()->json(['status'=>false,"payload"=>$payload,"message"=>$e->getError()->message]);
						} catch (\Stripe\Exception\RateLimitException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						} catch (\Stripe\Exception\InvalidRequestException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						} catch (\Stripe\Exception\AuthenticationException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						} catch (\Stripe\Exception\ApiConnectionException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						} catch (\Stripe\Exception\ApiErrorException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						}
						catch (Exception $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						}	

						try
						{
							$charge = Charge::create(array(
					        'customer' => $customer->id,
					        'amount'   => $amount*100,
					        //'billing_details'=>array("address"=>$request->shipping,"name"=>$request->name,"phone"=>$request->mobile,'email'=>$request->email),
					        'currency' => 'gbp',//$results->currency,
					        'shipping' => array("address"=>$request->shipping,"name"=>$request->name,"phone"=>$request->mobile),
					        'metadata'=>array("cart_id"=>$cart->id),
					        'receipt_email'=>$request->email
						    ));

							$status = $charge['status'];
	  
						    if($status == "succeeded")
						    {
						    	$latestOrder = Order::create(['cart_id'=>$cart->id,'user_id'=>$user->id,'subtotal'=>$sub_total,'total'=>$amount,'order_customers'=>$customer,'order_charges'=>$charge,'schedule'=>$request->schedule]);
							    $order = Order::find($latestOrder->id);
							    if(isset($apply_promo) && !is_null($apply_promo)):
							    	$order->apply_promo_id = $apply_promo->id;
							    endif;
							    $order->order_no = '#'.str_pad($latestOrder->id + 1, 3, "0", STR_PAD_LEFT);
							    $order->save();

							    Mail::to($user->email)->send(new OrderShipped($order));

							    //Mail::to('sales@cornershopdrop.com')->send(new OrderPlace($order));

							    Cart::whereId($cart->id)->update(['status'=>'1']);
						    	$msg = "Thank you for your purchase.";
						    	return response()->json(['status'=>true,"payload"=>array("order_status"=>$order->status,"order_no"=>$order->order_no,"message"=>$msg,"order_id"=>$order->id)]);
						    }
						    elseif ($status == "pending")
						    {
						    	$msg = "We are sorry, but your current payment method could not be processed.";
						    	return response()->json(['status'=>false,"payload"=>array("order_status"=>$order->status,"message"=>$msg)]);
						    }
						    else
						    {
						    	$msg = "We are sorry, but your current payment method could not be processed.";
						    	return response()->json(['status'=>false,"payload"=>array("order_status"=>$order->status,"message"=>$msg)]);
						    }
						} catch(\Stripe\Exception\CardException $e)
						{
						  // Since it's a decline, \Stripe\Exception\CardException will be caught
						  // echo 'Status is:' . $e->getHttpStatus() . '\n';
						  // echo 'Type is:' . $e->getError()->type . '\n';
						  // echo 'Code is:' . $e->getError()->code . '\n';
						  // // param is '' in this case
						  // echo 'Param is:' . $e->getError()->param . '\n';
						  // echo 'Message is:' . $e->getError()->message . '\n';
						  $payload = array("status"=>$e->getHttpStatus(),"type"=>$e->getError()->type,"code"=>$e->getError()->code,"param"=>$e->getError()->param,"message"=>$e->getError()->message);
						  return response()->json(['status'=>false,"payload"=>$payload,"message"=>$e->getError()->message]);
						} catch (\Stripe\Exception\RateLimitException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						} catch (\Stripe\Exception\InvalidRequestException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						} catch (\Stripe\Exception\AuthenticationException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						} catch (\Stripe\Exception\ApiConnectionException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						} catch (\Stripe\Exception\ApiErrorException $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						}
						catch (Exception $e)
						{
						  return response()->json(['status'=>false,'message'=>$e->getMessage()]);
						}	
					}
					else
					{
						return response()->json(['status'=>false,'message'=>'No cart items found.']);
					}
				}
				else
				{
					return response()->json(['status'=>false,'message'=>'Cart not found.']);
				}
			else:
				return response()->json(['status'=>false,'message'=>'User not found.']);
			endif;
	  //       $intent = \Stripe\PaymentIntent::create([
			//   'amount' => 500,
			//   'currency' => 'usd',
			// ]);
			// $client_secret = $intent->client_secret;
			// return $intent;
		}
	}


	public function my_orders(Request $request)
	{
		
		$user = FoodAppUser::find(Auth::guard('food_app_user_api')->user()->id);
		if(!is_null($user)):
			$results = FoodShop::first();
			$currency =  html_entity_decode($results->currency_symbol);

			$orders = FoodOrder::where('app_user_id',$user->id)->get(['id','order_no','total','created_at','status','cart_id']);
			
			if(count($orders)>0):
				foreach($orders as $order):
					$promo = ApplyFoodPromo::whereCartId($order->cart->id)->where('app_user_id',$user->id)->with('promo')->first();
					if(!is_null($promo)):

						if($promo->promo_type == "discount")
						{
						    $order->discount_price = ($promo->grand_total*$promo->promo->discount)/100;
						}
						if($promo->promo_type == "amount")
						{
						    $order->discount_price = $promo->amount;
						}
						$order->promo = $promo;
					endif;
				endforeach;
				return response()->json(['status'=>true,"message"=>"Your Orders",'payload'=>$orders,"currency"=>$currency,"delivery_charges"=>$results->delivery_charges]);
			else:
				return response()->json(['status'=>false,"message"=>"You've not any order yet."]);
			endif;
		else:
			return response()->json(['status'=>false,"message"=>"No user found."]);
		endif;
	}

	public function my_order_history(Request $request)
	{
		$user = FoodAppUser::find(Auth::guard('food_app_user_api')->user()->id);
		$sub_total = 0;
		if(!is_null($user)):
			$results = FoodShop::first();
			$currency =  html_entity_decode($results->currency_symbol);
			$order = FoodOrder::whereAppUserId($user->id)->find($request->id);
			$charge_amount = "2.00";
			if(!is_null($order)):
				$items = FoodCartItem::whereCartId($order->cart->id)->with('products','product_informations')->get();
				$promo = ApplyFoodPromo::whereCartId($order->cart->id)->whereAppUserId($user->id)->with('promo')->first();
				
				if(!is_null($promo)):
					$total_value = $order->subtotal - $promo->discount_price;
				else:
					$total_value = $order->subtotal;
				endif;

				if($total_value <= "7.5")
				{
					$results->delivery_charges += $charge_amount;
					$results->delivery_charges = (string)$results->delivery_charges;
					if($results->delivery_charges == '4.5'){

						$results->delivery_charges = '4.50';
						
					}	
				}
				if($order->payment_type == "square"):
					$billing_details = array('address_line_1'=>$order->order_charges['billing_address']['address_line_1'],'address_line_2'=>'','postal_code'=>$order->order_charges['billing_address']['postal_code'],'city'=>$order->order_charges['billing_address']['locality']);
					$delivery_address = array('address_line_1'=>$order->order_charges['shipping_address']['address_line_1'],'address_line_2'=>'','postal_code'=>$order->order_charges['shipping_address']['postal_code'],'city'=>$order->order_charges['shipping_address']['locality']);
				endif;
				if($order->payment_type == "stripe"):
					$billing_details = array('address_line_1'=>$order->order_charges['billing_details']['address']["line1"],'address_line_2'=>$order->order_charges['billing_details']['address']["line2"],'postal_code'=>$order->order_charges['billing_details']['address']['postal_code'],'city'=>$order->order_charges['billing_details']['address']['city']);
					$delivery_address = array('address_line_1'=>$order->order_charges['shipping']['address']["line1"],'address_line_2'=>$order->order_charges['shipping']['address']["line2"],'postal_code'=>$order->order_charges['shipping']['address']['postal_code'],'city'=>$order->order_charges['shipping']['address']['city']);
				endif;

				$paylaod = array("order_no"=>$order->order_no,"contact_info"=>$order->contact_info,"sub_total"=>$order->subtotal,"total"=>$order->total,'billing_details'=>$billing_details,"delivery_address"=>$delivery_address,"products"=>$items,'promo'=>$promo,'order_status'=>$order->order_status,'created_at'=>$order->created_at,'payment_type'=>$order->payment_type);
				return response()->json(['status'=>true,"message"=>"Your Orders",'payload'=>$paylaod,"currency"=>$currency,"delivery_charges"=>$results->delivery_charges]);
			else:
				return response()->json(['status'=>false,"message"=>"You've not any order yet."]);
			endif;
		else:
			return response()->json(['status'=>false,"message"=>"No user found."]);
		endif;
	}

	public function orders()
	{
		$data = [];
		$data['recent_orders'] = Order::whereStatus(null)->orderBy('id','desc')->get();
		$data['completed_orders'] = Order::whereStatus('1')->orderBy('id','desc')->get();
		$data['pending_orders'] = Order::whereStatus('0')->orderBy('id','desc')->get();
		$data['delivery_orders'] = Order::whereStatus('2')->orderBy('id','desc')->get();
		return view('orders.index',compact('data'));
	}

	public function order_histories($id)
	{
		$order = Order::with('user','apply_promo')->findOrFail($id);

		$apply_promo = ApplyPromo::where('id',$order->apply_promo_id)->first();

		$order->items = CartItem::whereCartId($order->cart->id)->with('products','product_informations')->get();
		$results = Shop::first();
		$charge_amount = "2.00";
		$order->currency =  html_entity_decode($results->currency_symbol);
		
		if(!is_null($apply_promo)):
		$total_value = $order->subtotal - $apply_promo->discount_price;
		else:
		$total_value = $order->subtotal;
		endif;

		if($total_value <= "7.5")
		{
			$results->delivery_charges += $charge_amount;
			$results->delivery_charges = (string)$results->delivery_charges;
			if($results->delivery_charges == '4.5'){

				$results->delivery_charges = '4.50';
				
			}	
		}

		$order->delivery_charges = $results->delivery_charges;
		
		$order->order_total = 0;

		return view('orders.show',compact('order'));
	}

	public function delivery_orders()
	{
		$data=[];
		$data['delivery_orders'] = Order::whereStatus('2')->orderBy('id','desc')->get();
		return view('orders.delivery_orders',compact('data'));
	}

	public function recent_orders()
	{
		$data=[];
		$data['recent_orders'] = Order::whereStatus(null)->orderBy('id','desc')->get();
		return view('orders.recent_orders',compact('data'));
	}

	public function completed_orders()
	{
		$data=[];
		$data['completed_orders'] = Order::whereStatus("1")->orderBy('id','desc')->get();
		return view('orders.completed_orders',compact('data'));
	}

	public function pending_orders()
	{
		$data=[];
		$data['pending_orders'] = Order::whereStatus("0")->orderBy('id','desc')->get();
		return view('orders.pending_orders',compact('data'));
	}

	public function delivery_receipt($id)
	{
		$sub_total=0;
		$order = Order::whereIn('status',['1','2'])->findOrFail($id);
		$results = Shop::first();
		
		if(!is_null($order)):
			$order->currency =  html_entity_decode($results->currency_symbol);
			$order->delivery_charges = $results->delivery_charges;
			$items = CartItem::whereCartId($order->cart->id)->with('products','product_informations')->get();
			$order->items = $items;
		endif;
		return view('orders.delivery_receipt',compact('order'));
	}

	public function update_status(Request $request)
	{
		$order = Order::find($request->id);
		if(!is_null($order)):
			$order->status = $request->status;
			$order->save();
			$registration_ids = $order->user->firebase_token;
			if(!is_null($registration_ids)):
				if($order->status == "1" || $order->status == "2")
				{
					$order->delivered_at = now();
					$order->save();
				}
				if($order->status == "0"):
					Mail::to('wegodelliveries@gmail.com')->send(new OrderPlace($order));
					if(is_null($order->user->device_type)):
						$message = 
	                    [ 
	                        "to" => $registration_ids,
	                        "data" => 
	                        [
	                            "title" => "Confirmed",
	                            "message"=> "Your order has been confirmed & is now being packed.",
	                            //"order_information" => [
	                           	"order_id" => $order->id,
	                           	"order_no"=> $order->order_no
	                           //]
	                        ]
	                    ];
	                endif;
	                if($order->user->device_type == 'I'):
		                $message = 
		                [ 
	                        "to" => $registration_ids,
	                        "priority" => 'high',
	                        "sound" => 'default', 
	                        "badge" => '1',
	                        "notification" =>
	                        [
	                            "title" => "Confirmed",
	                            "body" => "Your order has been confirmed & is now being packed.",
	                        ],
	                        "data" => 
	                        [ 
	                           "order_id" => $order->id,
		                       "order_no"=> $order->order_no
	                        ]
	                    ];
	                endif;
				endif;
				if($order->status == "1"):
					// $order->status = "1";
					// $order->delivered_at = now();
					// $order->save();
					if(is_null($order->user->device_type)):
						$message = 
	                    [ 
	                        "to" => $registration_ids,
	                        "data" => 
	                        [
	                            "title" => "Completed",
	                            "message"=> "Thank you for supporting local business. See you soon.",
	                            //"order_information" => [
	                           	"order_id" => $order->id,
	                           	"order_no"=> $order->order_no
	                            //]
	                        ]
	                    ];
	                endif;
                    if($order->user->device_type == 'I'):
		                $message = 
		                [ 
	                        "to" => $registration_ids,
	                        "priority" => 'high',
	                        "sound" => 'default', 
	                        "badge" => '1',
	                        "notification" =>
	                        [
	                            "title" => "Completed",
	                            "body" => "Thank you for supporting local business. See you soon.",
	                        ],
	                        "data" => 
	                        [ 
	                           "order_id" => $order->id,
		                       "order_no"=> $order->order_no
	                        ]
	                    ];
	                endif;
				endif;
				if($order->status == "2"):
					// $order->status = "2";
					// $order->delivered_at = now();
					// $order->save();
					if(is_null($order->user->device_type)):
						$message = 
	                    [ 
	                        "to" => $registration_ids,
	                        "data" => 
	                        [
	                            "title" => "Delivery",
	                            "message"=> "Not long now!, Your orders on the way.",
	                            //"order_information" => [
	                           	"order_id" => $order->id,
	                           	"order_no"=> $order->order_no
	                            //]
	                        ]
	                    ];
	                endif;
                    if($order->user->device_type == "I"):
		                $message = 
		                [ 
	                        "to" => $registration_ids,
	                        "priority" => 'high',
	                        "sound" => 'default', 
	                        "badge" => '1',
	                        "notification" =>
	                        [
	                            "title" => "Delivery",
	                            "body" => "Not long now!, Your orders on the way.",
	                        ],
	                        "data" => 
	                        [ 
	                           "order_id" => $order->id,
		                       "order_no"=> $order->order_no
	                        ]
	                    ];
	                endif;
				endif;
				\App\PushNotification::send($message);
			endif;
			return back()->with(['alert'=>'success','message'=>'Order status has been changed.']);
		else:
			return back()->with(['alert'=>'danger','message'=>'Order not found.']);
		endif;
	}
}
