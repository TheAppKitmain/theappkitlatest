<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Invoicepayment;
use Auth;
use App\quote;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id = auth()->user()->id;
      $invoicepayment = quote::where('user_id',$id)->first();
      return view('admin.custom.payments', compact('invoicepayment'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $id = $request->user_id;
        // $customer_id = $request->stripe_customer_id;

        // $stripecustomer = StripeCustomer::where('user_id', $customer_id)->first();

        // if(!is_null($stripecustomer))
        // {
        // $user = \App\StripeCustomer::find($customer_id);
        //     //return $user;
        //     \Stripe\Stripe::setApiKey(config('app.stripe_secret'));
        //     $customer = \Stripe\Customer::create(array(
        //         'name'=>$user->first_name." ".$user->last_name,
        //         'email'=>$user->email,
               
        //         'phone'=>$user->number
        //     ));
        // }
        // else
        // {
        //     $user = \App\User::find($id);
        //     //return $user;
        //     \Stripe\Stripe::setApiKey(config('app.stripe_secret'));
        //     $customer = \Stripe\Customer::create(array(
        //         'name'=>$user->first_name." ".$user->last_name,
        //         'email'=>$user->email,
               
        //         'phone'=>$user->number
        //     ));
        //    // return $customer;
        //     StripeCustomer::create([' stripe_customer_id'=>$customer->id,'user_id'=>$user->id]);
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
