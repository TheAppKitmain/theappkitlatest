<?php

namespace App\Http\Controllers\API\App_kit;

use App\Aboutapp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Timeline;
use App\Assignpm;

use Session;

use Auth;



class TaskController extends Controller
{
    public function app_task_index(Request $request)
    {

        $appId = $request->app_id;
        // session()->put('app_id', $appId);
        // $app_id = session('app_id');
        if ($request->role_id == 2) :


            $assignpm = Assignpm::where('project_manager_id', $request->user_id)->first();
            $aboutcustomer = Aboutapp::where('id', $request->app_id)->first();


            if (!is_null($assignpm)) :
                $project_manager = User::where('id', $assignpm->project_manager_id)->select('id', 'business_name', 'first_name', 'last_name', 'avatar')->first();
                if ($project_manager->avatar == "avatar.png") {
                    $project_manager->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                }

                $customer = User::where('id', $aboutcustomer->user_id)->select('id', 'business_name', 'first_name', 'last_name', 'avatar')->first();

                if ($appId == 0) {
                    return response()->json(['Status' => false, 'payload' => 'Please Add App first']);
                } else {

                    $project_timelines = Timeline::where('app_id', $appId)->get();
                    return response()->json(['Status' => true, 'payload' => $project_timelines, 'project_manager' => $project_manager, 'customer' => $customer]);
                }
            else :
                if ($appId == 0) {
                    return response()->json(['Status' => false, 'payload' => 'Please Add App first']);
                } else {
                    $project_timelines = Timeline::where('app_id', $appId)->where('user_id', auth()->user()->id)->get();
                    return response()->json(['Status' => true, 'payload' => $project_timelines, 'project_manager' => "", 'customer' => ""]);
                }

            endif;
        elseif ($request->role_id == 1 ||  $request->role_id == 3) :


            $assignpm = Assignpm::where('customer_id', $request->user_id)->first();
            if (!is_null($assignpm)) :
                $project_manager = User::where('id', $assignpm->project_manager_id)->select('id', 'business_name', 'first_name', 'last_name', 'avatar')->first();
                if ($project_manager->avatar == "avatar.png") {
                    $project_manager->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                }
                $customer = User::where('id', $assignpm->customer_id)->select('id', 'business_name', 'first_name', 'last_name', 'avatar')->first();
                if ($appId == 0) {
                    return response()->json(['Status' => false, 'payload' => 'Please Add App first']);
                } else {
                    $project_timelines = Timeline::where('app_id', $appId)->get();
                    return response()->json(['Status' => true, 'payload' => $project_timelines, 'project_manager' => $project_manager, 'customer' => $customer]);
                }
            else :
                if ($appId == 0) {
                    return response()->json(['Status' => false, 'payload' => 'Please Add App first']);
                } else {

                    $project_timelines = Timeline::where('app_id', $appId)->where('user_id', auth()->user()->id)->get();
                    return response()->json(['Status' => true, 'payload' => $project_timelines, 'project_manager' => "", 'customer' => ""]);
                }

            endif;
        endif;
    }

    public function app_task_show(Request $request)
    {
        $timelineId = $request->id;
        $project_timelines = Timeline::where('id', $timelineId)->where('user_id', auth()->user()->id)->first();
        return response()->json(['Status' => true, 'payload' => $project_timelines]);
    }
}
