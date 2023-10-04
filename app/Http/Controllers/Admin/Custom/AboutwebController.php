<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use App\Aboutapp;
use App\Aboutweb;
use App\Designdetail;
use Illuminate\Http\Request;
use Image;
use Session;

class AboutwebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	dd("sss");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $id = session()->put('app_id', 0);
        $about_app = Aboutapp::find($id);
        return view("admin.custom.aboutwebapp",compact('about_app'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//dd($request->all());
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['app_name'] = $request->app_name;
        $data['app_idea'] = $request->app_idea;
        $wireframes = $request->file('wireframes');
        if($wireframes){
            $file = $request->file('wireframes');
            $filename = time() . '.' . $request->file('wireframes')->extension();
            $filePath = 'media/';
            $file_url = $filePath.$filename;
            $file->move($filePath, $filename);
            $data['wireframes'] = $file_url;
        }
        $data['idea'] = $request->idea;
        $data['lookfor'] = 'website';
        $data['domain'] = $request->domain;
        $data['website'] = $request->website;
        $data['platform_type'] = $request->typeforplatfor;
        $aboutapp = Aboutapp::create($data);
        if(!empty($aboutapp)){
            if($request->file('app_logo')){
                $app_logo = new Designdetail;
                $app_logo->user_id = $request->user_id;
                $app_logo->app_id = $aboutapp->id;
                $file = $request->file('app_logo');
                $filename = 'logo'.time() . '.' . $request->file('app_logo')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $app_logo->logo = $file_url;
                $app_logo->save();
            }
            session()->put('app_id', $aboutapp->id);
            session::flash('statuscode','info');
            session::flash('schedulecode','schedule');
            return redirect('myapps')->with('status','Great! Schedule a chat with an advisor');
        } 
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aboutweb  $aboutweb
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        session()->put('app_id', $id);
        $about_app = Aboutapp::find($id);
        return view("admin.custom.aboutwebapp",compact('about_app'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aboutweb  $aboutweb
     * @return \Illuminate\Http\Response
     */
    public function edit(Aboutweb $aboutweb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aboutweb  $aboutweb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['app_name'] = $request->app_name;
        $data['app_idea'] = $request->app_idea;
        if($request->has('wireframes')){
            $file = $request->file('wireframes');
            $filename = time() . '.' . $request->file('wireframes')->extension();
            $filePath = 'media/';
            $file_url = $filePath.$filename;
            $file->move($filePath, $filename);
            $data['wireframes'] = $file_url;
        }
        $data['idea'] = $request->idea;
        $data['lookfor'] = 'website';
        $data['domain'] = $request->domain;
        $data['website'] = $request->website;
        $data['platform_type'] = $request->typeforplatfor;
        $aboutapp = Aboutapp::where('id',$id)->update($data);
        if($aboutapp == true){
            if($request->has('app_logo')){
                $check_alredy = Designdetail::where('user_id',$request->user_id)->where('app_id',$id)->first();
                if(!is_null($check_alredy)){
                    $file = $request->file('app_logo');
                    $filename = 'logo'.time() . '.' . $request->file('app_logo')->extension();
                    $filePath = 'media/';
                    $file_url = $filePath.$filename;
                    $file->move($filePath, $filename);
                    $check_alredy->logo = $file_url;
                    $check_alredy->save();
                } else {
                    $app_logo = new Designdetail;
                    $app_logo->user_id = $request->user_id;
                    $app_logo->app_id = $id;
                    $file = $request->file('app_logo');
                    $filename = 'logo'.time() . '.' . $request->file('app_logo')->extension();
                    $filePath = 'media/';
                    $file_url = $filePath.$filename;
                    $file->move($filePath, $filename);
                    $app_logo->logo = $file_url;
                    $app_logo->save();
                }
            }
            session()->put('app_id', $id);
            session::flash('statuscode','info');
            return redirect('mywebapps')->with('status','Updated');
        } 
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aboutweb  $aboutweb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aboutweb $aboutweb)
    {
        //
    }
}
