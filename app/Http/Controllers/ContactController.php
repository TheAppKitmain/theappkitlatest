<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Mail;
use App\Mail\ContactUsMail;

class ContactController extends Controller
{
    public function contact_us()
    {
        return view ('appkit_frontend.contact');
    }

    public function contact_appkit_submit(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'msg' => 'required',
            'country' => 'required'
        ]);

        $bugstatus['name'] =  $request->name;
        $bugstatus['email'] =  $request->email;
        $bugstatus['country'] =  $request->country;
        $bugstatus['msg'] =  $request->msg;
        Mail::to('support@theappkit.co.uk')->send(new ContactUsMail($bugstatus));   
        session::flash('statuscode','info');
        return redirect('contact_us')->with('status','Submitted');   
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function shopifymail(Request $request)
    {
        Mail::send('emails.shopify',[
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'business_name' => $request->business_name,
            'web_url' => $request->web_url,
            'email' => $request->email,
            'number' => $request->number,
        ],function($mail) use ($request){
            $mail->from($request->email, $request->first_name);
            $mail->to('support@theappkit.co.uk')->subject('Shopify Mail');
        });
        session::flash('statuscode','info');
        return redirect('shopify')->with('status','Submitted');

    }

    
}


