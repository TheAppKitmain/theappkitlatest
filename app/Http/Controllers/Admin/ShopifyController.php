<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use App\Mail\Sendtaskupdate;
use App\Mail\SendTaskprogressupdate;
use App\Usertheme;
use App\ThemeTemplate;
use App\User;
use App\Mail\BugStatus;
use App\Mail\MaintenanceMail;
use App\Aboutapp;
use App\StoreInformation;
use App\Designdetail;
use App\Domaindetail;
use App\Bug;
use App\Payment;
use App\AboutappNote;
use App\Buildudid;
use App\quote;
use App\QuoteTier;
use App\Assignpm;
use App\app_notification;
use Auth;
use App\Mail\BuildMail;
use App\Timeline;
use App\Devloperapps;
use App\Agreement;
use App\App_PushNotification;

class ShopifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = null)
    {
       
            $super_users = User::where('role_id', 5)->get();

            $users = User::where('parent_id', 0)->where('user_type', 'shopify')->orderBy('id', 'desc')->get();

            return view('admin.super_admin.shopify_users', compact('users', 'super_users'));
        
    }

    public function show_shopify_users($id)
    {
        $user = User::where('id', $id)->first();
        if (is_null($user)) {
            return back()->with('error', 'No User Found');
        } else {
            return view('admin.super_admin.shopify_view', compact('user'));
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
