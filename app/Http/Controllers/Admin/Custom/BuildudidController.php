<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Buildudid;
use App\Testbuild;
use Session;
class BuildudidController extends Controller
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
            return view("admin.custom.buildudid",compact('all_udids','have_test_builds'));
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
            $total_udids= count($request->main_id);
            if($total_udids > 0){
                $add_ids = array();
                for ($n=0; $n < $total_udids; $n++){ 
                    if($request->main_id[$n] == "0"){
                        $adduid = new Buildudid;
                        $adduid->user_id =  $request->user_id;
                        $adduid->app_id = $app_id;
                        $adduid->udid = $request->udid[$n];
                        if(!empty($request->file('add_screenshot')[$n])){
                           $image = $request->file('add_screenshot')[$n];
                           $image_full_name = time().'.'.$image->extension();
                           $upload_path = 'media/';
                           $image_url = $upload_path.$image_full_name;
                           $success = $image->move($upload_path,$image_full_name);
                           $adduid->add_screenshot = $image_url;
                        }
                        $adduid->save();
                        array_push($add_ids, $adduid->id);
                      } 
                      else 
                      {   
                        $adduid = Buildudid::find($request->main_id[$n]);
                        $adduid->user_id = $request->user_id;
                        $adduid->app_id = $app_id;
                        $adduid->udid = $request->udid[$n];
                        if(!empty($request->file('add_screenshot')[$n])){
                           $image = $request->file('add_screenshot')[$n];
                           $image_full_name = time().'.'.$image->extension();
                           $upload_path = 'media/';
                           $image_url = $upload_path.$image_full_name;
                           $success = $image->move($upload_path,$image_full_name);
                           $adduid->add_screenshot = $image_url;
                        }
                        $adduid->save();
                        array_push($add_ids, $adduid->id);
                    }
                }
                $delete_rest =  Buildudid::where('user_id',auth()->user()->id)->where('app_id',$app_id)->whereNotIn('id',$add_ids)->delete();
                session::flash('statuscode','info');
                return back()->with('status','UDID submitted successfully');
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
