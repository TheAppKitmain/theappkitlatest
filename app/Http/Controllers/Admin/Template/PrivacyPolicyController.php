<?php

namespace App\Http\Controllers\Admin\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\TempPrivacyPolicy;
use App\ThemeTemplate;
use Session;

class PrivacyPolicyController extends Controller
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

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $privacy_policy = TempPrivacyPolicy::where('owner_id', $id)->where('template_id', $template_id)->get();
        return view('admin.template.privacy_policy', compact('themetemplate','privacy_policy'));
        
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
        $privacy_policy = new TempPrivacyPolicy;
        $privacy_policy->owner_id = $request->user_id;
        $privacy_policy->template_id = $request->template_id;
        $privacy_policy->privacy_content = $request->privacy_content;
    
        if($privacy_policy->save())
        {
            session::flash('statuscode','info');
            return back()->with('status','Privacy policy has been created!.');
          
        }
        else
        {
            session::flash('statuscode','info');
            return back()->with('status','Privacy policy has not been created!.');
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
