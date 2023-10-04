<?php

namespace App\Http\Controllers\Admin\Template\Booking;

use App\Http\Controllers\Controller;
use App\Models\Template\Booking\BookingFaq;
use App\Models\Template\Booking\BookingAppUser;
use App\ThemeTemplate;
use Illuminate\Http\Request;

class FaqController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public function add_admin_user($user_id,$user_name,$user_email,$mobile){
    $user = new BookingAppUser;
    $user->name = $user_name;
    $user->email = $user_email;
    $user->password = \Hash::make('123456');
    $user->admin_id = $user_id;
    $user->mobile = $mobile;
    if($user->save()){
        return redirect('/home');
    }
}

public function index()
{
    $id = auth()->user()->id;
        $template_id = session('theme_id');

        if(session('theme_id') != null){
            $faqs = BookingFaq::where('owner_id', $id)->where('template_id', $template_id)->orderBy('id','desc')->get();
            return view('admin.template.Booking.faq.index',compact('faqs'));
        }
        else{
            Auth::logout();
            return redirect('login');
        }
   
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{   

    $id = auth()->user()->id;
    $template_id = session('theme_id');

    if(session('theme_id') != null){

    $themetemplate = ThemeTemplate::where('id', $template_id)->first();

    }
    else{
        Auth::logout();
        return redirect('login');
    }

    return view('admin.template.Booking.faq.create',compact('themetemplate'));
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{ 
    $this->validate($request,['question'=>"required", 'answer'=>"required"]);
    $faq = new BookingFaq;
    $faq->owner_id = $request->user_id;
    $faq->template_id = $request->template_id;
    $faq->question = $request->question;
    $faq->answer = $request->answer;
    if($faq->save())
    {      
      return redirect()->route('theme.booking_faqs.index')->with(['alert'=>'success','message'=>'Faq has been created successfully!.']);
    }
    else
    {
      return redirect()->route('theme.booking_faqs.index')->with(['alert'=>'danger','message'=>'Faq has not been created!.']);  
    }
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $faq = BookingFaq::find($id);
    return view('admin.template.Booking.faq.edit',compact('faq'));
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
    $this->validate($request,['question'=>"required", 'answer'=>"required"]);
    $faq = BookingFaq::find($id);
    $faq->question = $request->question;
    $faq->answer = $request->answer;
    if($faq->save())
    {   
        return redirect()->route('theme.booking_faqs.index')->with(['alert'=>'success','heading'=>'Well done!','message'=> 'Faq has been updated successfully!.']);
    }
    else
    {
        return redirect()->route('theme.booking_faqs.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Faq has not been updated!.']);  
    }
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    return $id;
    $faq = BookingFaq::find($id);
    if(!is_null($faq))
    {
        $faq->delete(); 
        return redirect()->route('theme.booking_faqs.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>'Faq has been deleted successfully!.']);
    }
    else
    {
        return redirect()->route('theme.booking_faqs.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'Faq has not been deleted!.']);  
    }
}
}
