<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Assignpm;
use Auth;
use App\User;
use App\quote;

class ProjectmanagerclientController extends Controller
{
    public function myclientspending()
    {
       $superuserId = Auth::id();
        $getall_pending_userid = Assignpm::where('is_confirmed',0)->pluck('customer_id');
       if($getall_pending_userid->isEmpty()){
        $get_customerdata = 0;
       }else{
        $get_customerdata = User::whereIn('id',$getall_pending_userid)->get();
       }
       return view('admin.super_admin.mypendingclients',compact('get_customerdata'));
    }

    public function myclientsconfirmed()
    {
      $superuserId = Auth::id();
       $getall_pending_userid = Assignpm::where('is_confirmed',1)->pluck('customer_id');
       if($getall_pending_userid->isEmpty()){
        $get_customerdata = 0;
       }else{
        $get_customerdata = User::whereIn('id',$getall_pending_userid)->get();
       }
       return view('admin.super_admin.myconfirmedclients',compact('get_customerdata'));

    }
    


}
