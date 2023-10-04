<?php

namespace App\Http\Controllers\API\Food_Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Square\Models\CreateCustomerRequest;
use App\Models\Template\Food_Delivery\FoodProduct;
use App\Models\Template\Food_Delivery\FoodShop;
use App\Models\Template\Food_Delivery\FoodPromo;
use App\Models\Template\Food_Delivery\ApplyFoodPromo;
use App\Models\Template\Food_Delivery\FoodOrder;
use App\Models\Template\Food_Delivery\FoodProductInformation;
use App\Models\Template\Food_Delivery\SquareCredentials;
use App\Models\Template\Food_Delivery\FoodCart;
use App\Models\Template\Food_Delivery\FoodCartItem;
use Illuminate\Support\Facades\Mail;
use Square\Exceptions\ApiException;
use App\Mail\FoodOrderShipped;
use App\Mail\FoodOrderPlace;
use Square\SquareClient;
use Square\Environment;
use Validator;
use Auth;
use App\Models\Template\Food_Delivery\FoodAppUser;

class ChargeController extends Controller
{
    public function createCustomer(Request $request)
    {

        $square = SquareCredentials::first();
        $client = new SquareClient([ "accessToken" => $square->square_token,"environment" => Environment::SANDBOX ]);
        $customersApi = $client->getCustomersApi();

        $rules = ['given_name'=>'required','family_name'=>'required','phone_name'=>'required','email_address'=>'required','address_line_1'=>'required','locality'=>'required','postal_code'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $address = new \Square\Models\Address();
            $address->setAddressLine1($request->address_line_1);
            //$address->setAddressLine2($request->address_line_2);
            $address->setLocality($request->locality);
            $address->setPostalCode($request->postal_code);
            
            $customer = new CreateCustomerRequest;
            $customer->setGivenName($request->given_name);
            $customer->setFamilyName($request->family_name);
            $customer->setPhoneNumber($request->phone_name);
            $customer->setEmailAddress($request->email_address);
            $customer->setAddress($address);
            try
            {
                $result = $customersApi->createCustomer($customer);
                if ($result->isSuccess())
                {
                    $customer_id = $result->getResult()->getCustomer()->getId();
                    return $customer_id;
                }
                else
                {
                    return $result->getErrors();
                }
            }
            catch (ApiException $e)
            {
                return "Recieved error while calling Square: " . $e->getMessage();
            }
        } 
    }

