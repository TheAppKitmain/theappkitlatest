<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use App\StoreInformation;
use Illuminate\Http\Request;
use Session;

class StoreInformationController extends Controller
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
    public function store(Request $request)
    { 
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['app_id'] = $request->app_id;
        $data['promotional_text'] = $request->promotional_text;
        $data['app_subtitle'] = $request->app_subtitle;
        $keywords = $request->keywords;
        if($keywords)
        {
            foreach($keywords as $keyword)
            {
                $arr[] = $keyword;
            }
            $data['keywords'] = implode(",", $arr);
       }
        $data['support_url'] = $request->support_url;
        $data['marketing_url'] = $request->marketing_url;
        $data['app_description'] = $request->app_description;
        $data['age_rating'] = $request->age_rating;
        $data['app_country'] = $request->app_country;
        $data['privacy_policy_url'] = $request->privacy_policy_url;
        $data['primary_language'] = $request->primary_language;
        $data['primary_app_category'] = $request->primary_app_category;
        $data['secondary_app_category'] = $request->secondary_app_category;
        $data['app_price'] = $request->app_price;
        $data['address'] = $request->address;
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['number'] = $request->number;

        if($data['app_id'] == 0){
            return redirect()->route('app/appstore')->with('status','Please Add App first');
        }
        else
        {
            if(!empty($data)){
                $storeinformation = StoreInformation::create($data);
                session::flash('statuscode','info');
                return back()->with('status','Submitted');
            }
            else
            {
                session::flash('statuscode','error');
                return back()->with('status','Please fill some data');
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
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['app_id'] = $request->app_id;
        $data['promotional_text'] = $request->promotional_text;
        $data['app_subtitle'] = $request->app_subtitle;
        $keywords = $request->keywords;
        if($keywords)
        {
            foreach($keywords as $keyword)
            {
                $arr[] = $keyword;
            }
            $data['keywords'] = implode(",", $arr);
       }
        $data['support_url'] = $request->support_url;
        $data['marketing_url'] = $request->marketing_url;
        $data['app_description'] = $request->app_description;
        $data['age_rating'] = $request->age_rating;
        $data['app_country'] = $request->app_country;
        $data['privacy_policy_url'] = $request->privacy_policy_url;
        $data['primary_language'] = $request->primary_language;
        $data['primary_app_category'] = $request->primary_app_category;
        $data['secondary_app_category'] = $request->secondary_app_category;
        $data['app_price'] = $request->app_price;
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['number'] = $request->number;
        $data['address'] = $request->address;

        if($data['app_id'] == 0){
            return redirect()->route('app/appstore')->with('status','Please Add App first');
        }
        else
        {
            if(!empty($data)){
                $storeinformation = StoreInformation::where('id',$id)->update($data);
                session::flash('statuscode','info');
                return back()->with('status','Submitted');
            }
            else
            {
                session::flash('statuscode','error');
                return back()->with('status','Please fill some data');
            }
            
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
        //
    }
}
