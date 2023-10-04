<?php

namespace App\Http\Controllers\API\E_Commerce;
use App\Models\Template\E_Commerce\eComm_stripe_credentials;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderInvoice;
use App\Models\Template\E_Commerce\AppUser;
use App\Models\Template\E_Commerce\EcomCoupon;
use App\Models\Template\E_Commerce\Product;
use App\Models\Template\E_Commerce\EcommCart;
use App\Models\Template\E_Commerce\ShippingAddress;
use App\Models\Template\E_Commerce\PushNotification;
use App\Models\Template\E_Commerce\Shipping;
use App\Models\Template\E_Commerce\EcommDeviceType;
use App\Mail\OrderShipped;
use App\Models\Template\E_Commerce\Order;
use Stripe\Stripe;  
use Stripe\Charge;
use Stripe\Customer;  
use Auth;
use App\Models\Template\E_Commerce\EcommCartDetail;
use Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generate_token()
    { 
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
        $connectionToken = $stripe->tokens->create([
          'card' => [
            'number' => '2223003122003222',
            'exp_month' => 05,
            'exp_year' => 2023,
            'cvc' => '456',
          ],
        ]);
        return $connectionToken;
    }


    public function ecomm_payment(Request $request)
    {
        $rules = ['stripeToken'=>'required','shipping'=>'required','cart_id'=>'required|numeric','address_id'=>'required|numeric'];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        }
        else
        {
            $user = AppUser::find(auth('app_user_api')->user()->id);
            $stripe = eComm_stripe_credentials::where('owner_id', $user->owner_id)->where('template_id', $user->template_id)->first();

            if(!is_null($stripe))
            {
                Stripe::setApiKey($stripe->stripe_secret);
                try
                {
                    $cart = EcommCart::where('id', $request->cart_id)->first();
                    $address = ShippingAddress::where('id', $request->address_id)->first();
                    $apply_promo = EcomCoupon::find($cart->id);
                    $amount = $cart->grand_total;
                    
                    $charge = \Stripe\PaymentIntent::create(array(
    
                        'customer' => $user->stripe_customer_id,
                        'amount'   => $amount*100, 
                        'currency' => 'inr',
                        'shipping' => array("address"=>$request->shipping,"name"=>$address->full_name,"phone"=>$address->number),
                        'receipt_email'=>$user->email,
                        'capture_method' => 'manual',
                        'payment_method_types' => ['card'],
                        'confirm'=>true,
                        'payment_method'=>$request->stripeToken,
    
                    ));
        
                    $status = $charge['status'];
    
                    if($status == "requires_capture")
                    {
                        $cartdetails = EcommCartDetail::where('cart_id',$request->cart_id)->get();
                        foreach($cartdetails as $cartdetail):
                            $total = $cartdetail->price*$cartdetail->qty;
                            $latestOrders = Order::create(['cart_id'=>$cart->id,'cart_detail_id'=>$cartdetail->id,'product_id'=>$cartdetail->product_id,'owner_id'=>$user->owner_id,'template_id'=>$user->template_id ,'app_user_id'=>$user->id,'subtotal'=>$total,'total'=>$total,'address_id'=>$address->id,'charge_id'=>$charge->id,'stripe_customer_id'=>$user->stripe_customer_id,]);
                        endforeach;

                        $orders = Order::where('cart_id',$request->cart_id)->get();
                        foreach($orders as $order):
                                $order = Order::find($order->id);
                                $order->order_number = '#'.str_pad($order->id + 1, 3, "0", STR_PAD_LEFT);
                                $order->save();
                                Mail::to($user->email)->send(new OrderShipped($order));
                        endforeach;
    
                        EcommCart::where('id',$request->cart_id)->update(['status'=>'1']);
                        $msg = "Thank you for your purchase.";
                        return response()->json(['status'=>true,"payload"=>array("message"=>$msg)]);

                    }

                    elseif ($status == "pending")
                    {
                        $msg = "We are sorry, but your current payment method could not be processed.";
                        return response()->json(['status'=>false,"payload"=>array("message"=>$msg)]);
                    }
                    else
                    {
                        $msg = "We are sorry, but your current payment method could not be processed.";
                        return response()->json(['status'=>false,"payload"=>array("message"=>$msg)]);
                    }
                } catch(\Stripe\Exception\CardException $e)
                {
        
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
         
		}
			
    }

    public function my_orders(Request $request)
	{
        $user = AppUser::find(auth('app_user_api')->user()->id);
		if(!is_null($user)):
			$orders = Order::with('products')->where('app_user_id',$user->id)->get();
			if(count($orders)>0):
				foreach($orders as $order):
                    if($order->delivery_at == "0000-00-00"):
                    $order->date = \Carbon\Carbon::parse($order->created_at)->addDays(10)->isoFormat('MMM Do');
                    else:
                    $order->date = \Carbon\Carbon::parse($order->delivery_at)->isoFormat('MMM Do');
                    endif;
				endforeach;
				return response()->json(['status'=>true,"message"=>"Your Orders",'payload'=>$orders]);
			else:
				return response()->json(['status'=>false,"message"=>"You've not any order yet."]);
			endif;
		else:
			return response()->json(['status'=>false,"message"=>"No user found."]);
		endif;
	}

    public function order_details(Request $request)
	{
        $order = Order::where('id',$request->order_id)->first();

        if($order->delivery_at == "0000-00-00"):
            $delivery_at = \Carbon\Carbon::parse($order->created_at)->addDays(10)->isoFormat('Do MMM YYYY');
            else:
            $delivery_at = \Carbon\Carbon::parse($order->delivery_at)->isoFormat('Do MMM YYYY');
        endif;
        $created_at = \Carbon\Carbon::parse($order->created_at)->isoFormat('Do MMM YYYY');
        $cartdetail = EcommCartDetail::where('cart_id',$order->cart_id)->first();
        $product = Product::where('id',$cartdetail->product_id)->first();
        $shipping = Shipping::where('user_id',$order->owner_id)->where('template_id',$order->template_id)->first();
        $product_price = $product->product_price*$cartdetail->qty;
        $sale_price = $product->sale_price*$cartdetail->qty;
        $total_price = $sale_price+$shipping->shipping_price;
        $total_price = $product_price+$shipping->shipping_price;

        if($sale_price == 0){
            $total_price = $product_price+$shipping->shipping_price;     
        }else{
            $total_price = $sale_price+$shipping->shipping_price;
        }

        $address = ShippingAddress::where('id', $order->address_id)->first();

        return response()->json(['status'=>True,'order' => $order,'cartdetail' => $cartdetail,'product' => $product,'address' => $address,'shipping' => $shipping,'delivery_at' => $delivery_at,'ordered_at' => $created_at,'product_price' => $product_price,'total_price'=>$total_price,'sale_price'=>$sale_price]);
	}

    public function invoice(Request $request) 
    { 

        $order = Order::find($request->order_id);

		if(!is_null($order)):
		
			$app_id = $order->app_user->id;

			$device = EcommDeviceType::where('app_user_id',$app_id)->first();
            $user = AppUser::find($app_id);
			$registration_ids = $device->firebase_token;

            Mail::to($user->email)->send(new OrderInvoice($order));
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
                        "order_no"=> $order->order_number
                    ]
                ];
            PushNotification::send($message);
			
			return response()->json(['status'=>true,"message"=>"Invoice has been sent to your mail"]);
		else:
			return response()->json(['status'=>false,"message"=>"Invoice has been not been sent to your mail"]);
		endif;
    }
}