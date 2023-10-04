<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentMail;
use App\AboutappNote;
use App\UserSubcription;
use Session;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Auth;

class PaymentController extends Controller
{

	public function publish_app(Request $request){
		//dd($request->all());
        try
        {  
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
             $user_id = auth()->user()->id;
            $check_cust = UserSubcription::where('user_id',$user_id)->first();
            if(is_null($check_cust)){
              $customer = $stripe->customers->create([
                  "name" => $request->customer_name,
                  "email" => $request->customer_email,
                  // "phone" => $request->customer_mobile,
                  "description" => 'My First Test Customer (created for API docs)',
                  "source" => $request->token,
              ]);
              $customer_id = $customer->id;
            }
            else
            {
              $customer_id = $check_cust->stripe_cust_id;
            }
            
            
            
            $subscription = $stripe->subscriptions->create([
              'customer' => $customer_id,
              'items' => [
                [
                  'price' => $request->plan_id,
                  'quantity' => 1,
                ],
              ],
            ]);
            
            if($subscription->status == 'active'){
              if(!is_null($check_cust)){
                  $check_cust->template_id = $request->template_id;
                  $check_cust->stripe_cust_id = $customer_id;
                  $check_cust->subcription_id = $subscription->id;
                  $check_cust->save();
                  // return response()->json(['status'=>true,'message'=>'subscription created succefully.']);
                 
              }
              else
              {
                  $check_cust = new UserSubcription;
                  $check_cust->user_id = $user_id;
                  $check_cust->template_id = $request->template_id;
                  $check_cust->stripe_cust_id = $customer_id;
                  $check_cust->subcription_id = $subscription->id;
                  $check_cust->save();
                  
              }
              
              $usertheme = \App\ThemeTemplate::where('id', $request->template_id)->first();

                $dataList = array();
                $dataList['customer_name'] = $request->customer_name;
                $dataList['theme_name'] = $usertheme->theme_name;
            
              Mail::to($request->customer_email)->send(new PaymentMail($dataList));
              
              return redirect()->route('theme.publish.index')->with('success', 'Your subscription is start');
            } 
            else 
            {
                return response()->json(['status'=>false,'message'=>'Something went wrong.']);
            } 
        }
        catch(\Stripe\Exception\CardException $e)
        {
          $payload = array("status"=>$e->getHttpStatus(),"type"=>$e->getError()->type,"code"=>$e->getError()->code,"param"=>$e->getError()->param,"message"=>$e->getError()->message);
          return response()->json(['status'=>false,"payload"=>$payload,"message"=>$e->getError()->message]);
        } 
        catch (\Stripe\Exception\RateLimitException $e)
        {
          return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
        catch (\Stripe\Exception\InvalidRequestException $e)
        {
          return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
        catch (\Stripe\Exception\AuthenticationException $e)
        {
          return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
        catch (\Stripe\Exception\ApiConnectionException $e)
        {
          return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
        catch (\Stripe\Exception\ApiErrorException $e)
        {
          return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
        catch (Exception $e)
        {
          return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }


    public function subscription_details(Request $request){
       $user_id = auth()->user()->id;
       $template_id = 1; //$request->template_id;
       $check_subscription = UserSubcription::where('user_id',$user_id)->where('template_id',$template_id)->first();
       if(!is_null($check_subscription)){
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
            $check_subscription = $stripe->subscriptions->retrieve($check_subscription->subcription_id,[]);
            if($check_subscription->status == 'active'){
                $subscription =array();
                $subscription['id'] = $check_subscription->id;
                $subscription['next_payment'] = date('Y-m-d H:i:s', $check_subscription->current_period_end);
                $customer = $stripe->customers->retrieve($check_subscription->customer,[]);
                $card = $stripe->customers->retrieveSource(
                  $customer->id,
                  $customer->default_source,
                  []
                );
                $subscription['payment_method'] = $card->brand;
                $subscription['stripe_customer_id'] = $customer->id;
                $invoice =  $stripe->invoices->retrieve($check_subscription->latest_invoice,[]); 
                $subscription['invoice'] = $invoice->invoice_pdf;

                return response()->json(['status'=>true,'message'=>'Subscription Details','payload'=>$subscription]);
            }
            else
            {
                return response()->json(['status'=>true,'message'=>'Your subscription is not in active state']);
            }  
       }
       else
       {
            return response()->json(['status'=>false,'message'=>'You have no active subscription plain']);
       }
    }

    public function cancel_subscription(Request $request){
         $user_id = auth()->user()->id;
         $template_id = $request->template_id;
         $check_subscription = UserSubcription::where('user_id',$user_id)->where('template_id',$template_id)->first();
         if(!is_null($check_subscription)){
              $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
              $subscription = $stripe->subscriptions->retrieve($check_subscription->subcription_id,[]);
              if($subscription->status == 'active'){
                  $cancel_subscription = $stripe->subscriptions->cancel($subscription->id,[]);
                  if($cancel_subscription){
                      $check_subscription->status = 3;
                      if($check_subscription->save()){

                      	return redirect()->route('theme.publish.index')->with('success', 'Your subscription is canceled');
                          //return response()->json(['status'=>true,'message'=>'Your subscription is canceled']);
                      }
                  }
                  else
                  {
                      return response()->json(['status'=>true,'message'=>'Something went wrong']);
                  }
              }
              elseif ($subscription->status == 'canceled')
              {
                  return response()->json(['status'=>true,'message'=>'Your subscription is already cancelled']);
              } 
              else
              {
                  return response()->json(['status'=>true,'message'=>'Your subscription is not in active state']);
              }  
         }
         else
         {
              return response()->json(['status'=>false,'message'=>'You have no active subscription plain']);
         }
    }

    public function update_subscription(Request $request){
    	//dd($request->all());
         $user_id = auth()->user()->id;
         $template_id = $request->template_id;
         $plan_id = $request->plan_id;
         $check_subscription = UserSubcription::where('user_id',$user_id)->where('template_id',$template_id)->first();
         if(!is_null($check_subscription)){
              $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
              $get_details = $stripe->subscriptions->retrieve($check_subscription->subcription_id);
              $subscription = $stripe->subscriptions->update($check_subscription->subcription_id, [
                  'cancel_at_period_end' => false,
                  'proration_behavior' => 'create_prorations',
                  'items' => [
                    [
                      'id' => $get_details->items->data[0]->id,
                      'price' => $plan_id,
                    ],
                  ],
                ]);
              return redirect()->route('theme.publish.index')->with('success', 'Your subscription Plan is updated Successfully');

              //return $subscription; 
  
         }
         else
         {
              return response()->json(['status'=>false,'message'=>'You have no active subscription plain']);
         }
    }
}