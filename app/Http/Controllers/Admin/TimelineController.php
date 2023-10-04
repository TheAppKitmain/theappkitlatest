<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\User;
use App\Timeline;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTask;
use App\Assignpm;
use App\Aboutapp;
use App\app_notification;
use App\App_PushNotification;
use Auth;



class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('user_id');
        $app_id = session('app_id');
        $timelines = Timeline::where('user_id', $id)->where('app_id', $app_id)->get();
        return view('admin.super_admin.timeline', compact('timelines'));
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
        $data['user_id'] = $request->user_id;
        $data['app_id'] = $request->app_id;
        $data['task_type'] = $request->task_type;
        $data['status'] = $request->status;

        $task_descriptions = $request->task_description;

        foreach ($task_descriptions as $task_description) {
            \App\Timeline::create([
                'user_id' => $data['user_id'],
                'app_id' => $data['app_id'],
                'task_type' => $data['task_type'],
                'status' => $data['status'],
                'task_description' => $task_description,
            ]);
        }


        $timeline = \App\Timeline::where('app_id', $request->app_id)->first();

        $dataList = array();

        $user = User::find($data['user_id']);
        $dataList['business_name'] = $user->business_name;
        $dataList['task_description'] = $task_descriptions;

        $get_pm = Assignpm::where('customer_id', $request->user_id)->first();
        if (!is_null($get_pm)) {
            $pm = User::find($get_pm->project_manager_id);
            Mail::to($user->email)->send(new SendTask($dataList));
        } else {
            Mail::to($user->email)->send(new SendTask($dataList));
        }

        $name = Auth::user()->first_name;
        $logo = Auth::user()->avatar;

        $about_app = Aboutapp::where('id', $request->app_id)->first();
        if (!is_null($about_app)) {
            $app_name = $about_app->app_name;
        } else {
            $app_name = "";
        }

        $save_notification = new app_notification;
        $save_notification->user_id = $request->customer_id;
        $save_notification->app_id = $request->app_id;
        $save_notification->app_logo = $logo;
        $save_notification->notify_type = "task";

        $save_notification->owner_id = Auth::id();

        $save_notification->message = $name . " has added a new task in " . $app_name;

        $save_notification->save();



        $andriod_ids = \App\DeviceType::where('user_id', $save_notification->user_id)->where('device_type', 'A')->pluck('firebase_token')->toArray();

        if (count($andriod_ids) > 0) :

            $message = [
                "registration_ids" => $andriod_ids,
                "priority" => 'high',
                "sound" => 'default',
                "badge" => '1',
                "notification" =>
                [
                    "title" => $name . " has added a new task in " . $about_app->app_name,

                ],

                "data" =>
                [
                    "type" => 'notification',
                ]
            ];
            App_PushNotification::send($message);

        endif;

        $ios_ids = \App\DeviceType::where('user_id', $save_notification->user_id)->where('device_type', 'I')
            ->pluck('firebase_token')->toArray();

        if (count($ios_ids) > 0) :

            $message = [
                "registration_ids" => $ios_ids,
                "priority" => 'high',
                "sound" => 'default',
                "badge" => '1',
                "notification" =>
                [
                    "title" => $name . " has added a new task in " . $about_app->app_name,

                ],
                "data" =>
                [
                    "type" => 'notification',
                ]

            ];
            App_PushNotification::send($message);
        endif;

        session::flash('statuscode', 'info');
        return back()->with('status', 'Data is Added');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showuser_app_data($id, $app_id)
    {

        $user = User::where('id', $id)->first();
        $timelines = Timeline::where('user_id', $id)->where('app_id', $app_id)->get();

        return view('admin.super_admin.timeline', compact('timelines', 'user', 'app_id'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $timelines = Timeline::where('user_id', $id)->get();

        return view('admin.super_admin.timeline', compact('timelines', 'user'));
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

    public function custom_delete($id)
    {
        $timelines = Timeline::find($id);
        if (!is_null($timelines)) {
            $timelines->delete();
            $success = true;
            $message = "Task deleted successfully";
        } else {
            $success = true;
            $message = "Something went wrong";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
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
