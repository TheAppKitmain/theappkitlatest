<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\quote;
use App\StripeCustomer;
use Session;
use App\QuoteTier;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendQuote;
use App\Mail\SendQuoteTier;
use App\Assignpm;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request){
        $user_id = $request->user_id;
        if($request->form_type == 'quote'){
        $quote = new \App\quote;
        $quote->quote_title = $request->quote_title;
        $quote->user_id = $user_id;
        $quote->app_id = $request->app_id;
        $quote->currency_type = $request->currency_type;
        if(!empty($request->quote_doc)){
           $image = $request->quote_doc;
           $image_full_name = time().'.'.$image->extension();
           $upload_path = 'media/';
           $image_url = $upload_path.$image_full_name;
           $success = $image->move($upload_path,$image_full_name);
           $quote->quote_doc = $image_url;
         }
          if($quote->save()){
             
             $dataList = array();

            $user = User::find($user_id);

            $dataList['business_name'] = $user->business_name;
            $dataList['quote_doc'] = $quote->quote_doc;

            $get_pm = Assignpm::where('customer_id',$request->user_id)->first();

            if(!is_null($get_pm)){
                $pm = User::find($get_pm->project_manager_id);
                Mail::to($user->email)->cc($pm->email)->cc('support@theappkit.co.uk')->send(new SendQuote($dataList));
            } else {
                Mail::to($user->email)->cc('support@theappkit.co.uk')->send(new SendQuote($dataList));
            }

            session::flash('goto_tab','Quote');
            session::flash('statuscode','info');
            return back()->with('status','Quote submitted successfully');

          }
        }else{
            //dd($request->all());
        $total_prices = count($request->date);
        $quote = \App\quote::where('app_id',$request->app_id)->first();
        if(!is_null($quote)){
        if($total_prices > 0){
            for ($n=0; $n < $total_prices; $n++) { 
                $save_tiear = new \App\QuoteTier;
                $save_tiear->date =  $request->date[$n];
                $save_tiear->quote_id =  $quote->id;
                $save_tiear->tier_price =  $request->quote_price[$n];
                $save_tiear->app_id  =  $request->app_id;
                $save_tiear->invoice_url = $request->invoice_url[$n];
                $save_tiear->currency_type = $request->currency_type;
                $save_tiear->save();
            }
        }else{
            session::flash('goto_tab','Payment');
            session::flash('statuscode','error');
            return back()->with('status','Add Quote First'); 
        }
            // $dataList = array();

            // $user = User::find($user_id);

            // $dataList['business_name'] = $user->business_name;
            // $dataList['invoice_url'] = $request->invoice_url;
            // $dataList['quote_price'] = $request->quote_price;
            // $dataList['date'] = $request->date;
            // $get_pm = Assignpm::where('customer_id',$request->user_id)->first();

            // if(!is_null($get_pm)){
            //     $pm = User::find($get_pm->project_manager_id);
            //     Mail::to($user->email)->cc($pm->email)->send(new SendQuoteTier($dataList));
            // } else {
            //     Mail::to($user->email)->send(new SendQuoteTier($dataList));
            // }

            session::flash('goto_tab','Payment');
            session::flash('statuscode','info');
            return back()->with('status','Quote tiers submitted successfully');
        }
        else
        {   
            session::flash('goto_tab','Quote');
            session::flash('statuscode','error');
            return back()->with('status','Something went wrong');
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    public function update_quote(Request $request, $id){
        $quote = \App\quote::find($id);
        $quote->quote_title = $request->quote_title;
        $quote->currency_type = $request->currency_type;
        if(!empty($request->quote_doc)){
           $image = $request->quote_doc;
           $image_full_name = time().'.'.$image->extension();
           $upload_path = 'media/';
           $image_url = $upload_path.$image_full_name;
           $success = $image->move($upload_path,$image_full_name);
           $quote->quote_doc = $image_url;
        }
        if($quote->save()){
            session::flash('statuscode','info');
            return back()->with('status','Quote Updated successfully');
        }
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Something went wrong');
        }
    }    



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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
    public function update(Request $request, $id){
        $total_count = count($request->tiers_id);
        if($total_count > 0){
            for ($i=0; $i < $total_count; $i++) {
              $quote_tier = \App\QuoteTier::find($request->tiers_id[$i]);
              $quote_tier->invoice_url = $request->invoice_url[$i];
              $quote_tier->save();
            }
        }
        return back()->with('status','Invoice Url Updated successfully');
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
