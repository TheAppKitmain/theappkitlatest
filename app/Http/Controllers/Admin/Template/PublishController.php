<?php

namespace App\Http\Controllers\Admin\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TemplateAppInfo;
use App\ThemeTemplate;
use App\UserSubcription;
use App\User;
use Session;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Auth;

class PublishController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
     $id = auth()->user()->id;
    $usercountry = User::where('id',$id)->first();
    $template_id = session('theme_id');  

    if(session('theme_id') != null){

    $themetemplate = ThemeTemplate::where('id', $template_id)->first();
     $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));

    if($usercountry->country == 'United Kingdom'){
     $plans_retrieve_3 = $stripe->plans->retrieve($themetemplate->monthly_gbp,[]);
     //$plans_retrieve_12 = $stripe->plans->retrieve($themetemplate->yearly_gbp,[]);
    }else{
     $plans_retrieve_3 = $stripe->plans->retrieve($themetemplate->monthly_usd,[]);
     //$plans_retrieve_12 = $stripe->plans->retrieve($themetemplate->yearly_usd,[]);
    }

    $temp = explode(",",$themetemplate->theme_screenshots);
    $subscription = UserSubcription::where('user_id',$id)->where('template_id',$template_id)->first();

    if(!is_null($subscription)){
    	    $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
            $check_subscription = $stripe->subscriptions->retrieve($subscription->subcription_id,[]);
            //dd($check_subscription);
            if($check_subscription->status == 'active'){
                $subs =array();
                $subs['id'] = $check_subscription->id;
                $subs['next_payment'] = date('Y-m-d H:i:s', $check_subscription->current_period_end);
                $subs['payment_start'] = date('Y-m-d H:i:s', $check_subscription->current_period_start);
                $subs['stripe_customer_id'] = $subscription->stripe_cust_id;

                $customer = $stripe->customers->retrieve($check_subscription->customer,[]);
                $card = $stripe->customers->retrieveSource(
                  $customer->id,
                  $customer->default_source,
                  []
                );
                $subs['payment_method'] = $card->brand;
                $invoice =  $stripe->invoices->retrieve($check_subscription->latest_invoice,[]); 
                $subs['invoice'] = $invoice->invoice_pdf;
                $subs['plan'] = $check_subscription->plan;
                //dd($subs);

                // $check_default = $stripe->customers->retrieve($check_subscription->customer);

                $card_lists = $stripe->paymentMethods->all(['customer' => $check_subscription->customer,'type' => 'card',]);
                if(!empty($card_lists->data))
                {   
                    $check_default = $stripe->customers->retrieve($check_subscription->customer);
                    foreach($card_lists as $card)
                    {
                        if($check_default->default_source == $card->id)
                        {
                            $card->default_card = 1;
                        }
                        else
                        {
                            $card->default_card = 0;
                        }
                    }
                    //dd($card_lists);
                }
                

                //need to send susctption data in view blade

                return view('admin.template.viewsubscription', compact('themetemplate','temp','subs','card_lists','check_default'));
                //return response()->json(['status'=>true,'message'=>'Subscription Details','payload'=>$subscription]);
            }else{
                return view('admin.template.publish', compact('themetemplate','temp','template_id','usercountry','plans_retrieve_3'));
            }
    } 
    else
    { 
      return view('admin.template.publish', compact('themetemplate','temp','template_id','usercountry','plans_retrieve_3'));
    }

    }
    else{
        Auth::logout();
        return redirect('login');
    }

}

public function cancel_subscription_view(){
    
        $id = auth()->user()->id;
        $usercountry = User::where('id',$id)->first('country');
        $template_id = session('theme_id');  
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $temp = explode(",",$themetemplate->theme_screenshots);
        $subscription = UserSubcription::where('user_id',$id)->where('template_id',$template_id)->first();
    if(!is_null($subscription)){
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
            $check_subscription = $stripe->subscriptions->retrieve($subscription->subcription_id,[]);
            //dd($check_subscription);
            if($check_subscription->status == 'active'){
                $subs =array();
                $subs['id'] = $check_subscription->id;
                $subs['next_payment'] = date('Y-m-d H:i:s', $check_subscription->current_period_end);
                $subs['payment_start'] = date('Y-m-d H:i:s', $check_subscription->current_period_start);
                $subs['stripe_customer_id'] = $subscription->stripe_cust_id;

                $customer = $stripe->customers->retrieve($check_subscription->customer,[]);
                $card = $stripe->customers->retrieveSource(
                  $customer->id,
                  $customer->default_source,
                  []
                );
                $subs['payment_method'] = $card->brand;
                $invoice =  $stripe->invoices->retrieve($check_subscription->latest_invoice,[]); 
                $subs['invoice'] = $invoice->invoice_pdf;
                $subs['plan'] = $check_subscription->plan;
        return view('admin.template.cancelsubscription',compact('themetemplate','temp','template_id','subs'));
    }
}
}
public function update_subscription_data(){
        $id = auth()->user()->id;
        $usercountry = User::where('id',$id)->first('country');
        $template_id = session('theme_id');  
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $temp = explode(",",$themetemplate->theme_screenshots);
    $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
    if($usercountry->country == 'United Kingdom'){
     $plans_retrieve_3 = $stripe->plans->retrieve($themetemplate->monthly_gbp,[]);
     $plans_retrieve_12 = $stripe->plans->retrieve($themetemplate->yearly_gbp,[]);
    }else{
     $plans_retrieve_3 = $stripe->plans->retrieve($themetemplate->monthly_usd,[]);
     $plans_retrieve_12 = $stripe->plans->retrieve($themetemplate->yearly_usd,[]);
    }
        $subscription = UserSubcription::where('user_id',$id)->where('template_id',$template_id)->first();
    if(!is_null($subscription)){
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
            $check_subscription = $stripe->subscriptions->retrieve($subscription->subcription_id,[]);
            //dd($check_subscription);
            if($check_subscription->status == 'active'){
                $subs =array();
                $subs['id'] = $check_subscription->id;
                $subs['next_payment'] = date('Y-m-d H:i:s', $check_subscription->current_period_end);
                $subs['payment_start'] = date('Y-m-d H:i:s', $check_subscription->current_period_start);
                $subs['stripe_customer_id'] = $subscription->stripe_cust_id;

                $customer = $stripe->customers->retrieve($check_subscription->customer,[]);
                $card = $stripe->customers->retrieveSource(
                  $customer->id,
                  $customer->default_source,
                  []
                );
                $subs['payment_method'] = $card->brand;
                $invoice =  $stripe->invoices->retrieve($check_subscription->latest_invoice,[]); 
                $subs['invoice'] = $invoice->invoice_pdf;
                $subs['plan'] = $check_subscription->plan;
        return view('admin.template.updatesubscription',compact('themetemplate','temp','template_id','subs','usercountry','plans_retrieve_3','plans_retrieve_12'));
    }
}
}

