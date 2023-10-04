<?php

namespace App\Http\Controllers\Admin\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usertheme;
use App\ThemeTemplate;
use App\Usersubdomaintoken;
use Redirect;
use Illuminate\Support\Str;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   
        
        if(Auth::user()->role->name == 'admin')
        {
            return redirect()->route('super_admin');
        }
        
        else
        {
            return view("admin.template.E_Commerce.dashboard");
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

    // public function subdomain($template_id){
    //     $already = Usersubdomaintoken::where('user_id',auth()->user()->id)->where('template_id',$template_id)->first();
    //     if(!is_null($already)){
    //       $already->token =  Str::random(80);
    //       $already->save();
    //     } else {
    //       $already = new Usersubdomaintoken;
    //       $already->user_id = auth()->user()->id;
    //       $already->token =  Str::random(80);
    //       $already->template_id =  $template_id;
    //       $already->save();   
    //     }
    //      $user_token =  $already->token;
    //      $url = config('helper.sub_delivery_url').'/usertoken/'.$user_token;
    //      return Redirect::to($url); 
    // }
}
