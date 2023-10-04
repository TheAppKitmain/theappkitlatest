<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Designdetail;
use Session;

class DesigndetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $app_id = session('app_id');
        if($app_id == 0){
            return redirect()->route('app.aboutapp.index')->with('status','Please Add App first');
        } else {
            $design_details = Designdetail::where('app_id',$app_id)->where('user_id',auth()->user()->id)->first();
            return view("admin.custom.designdetail",compact('design_details'));
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
    public function store(Request $request){
        $app_id = session('app_id');
        if($app_id == 0){
            return redirect()->route('app.aboutapp.index')->with('status','Please Add App first');
        } 
        else 
        { 
            $save = new Designdetail;
            $save->user_id = $request->user_id;
            $save->app_id = $app_id;
            if($request->file('dp1')){
                $file = $request->file('dp1');
                $filename = 'dp1'.time() . '.' . $request->file('dp1')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->dp1 = $file_url;
            }
            if($request->file('dp2')){
                $file = $request->file('dp2');
                $filename = 'dp2'.time() . '.' . $request->file('dp2')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->dp2 = $file_url;
            }
            if($request->file('dp3')){
                $file = $request->file('dp3');
                $filename = 'dp3'.time() . '.' . $request->file('dp3')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->dp3 = $file_url;
            }
            if($request->file('dp4')){
                $file = $request->file('dp4');
                $filename = 'dp4'.time() . '.' . $request->file('dp4')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->dp4 = $file_url;
            }
            if($request->file('logo')){
                $file = $request->file('logo');
                $filename = 'logo'.time() . '.' . $request->file('logo')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->logo = $file_url;
            }
            $save->design_details  = $request->design_details;
            $save->save();
            session::flash('statuscode','info');
            return redirect('app/designdetail')->with('status','Submitted');
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
    public function update(Request $request, $id){
        $app_id = session('app_id');
        if($app_id == 0){
            return redirect()->route('app.aboutapp.index')->with('status','Please Add App first');
        } 
        else 
        {
            $save = Designdetail::find($id);
            $save->user_id = $request->user_id;
            if($request->file('dp1')){
                $file = $request->file('dp1');
                $filename = 'dp1'.time() . '.' . $request->file('dp1')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->dp1 = $file_url;
            }
            if($request->file('dp2')){
                $file = $request->file('dp2');
                $filename = 'dp2'.time() . '.' . $request->file('dp2')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->dp2 = $file_url;
            }
            if($request->file('dp3')){
                $file = $request->file('dp3');
                $filename = 'dp3'.time() . '.' . $request->file('dp3')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->dp3 = $file_url;
            }
            if($request->file('dp4')){
                $file = $request->file('dp4');
                $filename = 'dp4'.time() . '.' . $request->file('dp4')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->dp4 = $file_url;
            }
            if($request->file('logo')){
                $file = $request->file('logo');
                $filename = 'logo'.time() . '.' . $request->file('logo')->extension();
                $filePath = 'media/';
                $file_url = $filePath.$filename;
                $file->move($filePath, $filename);
                $save->logo = $file_url;
            }
            $save->design_details  = $request->design_details;
            $save->update();
            session::flash('statuscode','info');
            return redirect('app/designdetail')->with('status','Updated');
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
