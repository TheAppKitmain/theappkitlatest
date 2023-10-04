<?php

namespace App\Http\Controllers\Admin;

use App\Aboutapp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Testbuild;
use Illuminate\Support\Facades\Mail;
use App\Mail\BuildMail;
use App\Mail\BuildPmMail;
use App\Agreement;
use App\User;
use Session;

class UploadbuildController extends Controller
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
    public function store(Request $request){   
        $newUser = \App\Testbuild::updateOrCreate(['user_id' => $request['user_id']],[
            'app_id' =>$request['app_id'],
            'androidbuild' => $request['androidbuild'],
            'iosbuild' => $request['iosbuild']
        ]);
        if($newUser){
           session::flash('statuscode','info');
           session::flash('goto_tab','Builds');           
           $user = User::find($request->user_id);
           $app = Aboutapp::find($request->app_id);
    
           if($newUser->status_i == 1 && $newUser->status_a == 1){

                $bugstatus['business_name'] = $user->business_name;
                $bugstatus['first_name'] = $user->first_name;
                $bugstatus['app_name'] = $app->app_name;
                $bugstatus['androidbuild'] = $request->androidbuild;
                $bugstatus['iosbuild'] = $request->iosbuild;

                if ($user->parent_id == 0) {
                    $user_child = User::where('parent_id', $user->id)->get();
                    if (count($user_child) > 0) {
                        foreach ($user_child as $child) {
                            Mail::to($child->email)->send(new BuildMail($bugstatus));
                        }
                    }
                    Mail::to($user->email)->send(new BuildMail($bugstatus));

                }else{
                    $userparent = User::where('id', $user->parent_id)->first();
                    if (!is_null($userparent)) {
                        $user_child = User::where('parent_id', $userparent->id)->get();
                        if (count($user_child) > 0) {
                            foreach ($user_child as $child) {
                                Mail::to($child->email)->send(new BuildMail($bugstatus));
                            }
                        }
                        Mail::to($userparent->email)->send(new BuildMail($bugstatus));    
                    }
                }
            
           }
           elseif($newUser->status_a == 1){

                $bugstatus['business_name'] = $user->business_name;
                $bugstatus['first_name'] = $user->first_name;
                $bugstatus['app_name'] = $app->app_name;
                $bugstatus['androidbuild'] = $request->androidbuild;
                $bugstatus['iosbuild'] = NULL; 
                if ($user->parent_id == 0) {
                    $user_child = User::where('parent_id', $user->id)->get();
                    if (count($user_child) > 0) {
                        foreach ($user_child as $child) {
                            Mail::to($child->email)->send(new BuildMail($bugstatus));
                        }
                    }
                    Mail::to($user->email)->send(new BuildMail($bugstatus));
                }else{      
                   $userparent = User::where('id', $user->parent_id)->first();
                    if (!is_null($userparent)) {
                        $user_child = User::where('parent_id', $userparent->id)->get();
                        if (count($user_child) > 0) {
                            foreach ($user_child as $child) {
                                Mail::to($child->email)->send(new BuildMail($bugstatus));
                            }
                        }
                        Mail::to($userparent->email)->send(new BuildMail($bugstatus));    
                    }
                }
            }
            elseif($newUser->status_i == 1){

                $bugstatus['business_name'] = $user->business_name;
                $bugstatus['first_name'] = $user->first_name;
                $bugstatus['app_name'] = $app->app_name;
                $bugstatus['androidbuild'] = NULL;
                $bugstatus['iosbuild'] = $request->iosbuild; 
                if ($user->parent_id == 0) {
                    $user_child = User::where('parent_id', $user->id)->get();
                    if (count($user_child) > 0) {
                        foreach ($user_child as $child) {
                            Mail::to($child->email)->send(new BuildMail($bugstatus));
                        }
                    }
                    Mail::to($user->email)->send(new BuildMail($bugstatus));
                }else{
                    $userparent = User::where('id', $user->parent_id)->first();
                    if (!is_null($userparent)) {
                        $user_child = User::where('parent_id', $userparent->id)->get();
                        if (count($user_child) > 0) {
                            foreach ($user_child as $child) {
                                Mail::to($child->email)->send(new BuildMail($bugstatus));
                            }
                        }
                        Mail::to($userparent->email)->send(new BuildMail($bugstatus));    
                    }
                }
            }else{

                $bugstatus['business_name'] = $user->business_name;
                $bugstatus['app_name'] = $app->app_name;
                $bugstatus['androidbuild'] = $request->androidbuild;
                $bugstatus['iosbuild'] = $request->iosbuild; 
                $assign_pm = \App\Assignpm::where('customer_id',$user->id)->first();
                if (!is_null($assign_pm)) {
                    $project_manager = User::find($assign_pm->project_manager_id);
                    $bugstatus['first_name'] = $project_manager->first_name;
                    Mail::to($project_manager->email)->send(new BuildPmMail($bugstatus));
                }   
            }

           return back()->with('status','Data is Added');

        } else {
            session::flash('statuscode','error');
            session::flash('goto_tab','Builds');
            return back()->with('status','Something went wrong');
        }

    }


    public function agreement_upload(Request $request){
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['app_id'] = $request->app_id;
        if($request->file('agreement')){
            $file = $request->file('agreement');
            $filename = time() . '.' . $request->file('agreement')->extension();
            $filePath = 'media/';
            $file_url = $filePath.$filename;
            $file->move($filePath, $filename);
            $data['agreement'] = $file_url;
        }
        $agreement = Agreement::create($data);
        if($agreement){
           session::flash('statuscode','info');
           session::flash('goto_tab','Agreement');
           return back()->with('status','Data is Added');
        } else {
            session::flash('statuscode','error');
            return back()->with('status','Something went wrong');
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
