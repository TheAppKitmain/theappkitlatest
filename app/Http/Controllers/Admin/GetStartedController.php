<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\GetStartedMail;
use Session;
use Illuminate\Http\Request;

class GetStartedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('parent_id', 0)->where('user_type', 'custom')->where('parent_id', 0)->orderBy('id', 'desc')->get();
        return view('admin.super_admin.get_started', compact('users'));
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
        $user = User::find($id);
        $user->active_status = "1";
        $user->save();

        $dataList['business_name'] = $user->business_name;
        $dataList['first_name'] = $user->first_name;
        if ($user->parent_id == 0) {
            $user_child = User::where('parent_id', $user->id)->get();
            if (count($user_child) > 0) {
                foreach ($user_child as $child) {
                    Mail::to($child->email)->send(new GetStartedMail($dataList));
                }
            }
            Mail::to($user->email)->send(new GetStartedMail($dataList));
        }else{      
           $userparent = User::where('id', $user->parent_id)->first();
            if (!is_null($userparent)) {
                $user_child = User::where('parent_id', $userparent->id)->get();
                if (count($user_child) > 0) {
                    foreach ($user_child as $child) {
                        Mail::to($child->email)->send(new GetStartedMail($dataList));
                    }
                }
                Mail::to($userparent->email)->send(new GetStartedMail($dataList));    
            }
        }

        session::flash('statuscode','info');
        return back()->with('status','Submitted');
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
