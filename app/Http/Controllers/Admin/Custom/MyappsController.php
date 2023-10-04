<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Aboutapp;


class MyappsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mywebapps()
    {
        if (Auth::user()->parent_id == 0) {
            $id =  Auth::user()->id;
            $aboutapps = Aboutapp::with('designdetail')->where('user_id', $id)->where('platform_type', 'web')->get();
        } else {
            $id =  Auth::user()->parent_id;
            $aboutapps = Aboutapp::with('designdetail')->where('user_id', $id)->where('platform_type', 'web')->get();
        }
        return view("admin.custom.myapps", compact('aboutapps'));
    }

    public function index()
    {
        if (Auth::user()->parent_id == 0) {
            $id =  Auth::user()->id;
            $aboutapps = Aboutapp::with('designdetail')->where('user_id', $id)->where('platform_type', 'app')->get();
        } else {
            $id =  Auth::user()->parent_id;
            $aboutapps = Aboutapp::with('designdetail')->where('user_id', $id)->where('platform_type', 'app')->get();
        }
        // $aboutwebapps = Aboutapp::with('designdetail')->where('user_id', $id)->where('platform_type','web')->get();
        return view("admin.custom.myapps", compact('aboutapps'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aboutapp = Aboutapp::where('user_id', $id)->latest()->first();
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
