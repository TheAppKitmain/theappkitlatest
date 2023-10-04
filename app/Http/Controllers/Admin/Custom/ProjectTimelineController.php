<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Timeline;
use Session;
use Auth;

class ProjectTimelineController extends Controller
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
            $app_id = session('app_id');
            if (Auth::user()->parent_id == 0) {
            $id = Auth::user()->id;
            $project_timelines = Timeline::where('app_id',$app_id)->where('user_id',$id)->get();
            }else{
            $id = Auth::user()->parent_id;
            $project_timelines = Timeline::where('app_id',$app_id)->where('user_id',$id)->get();    
            }
            return view('admin.custom.project_timeline', compact('project_timelines'));
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
