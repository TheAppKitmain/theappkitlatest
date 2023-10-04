<?php

namespace App\Http\Controllers\Admin\Template\Meal_Prep;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\E_Commerce\eComm_stripe_credentials;
use App\ThemeTemplate;
use Session;

class ECommStripeCredentialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $template_id = session('theme_id');
        if(session('theme_id') != null){
        $stripes = eComm_stripe_credentials::orderBy('id','desc')->where('owner_id', $id)->where('template_id', $template_id)->paginate(6);
        }
        else{
            Auth::logout();
            return redirect('login');
        }
        return view('admin.template.E_Commerce.Stripe_credential.index',compact('stripes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template_id = session('theme_id');
        if(session('theme_id') != null){
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        return view('admin.template.E_Commerce.Stripe_credential.create', compact('themetemplate'));
        }
        else{
            Auth::logout();
            return redirect('login');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storestripe(Request $request)
    {

        $stripe = new eComm_stripe_credentials;
        $stripe->owner_id = $request->owner_id;
        $stripe->template_id = $request->template_id;
        $stripe->stripe_key = $request->stripe_key;
        $stripe->stripe_secret = $request->stripe_secret;
        $stripe->save();

        session::flash('statuscode','info');
        return redirect('theme/stripe')->with('status','Data is Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\eComm_stripe_credentials  $eComm_stripe_credentials
     * @return \Illuminate\Http\Response
     */
    public function show(eComm_stripe_credentials $eComm_stripe_credentials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\eComm_stripe_credentials  $eComm_stripe_credentials
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $stripe = eComm_stripe_credentials::findOrFail($id);
        $template_id = session('theme_id');
        if(session('theme_id') != null){
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        return view('admin.template.E_Commerce.Stripe_credential.edit', compact('themetemplate','stripe'));
        }
        else{
            Auth::logout();
            return redirect('login');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\eComm_stripe_credentials  $eComm_stripe_credentials
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

        {
            $this->validate($request,['stripe_key'=>'unique:e_comm_stripe_credentials,stripe_key,'.$id]);
            $stripe= eComm_stripe_credentials::find($id);
            $stripe->owner_id = $request->owner_id;
            $stripe->template_id = $request->template_id;
            $stripe->stripe_key = $request->stripe_key;
            $stripe->stripe_secret = $request->stripe_secret;
            $stripe->update();

            session::flash('statuscode','info');
            return redirect('theme/stripe')->with('status','Data is Updated');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\eComm_stripe_credentials  $eComm_stripe_credentials
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stripes = eComm_stripe_credentials::where('id',$id);
        $stripes->delete();
        Session::flash('statuscode','info');
        return redirect('theme/stripe')->with('status','Stripe is Deleted');
    }
}