    public function charge(Request $request)
    {
        $square = SquareCredentials::where('user_id',$request->owner_id)->first();
        $client = new SquareClient([ "accessToken" => $square->square_token ,"environment" => Environment::SANDBOX ]);
        // $customersApi = $client->getCustomersApi();
        // $address = new \Square\Models\Address();
        // $address->setAddressLine1('Street 1');
        // $address->setLocality('South Hall');
        // $address->setPostalCode('E174ER');
        
        // $customer = new CreateCustomerRequest;
        // $customer->setGivenName('Amandeep');
        // $customer->setFamilyName('Aman');
        // $customer->setPhoneNumber('014651151');
        // $customer->setEmailAddress('amandeep.smartitventures@gmail.com');
        // $customer->setAddress($address);
        // try
        // {
        //     $result = $customersApi->createCustomer($customer);
        //     if ($result->isSuccess())
        //     {
        //         $location = config('app.location');
        //         $customer_id = $result->getResult()->getCustomer()->getId();
        //         $shipping_address = new \Square\Models\Address();
        //         $shipping_address->setAddressLine1('# 117');
        //         $shipping_address->setLocality('Downtown');
        //         $shipping_address->setPostalCode('E174ER');

        //         $paymentsApi = $client->getPaymentsApi();
        //         $body_sourceId = 'cnon:CBASEBp_8jKhqj_owdnlj6oD9EU';
        //         $body_idempotencyKey = base64_encode(openssl_random_pseudo_bytes(32));
        //         $body_amountMoney = new \Square\Models\Money;
        //         $body_amountMoney->setAmount(421*100);
        //         $body_amountMoney->setCurrency(\Square\Models\Currency::USD);
        //         $body = new \Square\Models\CreatePaymentRequest( $body_sourceId, $body_idempotencyKey, $body_amountMoney );
        //         $body->setBillingAddress($address);
        //         $body->setShippingAddress($shipping_address);
        //         $body->setCustomerId($customer_id);
        //         $body->setLocationId($location);
        //         $apiResponse = $paymentsApi->createPayment($body);
        //         if ($apiResponse->isSuccess())
        //         {
        //             return $status = $apiResponse->getResult()->getPayment()->getStatus();
        //         }
        //         else
        //         {
        //             return response()->json(['status'=>false,'message'=>$apiResponse->getErrors()]);
        //         }
        //     }
        // }
        // catch (ApiException $e)
        // {
        //     return response()->json(['status'=>false,'message'=>"Recieved error while calling Square: " . $e->getMessage()]);
        // }

        // die('die');
        //$client = new SquareClient([ "accessToken" => config('app.access_token'),"environment" => Environment::PRODUCTION ]);
        $user = FoodAppUser::find(Auth::guard('food_app_user_api')->user()->id);
        if(!is_null($user)):
            
            $rules = ['given_name'=>'required','family_name'=>'required','phone_name'=>'required','email_address'=>'required','address_line_1'=>'required','locality'=>'required','postal_code'=>'required','shipping_address_line_1'=>'required','shipping_locality'=>'required','shipping_postal_code'=>'required','sourceId'=>'required','cart_id'=>'required|numeric','schedule'=>'required'];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) 
            {
              return response()->json(['status' => false,'message' => $validator->errors()->first()]);
            }
            else
            {
                $sub_total = 0;
                $results = FoodShop::first();
                $currency =  html_entity_decode($results->currency_symbol);
                $charge_amount = "2";
                $cart = FoodCart::whereStatus('0')->where('app_user_id',$user->id)->find($request->cart_id);
                if(!is_null($cart))
                {
                    $items = FoodCartItem::whereCartId($cart->id)->get();
                    if(count($items)>0)
                    {
                        foreach($items as $item):
                            $item->qty = (int)$item->qty;
                            $products = FoodProduct::find($item->product_id);
                            $products->price = $products->price;
                            if(!is_null($item->product_information_id)):
                                $variation = FoodProductInformation::find($item->product_information_id);
                                $variation->product_price = $variation->product_price;
                                $products->product_informations = $variation;
                                $sub_total += $variation->product_price * $item->qty;
                            endif;
                            $item->product = $products;
                            $sub_total += $products->price * $item->qty;
                        endforeach;
                        if(!empty($request->promo_id) && isset($request->promo_id)):
                            $value = session('promo');
                            $promo = FoodPromo::find($request->promo_id);
                            if(!is_null($promo)):
                                if($promo->promo_type == "discount")
						    	{
						    		$discount_price = ($sub_total*$promo->discount)/100;
				        			$total = $sub_total-$discount_price;
				        			if($total <= "7.5")
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

				        			if($total <= "7.5")
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
                                $apply_promo = ApplyFoodPromo::create(['cart_id'=>$cart->id,'app_user_id'=>$user->id,'promo_id'=>$promo->id,'total'=>$total,'discount_price'=>$discount_price,'grand_total'=>$grand_total]);
                                $amount = $apply_promo->grand_total;
                                $apply_promo_id = $apply_promo->id;
                            endif;
                        else:
                            if($sub_total <= "7.5")
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
                        $customersApi = $client->getCustomersApi();
                        $address = new \Square\Models\Address();
                        $address->setAddressLine1($request->address_line_1);
                        $address->setLocality($request->locality);
                        $address->setPostalCode($request->postal_code);
                        
                        $customer = new CreateCustomerRequest;
                        $customer->setGivenName($request->given_name);
                        $customer->setFamilyName($request->family_name);
                        $customer->setPhoneNumber($request->phone_name);
                        $customer->setEmailAddress($request->email_address);
                        $customer->setAddress($address);
                        try
                        {
                            $result = $customersApi->createCustomer($customer);
                            if ($result->isSuccess())
                            {
                                $location = config('app.location');
                                $customer_id = $result->getResult()->getCustomer()->getId();
                                $shipping_address = new \Square\Models\Address();
                                $shipping_address->setAddressLine1($request->shipping_address_line_1);
                                $shipping_address->setLocality($request->shipping_locality);
                                $shipping_address->setPostalCode($request->shipping_postal_code);

                                $paymentsApi = $client->getPaymentsApi();
                                $body_sourceId = $request->sourceId;
                                $body_idempotencyKey = base64_encode(openssl_random_pseudo_bytes(32));
                                $body_amountMoney = new \Square\Models\Money;
                                $body_amountMoney->setAmount($amount*100);
                                $body_amountMoney->setCurrency(\Square\Models\Currency::GBP);
                                $body = new \Square\Models\CreatePaymentRequest( $body_sourceId, $body_idempotencyKey, $body_amountMoney );
                                $body->setBillingAddress($address);
                                $body->setShippingAddress($shipping_address);
                                $body->setCustomerId($customer_id);
                                $body->setLocationId($location);
                                $apiResponse = $paymentsApi->createPayment($body);
                                if ($apiResponse->isSuccess())
                                {

                                    $status = $apiResponse->getResult()->getPayment()->getStatus();
      
                                    if($status == "COMPLETED")
                                    {
                                        $latestOrder = FoodOrder::create(['cart_id'=>$cart->id,'app_user_id'=>$user->id,'subtotal'=>$sub_total,'total'=>$amount,'contact_info'=>$request->contact_info,'order_customers'=>$result->getResult()->getCustomer(),'order_charges'=>$apiResponse->getResult()->getPayment(),'schedule'=>$request->schedule]);
                                        $order = FoodOrder::find($latestOrder->id);
                                        if(isset($apply_promo) && !is_null($apply_promo)):
                                            $order->apply_promo_id = $apply_promo->id;
                                        endif;
                                        $order->order_no = '#'.str_pad($latestOrder->id + 1, 3, "0", STR_PAD_LEFT);
                                        $order->save();

                                        Mail::to($user->email)->send(new FoodOrderShipped($order));

                                        Mail::to('documents@theappkit.co.uk')->send(new FoodOrderPlace($order));

                                        FoodCart::whereId($cart->id)->update(['status'=>'1']);
                                        $msg = "Thank you for your purchase.";
                                        return response()->json(['status'=>true,"payload"=>array("order_status"=>$order->status,"order_no"=>$order->order_no,"message"=>$msg,"order_id"=>$order->id)]);
                                    }
                                    else
                                    {
                                        $msg = "We are sorry, but your current payment method could not be processed.";
                                        return response()->json(['status'=>false,"payload"=>array("order_status"=>$order->status,"message"=>$msg)]);
                                    }

                                    //return response()->json(['status'=>true,'message'=>$apiResponse->getResult()]);
                                }
                                else
                                {
                                    return response()->json(['status'=>false,'message'=>$apiResponse->getErrors()]);
                                }
                            }
                            else
                            {
                                return response()->json(['status'=>false,'message'=>$result->getErrors()]);
                            }
                        }
                        catch (ApiException $e)
                        {
                            return response()->json(['status'=>false,'message'=>"Recieved error while calling Square: " . $e->getMessage()]);
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
            }
        else:
            return response()->json(['status'=>false,'message'=>'User not found.']);
        endif;
    }

    public function subscription()
    {
        $square = SquareCredentials::first();
        $client = new SquareClient([ "accessToken" => $square->square_token,"environment" => Environment::SANDBOX ]);
        $subscriptionsApi = $client->getSubscriptionsApi();
        $body_idempotencyKey = '8193148c-9586-11e6-99f9-28cfe92138cf';
        $body_locationId = 'LS7GDEG7C3TQ3';
        $body_planId = uniqid();
        $body_customerId = 'CHFGVKYY8RSV93M5KCYTG4PN0G';
        $body = new \Square\Models\CreateSubscriptionRequest(
            $body_idempotencyKey,
            $body_locationId,
            $body_planId,
            $body_customerId
        );
        $body->setStartDate('2020-08-01');
        $body->setCanceledDate('canceled_date0');
        $body->setTaxPercentage('5');
        $body->setPriceOverrideMoney(new \Square\Models\Money);
        $body->getPriceOverrideMoney()->setAmount(100);
        $body->getPriceOverrideMoney()->setCurrency(\Square\Models\Currency::GBP);
        $body->setCardId('ccof:qy5x8hHGYsgLrp4Q4GB');
        $body->setTimezone('Europe/London');

        $apiResponse = $subscriptionsApi->createSubscription($body);

        if ($apiResponse->isSuccess())
        {
            $createSubscriptionResponse = $apiResponse->getResult();
            return $createSubscriptionResponse;
        }
        else
        {
            $errors = $apiResponse->getErrors();
            return $errors;
        }
    }
}
