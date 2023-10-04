<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Devloperapps;
use App\Aboutapp;
use Auth;
use Session;
use App\Bug;
use Illuminate\Support\Facades\Mail;
use App\Mail\BugStatus;
use App\Mail\BuildMail;
use App\Domaindetail;
use App\Designdetail;
use App\Buildudid;
use App\AboutappNote;
use App\quote;
use App\QuoteTier;
use App\Assignpm;
use App\Timeline;
use App\Mail\Sendtaskupdate;
use App\Mail\SendTaskprogressupdate;
use App\Mail\SendTask;
use App\app_notification;
use App\App_PushNotification;


class DevloperappsController extends Controller
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
    public function store(Request $request)
    {
        //
        //dd($request->all());
        foreach ($request->developer as $ky => $val) {
            $developer = new Devloperapps;
            $developer->developer_id = $val;
            $developer->app_id = $request->app_id;
            $developer->save();
        }
        session::flash('statuscode', 'info');
        return back()->with('status', 'Developer is Added');
    }

    public function bug_preview($id)
    {
        $bug = Bug::where('id', $id)->first();
        $bug->img_arry = explode(",", $bug->bug_screenshot);
        return response()->json(['status' => True, 'bug_type' => $bug->bug_type, 'bug_device' => $bug->bug_device, 'bug_description' => $bug->bug_description, 'bug_screenshot' => $bug->bug_screenshot, 'img_arry' => $bug->img_arry, 'bug_id' => $bug->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devloperapps  $devloperapps
     * @return \Illuminate\Http\Response
     */
    public function show(Devloperapps $devloperapps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devloperapps  $devloperapps
     * @return \Illuminate\Http\Response
     */
    public function edit(Devloperapps $devloperapps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devloperapps  $devloperapps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devloperapps $devloperapps)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Devloperapps  $devloperapps
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devloperapps $devloperapps)
    {
        //
    }
    public function delete($id)
    {
        $app_id = session('app_id');
        $developer_id = $id;
        $remove_developer = Devloperapps::where('developer_id', $developer_id)->where('app_id', $app_id)->delete();
        session::flash('statuscode', 'info');
        return back()->with('status', 'Developer Removed');
    }
    public function developer_tasks()
    {
        $developer_id = auth()->user()->id;
        $get_developer_apps = Devloperapps::where('developer_id', $developer_id)->pluck('app_id');
        $tasks = Timeline::whereIn('app_id', $get_developer_apps)->orderBy('created_at', 'DESC')->paginate(15);
        foreach ($tasks as $data) {
            $appdata = Aboutapp::where('id', $data->app_id)->first();
            if (!is_null($appdata)) {
                $data->app_name = $appdata->app_name;
            } else {
                $data->app_name = "";
            }
        }
        return view("admin.team.tasks", compact('tasks'));
    }
    public function buglist(Request $request)
    {
        $developer_id = auth()->user()->id;
        $get_dev_apps = Devloperapps::where('developer_id', $developer_id)->pluck('app_id');
        $get_developer_apps = Aboutapp::whereIn('id', $get_dev_apps)->get();
        $get_dev_apps_id = Aboutapp::whereIn('id', $get_dev_apps)->pluck('id');

        if (!$request->has('_token')) {
            $status = 10;
            $appid  = 0;
            $bugsdata = Bug::whereIn('app_id', $get_dev_apps_id)->orderBy('created_at', 'DESC')->paginate(15);
        } else {
            $status = $request->status;
            $appid  = $request->appid;

            if ($status == 10 && $appid == 0) {
                $bugsdata = Bug::whereIn('app_id', $get_dev_apps_id)->orderBy('created_at', 'DESC')->paginate(15);
            } elseif ($status != 10 && $appid == 0) {
                $bugsdata = Bug::where('status', $status)->whereIn('app_id', $get_dev_apps_id)->orderBy('created_at', 'DESC')->paginate(15);
            } elseif ($status == 10 && $appid != 0) {
                $bugsdata = Bug::where('app_id', $appid)->orderBy('created_at', 'DESC')->paginate(15);
            } else {
                $bugsdata = Bug::where('status', $status)->where('app_id', $appid)->orderBy('created_at', 'DESC')->paginate(15);
            }
        }

        return view("admin.team.buglist", compact('bugsdata', 'get_developer_apps', 'status', 'appid'));
    }
    public function getbug($id)
    {
        //$main_id =  explode(',',config('helper.smartit_id'));
        $bugsdata = Bug::where('id', $id)->first();
        $bugsdata->img_arry = explode(",", $bugsdata->bug_screenshot);

        return view("admin.team.singlebuglist", compact('bugsdata'));
    }

    public function bugstatus(Request $request)
    {


        $staus_id =  $request->staus_id;
        $require_store =  $request->require_store;
        $bug_id   =  $request->bug_id;
        $bug_note   =  $request->bug_note;
        $user_id  = $request->user_id;

        $bug = Bug::find($bug_id);

        $app_name = Aboutapp::where('id', $bug->app_id)->first();


        if (!is_null($bug_id)) {

            $bug->bug_estimated_date = $request->bug_date;
            $bug->status = $staus_id;
            if ($require_store == NULL) {
                $bug->require_store = "0";
            } else {
                $bug->require_store = $require_store;
            }
            $bug->update();

            $bugstatus = array();

            $user = User::find($user_id);


            $name = Auth::user()->first_name;
            $save_notification = new app_notification;

            $app = Designdetail::where('app_id', $bug->app_id)->first();
            if (!is_null($app)) {
                if (!is_null($app->logo)) {
                    $save_notification->app_logo = $app->logo;
                }
            }

            $save_notification->user_id = $user_id;
            $save_notification->app_id =  $bug->app_id;
            $save_notification->notify_type = "bug";
            $save_notification->owner_id = Auth::id();
            if ($staus_id == 0) {
                $save_notification->message =  $app_name->app_name . " bug is pending";
            } elseif ($staus_id == 1) {
                $save_notification->message =  $app_name->app_name . " bug in progress";
            } else {
                $save_notification->message =  $app_name->app_name . " bug in progress";
            }

            $save_notification->save();
            // if ($staus_id == 2) :

            //     $andriod_ids = \App\DeviceType::where('user_id', $save_notification->user_id)->where('device_type', 'A')->pluck('firebase_token')->toArray();

            //     if (count($andriod_ids) > 0) :

            //         $message = [
            //             "registration_ids" => $andriod_ids,
            //             "priority" => 'high',
            //             "sound" => 'default',
            //             "badge" => '1',
            //             "notification" =>
            //             [
            //                 "title" =>  $save_notification->message,

            //             ],
            //             "data" =>
            //             [
            //                 "type" => 'notification',
            //             ]
            //         ];
            //         App_PushNotification::send($message);

            //     endif;

            //     $ios_ids = \App\DeviceType::where('user_id', $save_notification->user_id)->where('device_type', 'I')
            //         ->pluck('firebase_token')->toArray();

            //     if (count($ios_ids) > 0) :

            //         $message = [
            //             "registration_ids" => $ios_ids,
            //             "priority" => 'high',
            //             "sound" => 'default',
            //             "badge" => '1',
            //             "notification" =>
            //             [
            //                 "title" =>  $save_notification->message,

            //             ],
            //             "data" =>
            //             [
            //                 "type" => 'notification',
            //             ]

            //         ];
            //         App_PushNotification::send($message);
            //     endif;
            // endif;

            $bugstatus['business_name'] = $user->business_name;
            $bugstatus['bug_type'] = $bug->bug_type;
            $bugstatus['bug_screenshot'] = $bug->bug_screenshot;
            $bugstatus['bug_note'] = $request->bug_note;
            $bugstatus['require_store'] = $require_store;
            $bugstatus['bug_estimated_date'] = $request->bug_date;
            $bugstatus['bug_description'] = $bug->bug_description;
            $bugstatus['status'] = $staus_id;
            $bugstatus['multiple'] = 0;

            $get_pm = Assignpm::where('customer_id', $request->user_id)->first();
            if (!is_null($get_pm)) {
                $pm = User::find($get_pm->project_manager_id);
                if ($staus_id == 1 || $staus_id == 2) {
                    Mail::to($pm->email)->send(new BugStatus($bugstatus));
                }
            }
            return $staus_id;

            if ($bug->status != 2) {
                // Mail::to($user->email)->send(new BugStatus($bugstatus));
            }
            return $staus_id;

            // Mail::to($user->email)->cc($user->email)->send(new BugStatus($bugstatus));
        }
    }
    public function developer_app()
    {
        $developer_id = auth()->user()->id;
        $get_developer_apps = Devloperapps::where('developer_id', $developer_id)->pluck('app_id');
        if (is_null($get_developer_apps)) {
            return back()->with('error', 'No App Found');
        } else {
            $aboutapps = Aboutapp::whereIn('id', $get_developer_apps)->get();
            return view('admin.team.developer_apps', compact('aboutapps'));
        }
    }
    public function developer_app_data($id, $app_id)
    {
        $developer_id =  explode(',', config('helper.d_smartit_id'));
        $user = User::where('id', $id)->first();
        $aboutapps = Aboutapp::where('user_id', $id)->where('id', $app_id)->get();
        $domaindetail = Domaindetail::where('user_id', $id)->where('app_id', $app_id)->latest()->first();
        $designdetail = Designdetail::where('user_id', $id)->where('app_id', $app_id)->latest()->first();
        $buildudids = Buildudid::where('user_id', $id)->where('app_id', $app_id)->orderBy('id', 'desc')->get();
        $aboutappnotes = AboutappNote::where('user_id', $id)->where('app_id', $app_id)->get();
        $store = \App\Appstore::where('user_id', $id)->where('app_id', $app_id)->first();
        $test_build = \App\Testbuild::where('user_id', $id)->where('app_id', $app_id)->first();
        session()->put(['user_id' => $user->id, 'app_id' => $app_id]);
        $timelines = Timeline::where('user_id', $user->id)->where('app_id', $app_id)->get();
        $getdataforpm = Assignpm::where('customer_id', $id)->first();
        $uploadDetail = \App\UploadDetail::where('app_id', $app_id)->first();
        $adminDetail = \App\UploadAdminDetail::where('app_id', $app_id)->first();


        if (!empty($getdataforpm)) {
            $bugdetails = Bug::where('app_id', $app_id)->where('user_id', $getdataforpm->project_manager_id)->orWhere('user_id', $id)->orderBy('id', 'desc')->get();
            foreach ($bugdetails as $bug) {
                $bug->img_arry = explode(",", $bug->bug_screenshot);
            }
        } else {
            $bugdetails = Bug::where('user_id', $id)->where('app_id', $app_id)->orderBy('id', 'desc')->get();
            foreach ($bugdetails as $bug) {
                $bug->img_arry = explode(",", $bug->bug_screenshot);
            }
        }

        $exist_developers = Devloperapps::where('app_id', $app_id)->pluck('developer_id');
        $developers = User::where('role_id', 4)->whereNotIn('id', $exist_developers)->get();
        $assigned_developers = User::where('role_id', 4)->whereIn('id', $exist_developers)->get();
        return view('admin.team.developer_view', compact('aboutapps', 'domaindetail', 'designdetail', 'user', 'bugdetails', 'aboutappnotes', 'buildudids', 'store', 'test_build', 'app_id', 'timelines', 'developer_id', 'developers', 'assigned_developers', 'adminDetail', 'uploadDetail'));
    }
    public function uploadbuild_developer(Request $request)
    {
        $newUser = \App\Testbuild::updateOrCreate(['user_id' => $request['user_id']], [
            'app_id' => $request['app_id'],
            'androidbuild' => $request['androidbuild'],
            'iosbuild' => $request['iosbuild'],
            'status_a' => '0',
            'status_i' => '0'
        ]);
        if ($newUser) {

            $get_pm = Assignpm::where('customer_id', $request->user_id)->first();

            if (!is_null($get_pm)) {

                $user = User::find($get_pm->project_manager_id);
                $app = Aboutapp::find($request->app_id);

                $bugstatus['business_name'] = $user->business_name;
                $bugstatus['app_name'] = $app->app_name;

                if (!is_null($request->androidbuild)) {
                    $bugstatus['androidbuild'] = $request->androidbuild;
                }
                if (!is_null($request->iosbuild)) {
                    $bugstatus['iosbuild'] = $request->iosbuild;
                }

                Mail::to($user->email)->send(new BuildMail($bugstatus));
            }

            session::flash('statuscode', 'info');
            session::flash('goto_tab', 'Builds');
            return back()->with('status', 'Data is Added');
        } else {
            session::flash('statuscode', 'error');
            session::flash('goto_tab', 'Builds');
            return back()->with('status', 'Something went wrong');
        }
    }

    public function developer_timeline_tasksstatus(Request $request)
    {

        $staus_id = $request->staus_id;
        $taskid   = $request->taskid;
        $timeline = Timeline::find($taskid);
        $app_name = Aboutapp::where('id', $timeline->app_id)->first();
        if (!is_null($timeline)) {
            $timeline->status = $staus_id;
            $timeline->update();

            $name = Auth::user()->first_name;
            $save_notification = new app_notification;

            $app = Designdetail::where('app_id', $timeline->app_id)->first();
            if (!is_null($app)) {
                if (!is_null($app->logo)) {
                    $save_notification->app_logo = $app->logo;
                }
            }

            $save_notification->user_id = $request->userid;
            $save_notification->app_id = $timeline->app_id;
            $save_notification->notify_type = "task";
            $save_notification->owner_id = Auth::id();
            if ($staus_id == 1) {
                $save_notification->message =  $app_name->app_name . " task in progress";
            } elseif ($staus_id == 2) {
                $save_notification->message =  $app_name->app_name . " task is pending";
            } else {
                $save_notification->message =  $app_name->app_name . " task complete";
            }

            $save_notification->save();
            if ($staus_id == 3) :
                $andriod_ids = \App\DeviceType::where('user_id', $save_notification->user_id)->where('device_type', 'A')->pluck('firebase_token')->toArray();

                if (count($andriod_ids) > 0) :

                    $message = [
                        "registration_ids" => $andriod_ids,
                        "priority" => 'high',
                        "sound" => 'default',
                        "badge" => '1',
                        "notification" =>
                        [
                            "title" =>  $save_notification->message,

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
                            "title" =>  $save_notification->message,

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


        $user = User::find($request->userid);
        $dataList['business_name'] = $user->business_name;
        $dataList['task_description'] = $timeline->task_description;
        if ($staus_id == 1) {
            $dataList['status'] = 'Pending';
        } elseif ($staus_id == 2) {
            $dataList['status'] = 'In progress';
        } else {
            $dataList['status'] = 'Completed';
        }
        $get_pm = Assignpm::where('customer_id', $request->userid)->first();
        if (!is_null($get_pm)) {
            $pm = User::find($get_pm->project_manager_id);
            if ($staus_id == 2) {
                Mail::to($user->email)->send(new SendTaskprogressupdate($dataList));
            } else {
                Mail::to($user->email)->send(new SendTaskupdate($dataList));
            }
        } else {
            Mail::to($user->email)->send(new Sendtaskupdate($dataList));
        }
        return 0;
    }

    public function developer_timeline_add(Request $request)
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
        session::flash('statuscode', 'info');
        return back()->with('status', 'Data is Added');
    }
    public function gettask($id)
    {
        //$main_id =  explode(',',config('helper.smartit_id'));
        $taskdata = Timeline::where('id', $id)->first();
        return view("admin.team.singletask", compact('taskdata'));
    }

    public function multiple_status_bug(Request $request)
    {
        //return $request->all();
        $app_id = $request->myapp_id;
        $user_id = $request->user_id;
        $status = $request->status;
        $bug_ids = $request->val;
        $bugdata = Bug::whereIn('id', $bug_ids)->update([
            'status' => $status,
        ]);
        if ($bugdata) {
            $dataList = array();
            $user = User::find($user_id);
            $dataList['multiple'] = 1;
            $dataList['business_name'] = $user->business_name;
            $dataList['bug_data'] = Bug::whereIn('id', $bug_ids)->get();
            $get_pm = Assignpm::where('customer_id', $request->user_id)->first();
            if (!is_null($get_pm)) {
                $pm = User::find($get_pm->project_manager_id);
                Mail::to($pm->email)->send(new BugStatus($dataList));
            }
            return "1";
        }
    }
}
