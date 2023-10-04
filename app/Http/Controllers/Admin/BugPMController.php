<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\User;
use App\Bug;
use App\app_notification;
use App\Aboutapp;
use App\App_PushNotification;
use Auth;

class BugPMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_id = session('app_id');
        $pm_bugs = Bug::where('app_id', $app_id)->where('user_id', auth()->user()->id)->where('bugby', 'pm')->orderBy('id', 'desc')->get();
        return view("admin.super_admin.admin", compact('pm_bugs'));
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
        // dd($request->all());

        $id = session('user_id');
        $app_id = session('app_id');

        $bug_type = $request->bug_type;

        if (count($request->bug_description) > 0) {
            for ($i = 0; $i < count($request->bug_description); $i++) {
                $bug = new Bug;
                $bug->bug_description = $request->bug_description[$i];
                $bug->app_id = $app_id;
                $bug->bug_type = $bug_type[$i];
                $bug->user_id = $id;
                $bug->bugby = $request->bugby;
                $bug->bug_device = $request->bug_device[$i];
                $bug->bugforclient = $request->bugforclient[$i];
                if (!is_null($request->bug_screenshot)) {
                    if (count($request->bug_screenshot) > 0) {
                        if (array_key_exists($i, $request->bug_screenshot)) {
                            $bugs_arry = [];
                            for ($j = 0; $j < count($request->bug_screenshot[$i]); $j++) {
                                $imageName = date_format(date_create(), 'YmdHis') . '-' . $request->bug_screenshot[$i][$j]->getClientOriginalName();
                                $upload_path = 'media/';
                                $request->bug_screenshot[$i][$j]->move($upload_path, $imageName);
                                $bugs_arry[] = $upload_path . $imageName;
                            }
                            $bug->bug_screenshot = implode(",", $bugs_arry);
                        }
                        $bug->bug_screenshot = implode(",", $bugs_arry);
                    }
                }

                $bug->save();
            }
        }

        foreach ($request->bugforclient as $ky => $val) {
            if ($val == 1) :
                $about_app = Aboutapp::where('id', $app_id)->first();
                $logo = Auth::user()->avatar;
                $name = Auth::user()->first_name;
                $save_notification = new app_notification;
                $save_notification->user_id = $id;
                $save_notification->app_logo = $logo;
                $save_notification->app_id = $app_id;
                $save_notification->notify_type = "bug";
                $save_notification->owner_id = Auth::id();
                $save_notification->message = $name . " has added a new Bug in " . $about_app->app_name;
                $save_notification->save();

                $andriod_ids = \App\DeviceType::where('user_id', $id)->where('device_type', 'A')->pluck('firebase_token')->toArray();

                if (count($andriod_ids) > 0) :

                    $message = [
                        "registration_ids" => $andriod_ids,
                        "priority" => 'high',
                        "sound" => 'default',
                        "badge" => '1',
                        "notification" =>
                        [
                            "title" => $name . " has added a new Bug in " . $about_app->app_name,

                        ],
                        "data" =>
                        [
                            "type" => 'notification',
                        ]
                    ];
                    App_PushNotification::send($message);

                endif;

                $ios_ids = \App\DeviceType::where('user_id', $id)->where('device_type', 'I')
                    ->pluck('firebase_token')->toArray();

                if (count($ios_ids) > 0) :

                    $message = [
                        "registration_ids" => $ios_ids,
                        "priority" => 'high',
                        "sound" => 'default',
                        "badge" => '1',
                        "notification" =>
                        [
                            "title" => $name . " has added a new Bug in " . $about_app->app_name,

                        ],
                        "data" =>
                        [
                            "type" => 'notification',
                        ]
                    ];
                    App_PushNotification::send($message);
                endif;
            endif;

            session::flash('statuscode', 'info');
            return back()->with('status', 'Data is Added');
        }
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
        $pm_bugs = Bug::where('user_id', $id)->where('app_id', $app_id)->get();

        return view('admin.super_admin.admin', compact('pm_bugs', 'user', 'app_id'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $pm_bugs = Bug::where('user_id', $id)->get();

        return view('admin.super_admin.admin', compact('pm_bugs', 'user'));
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
