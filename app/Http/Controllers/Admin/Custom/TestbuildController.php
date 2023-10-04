<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Buildudid;
use App\Testbuild;
use Session;
class TestbuildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_id = session('app_id');
        if($app_id == 0){
            return redirect()->route('app.aboutapp.index')->with('status','Please Add App first');
        } else {
            $all_udids = Buildudid::where('app_id',$app_id)->where('user_id',auth()->user()->id)->get();
            $have_test_builds = Testbuild::where('app_id',$app_id)->where('user_id',auth()->user()->id)->first();
            return view("admin.custom.testbuild",compact('all_udids','have_test_builds'));
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
        $app_id = session('app_id');
        if($app_id == 0){
            return redirect()->route('app.aboutapp.index')->with('status','Please Add App first');
        } 
        else 
        {
            if(count($request->udid)>0){
                foreach($request->udid as $ky=>$val){
                    $adduid = new Buildudid;
                    $adduid->user_id = $request->user_id;
                    $adduid->app_id = $app_id;
                    $adduid->udid = $val;
                    if(!empty($request->add_screenshot[$ky])){
                        foreach($request->file('add_screenshot') as $key=>$value){
                            if($ky == $key){
                                $image_name = date('dmy_H_s_i');
                                $ext = strtolower($value->getClientOriginalExtension());
                                $image_full_name = $image_name.'_'.$key.'.'.$ext;
                                $upload_path = 'media/';
                                $image_url = $upload_path.$image_full_name;
                                $success = $value->move($upload_path,$image_full_name);
                                $adduid->add_screenshot = $image_url;
                            }
                        }
                    }
                    $adduid->save();
                }
            }
            session::flash('statuscode','info');
            return back()->with('status','UDID submitted successfully');
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
    public function update(Request $request)
    {
        dd($request->all());
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