public function update_subscription_single($template_id,$plan_id){
        $id = auth()->user()->id;
        $usercountry = User::where('id',$id)->first('country');
        $template_id = $template_id;  
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $temp = explode(",",$themetemplate->theme_screenshots);
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
        if($usercountry->country == 'United Kingdom'){
         $plans_retrieve = $stripe->plans->retrieve($plan_id,[]);
        }else{
         $plans_retrieve = $stripe->plans->retrieve($plan_id,[]);
        }
        //dd($plans_retrieve);
        $subscription = UserSubcription::where('user_id',$id)->where('template_id',$template_id)->first();
    if(!is_null($subscription)){
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
            $check_subscription = $stripe->subscriptions->retrieve($subscription->subcription_id,[]);
            //dd($check_subscription);
            if($check_subscription->status == 'active'){
                $subs =array();
                $subs['id'] = $check_subscription->id;
                $subs['next_payment'] = date('Y-m-d H:i:s', $check_subscription->current_period_end);
                $subs['payment_start'] = date('Y-m-d H:i:s', $check_subscription->current_period_start);
                $subs['stripe_customer_id'] = $subscription->stripe_cust_id;

                $customer = $stripe->customers->retrieve($check_subscription->customer,[]);
                $card = $stripe->customers->retrieveSource(
                  $customer->id,
                  $customer->default_source,
                  []
                );
                $subs['payment_method'] = $card->brand;
                $invoice =  $stripe->invoices->retrieve($check_subscription->latest_invoice,[]); 
                $subs['invoice'] = $invoice->invoice_pdf;
                $subs['plan'] = $check_subscription->plan;

return view('admin.template.confirmupdatesubscription',compact('themetemplate','temp','template_id','subs','usercountry','plans_retrieve'));
} 
}
}

public function addpayment_method(){

        $id = auth()->user()->id;
        $usercountry = User::where('id',$id)->first('country');
        $template_id = session('theme_id');  
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $temp = explode(",",$themetemplate->theme_screenshots);

    return view('admin.template.addpaymentmethod',compact('themetemplate','temp','template_id'));
    
}

public function addpayment_method_data(Request $request){
   
   //dd($request->all());
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

            $create_card = $stripe->customers->createSource(
                      $customer_id,
                      ['source' => $request->token]
                    );
            if($request->card_default == 'yes'){
                $customer = $stripe->customers->retrieve($customer_id);
                $customer->default_source = $create_card->id;
                $customer->save();
            }
            return redirect()->route('theme.publish.index')->with('success', 'Card is added sucessfully');

}
public function deletepayment_method(Request $request){

    //dd($request->all());
    $user = User::find($request->user()->id);
    $check_subscription = UserSubcription::where('user_id',$user->id)->first();
               if(!is_null($check_subscription))
               {
                    $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
                    $remove_card = $stripe->customers->deleteSource($check_subscription->stripe_cust_id,$request->card_id);
                    if($remove_card->deleted == true)
                    {
                        //return response()->json(['status'=>true,'message'=>'Card deleted successfully','payload'=>$remove_card]);
                        return redirect()->route('theme.publish.index')->with('success', 'Card is added sucessfully');
                    }
                    else
                    {
                        return response()->json(['status'=>true,'message'=>'Something went wrong']);
                    }                           
               }

}
public function defaultpayment_method(Request $request){
               $user = User::find($request->user()->id);
               $check_subscription = UserSubcription::where('user_id',$user->id)->first();
               if(!is_null($check_subscription))
               {
                $stripe = new \Stripe\StripeClient(config('stripe.stripe_secret'));
                $customer = $stripe->customers->retrieve($check_subscription->stripe_cust_id);
                $customer->default_source = $request->card_id;
                $customer->save();
                return redirect()->route('theme.publish.index')->with('success', 'Default added sucessfully');
               }
}    

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
//
}

/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{

//

}

/**
* Display the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{

}

/**
* Show the form for editing the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
//
}

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
//
}

/**
* Remove the specified resource from storage.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
//
}
}