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
use App\Mail\MissedMaintenanceMail;
use App\Mail\MissedServerMail;

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



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index($type = null)
    {
        $main_id =  config('helper.super_admin_id');
        $people = explode(",", $main_id);
        $user_type = 0;
        if (in_array(Auth::user()->id, $people)) {
            $user_type = 1;
            $super_users = User::where('role_id', 2)->get();

            if ($type == 'assisnged') {

                $assigned_ids = Assignpm::pluck('customer_id');

                $user_id = Aboutapp::get()->pluck('user_id');
                $users = User::whereIn('id', $user_id)->orWhere('user_type', 'custom')->where('parent_id', 0)->WhereIn('id', $assigned_ids)->orderBy('id', 'desc')->get();
            } elseif ($type == 'un-assisnged') {

                $assigned_ids = Assignpm::pluck('customer_id');

                $user_id = Aboutapp::get()->pluck('user_id');
                $users = User::whereIn('id', $user_id)->orWhere('user_type', 'custom')->where('parent_id', 0)->whereNotIn('id', $assigned_ids)->orderBy('id', 'desc')->get();
            } else {

                $user_id = Aboutapp::get()->pluck('user_id');
                $users = User::whereIn('id', $user_id)->orWhere('user_type', 'custom')->where('parent_id', 0)->orderBy('id', 'desc')->get();
            }

            return view('admin.super_admin.admin', compact('users', 'super_users', 'type', 'user_type'));
        } else {
            $super_users = User::where('role_id', 2)->get();
            $assigned_ids = Assignpm::pluck('customer_id');
            $user_id = Aboutapp::get()->pluck('user_id');
            $users = User::whereIn('id', $user_id)->orWhere('user_type', 'custom')->where('parent_id', 0)->whereNotIn('id', $assigned_ids)->orderBy('id', 'desc')->get();

            return view('admin.super_admin.admin', compact('users', 'super_users', 'type', 'user_type'));
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
        // $data = array();
        // $data['user_id'] = $request->user_id;
        // $data['payment_price'] = $request->payment_price;
        // $data['status'] = $request->status;
        // $payment = Payment::create($data);
        // session::flash('statuscode','info');
        // return back()->with('status','Price is Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showuser_app($id)
    {
        $user = User::where('id', $id)->first();
        if (is_null($user)) {
            return back()->with('error', 'No User Found');
        } else {
            session()->put(['user_id' => $user->id]);
            $aboutapps = Aboutapp::where('user_id', $id)->get();
            return view('admin.super_admin.user_apps', compact('aboutapps', 'user'));
        }
    }



    public function bug_preview($id)
    {
        $bug = Bug::where('id', $id)->first();
        $bug->img_arry = explode(",", $bug->bug_screenshot);
        return response()->json(['status' => True, 'bug_type' => $bug->bug_type, 'bug_device' => $bug->bug_device, 'bug_description' => $bug->bug_description, 'bug_screenshot' => $bug->bug_screenshot, 'img_arry' => $bug->img_arry, 'bug_id' => $bug->id]);
    }


    public function showuser_app_data($id, $app_id)
    {
        $main_id =  explode(',', config('helper.smartit_id'));
        $user = User::where('id', $id)->first();
        $aboutapps = Aboutapp::where('user_id', $id)->where('id', $app_id)->get();
        $all_udids = Buildudid::where('app_id',$app_id)->where('user_id',$id)->get();
        $domaindetail = Domaindetail::where('user_id', $id)->where('app_id', $app_id)->latest()->first();
        $designdetail = Designdetail::where('user_id', $id)->where('app_id', $app_id)->latest()->first();
        $buildudids = Buildudid::where('user_id', $id)->where('app_id', $app_id)->orderBy('id', 'desc')->get();
        $store_information = StoreInformation::where('user_id', $id)->where('app_id', $app_id)->latest()->first();
        $aboutappnotes = AboutappNote::where('user_id', $id)->where('app_id', $app_id)->get();
        $quote =  quote::where('user_id', $id)->where('app_id', $app_id)->first();
        $agreements =  Agreement::where('user_id', $id)->where('app_id', $app_id)->orderBy('id', 'desc')->first();
        $store = \App\Appstore::where('user_id', $id)->where('app_id', $app_id)->first();
        $test_build = \App\Testbuild::where('user_id', $id)->where('app_id', $app_id)->first();
        session()->put(['user_id' => $user->id, 'app_id' => $app_id]);
        $timelines = Timeline::where('user_id', $user->id)->where('app_id', $app_id)->get();
        $task_list =  Timeline::where('user_id', $user->id)->where('app_id', $app_id)->first();
        $getdataforpm = Assignpm::where('customer_id', $id)->first();
        $upload_details = \App\UploadDetail::where('app_id', $app_id)->first();
        $admin_upload_details = \App\UploadAdminDetail::where('app_id', $app_id)->first();

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
        $quotetier =  QuoteTier::where('app_id', $app_id)->get();
        return view('admin.super_admin.user_view', compact('aboutapps', 'domaindetail','all_udids','store_information', 'designdetail', 'task_list', 'upload_details', 'admin_upload_details', 'user', 'bugdetails', 'aboutappnotes', 'buildudids', 'quote', 'store', 'test_build', 'app_id', 'timelines', 'main_id', 'developers', 'assigned_developers', 'agreements', 'quotetier'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $aboutapps = Aboutapp::where('user_id', $id)->get();
        $domaindetail = Domaindetail::where('user_id', $id)->latest()->first();
        $designdetail = Designdetail::where('user_id', $id)->latest()->first();
        $buildudids = Buildudid::where('user_id', $id)->orderBy('id', 'desc')->get();
        $bugdetails = Bug::where('user_id', $id)->get();
        $aboutappnotes = AboutappNote::where('user_id', $id)->get();
        $quote =  quote::where('user_id', $id)->first();
        $agreements =  Agreement::where('user_id', $id)->where('app_id', $app_id)->first();
        $store = \App\Appstore::where('user_id', $id)->first();
        $pm_bugs = Bug::where('app_id', $app_id)->where('user_id', auth()->user()->id)->where('bugby', 'pm')->orderBy('id', 'desc')->get();
        return view('admin.super_admin.user_view', compact('aboutapps', 'domaindetail', 'designdetail', 'user', 'bugdetails', 'aboutappnotes', 'buildudids', 'quote', 'store', 'pm_bugs', 'agreements'));
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

    public function add_xd_link(Request $request)
    {
        $xd_links = \App\UserXdLink::where('user_id', $request->user_id)->where('app_id', $request->app_id)->get();
        if (count($xd_links) > 0) {
            foreach($xd_links as $data){
                $data->delete(); 
            }
            $add_xd_links = $request->add_note;
            foreach($add_xd_links as $xd_link){
                $designdetail = new \App\UserXdLink;
                $designdetail->user_id = $request->user_id;
                $designdetail->app_id = $request->app_id;
                $designdetail->xd_link = $xd_link;
                $designdetail->save();
            }
            session::flash('statuscode', 'info');
            return back()->with('status', 'Submitted');    
        }else{
            $xd_links = $request->add_note;
            foreach($xd_links as $xd_link){
                $designdetail = new \App\UserXdLink;
                $designdetail->user_id = $request->user_id;
                $designdetail->app_id = $request->app_id;
                $designdetail->xd_link = $xd_link;
                $designdetail->save();
            }
            session::flash('statuscode', 'info');
            return back()->with('status', 'Submitted');
        }
        
    }

    
    public function bugstatus(Request $request)
    {

        $staus_id =  $request->staus_id;
        $bug_id   =  $request->bug_id;
        $bug_note   =  $request->bug_note;
        $user_id  = $request->user_id;
        $bug = Bug::find($bug_id);
        $app_name = Aboutapp::where('id', $bug->app_id)->first();


        if (!is_null($bug_id)) {

            $bug->status = $staus_id;
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
            $save_notification->app_id = $bug->app_id;
            $save_notification->owner_id = Auth::id();
            $save_notification->notify_type = "bug";

            if ($staus_id == 1) {
                $save_notification->message =  $app_name->app_name . " bug in progress";
            } elseif ($staus_id == 2) {
                $save_notification->message =  $app_name->app_name . " bug in progress";
            } else {
                $save_notification->message =  $app_name->app_name . " bug is complete";
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
                            "title" => $save_notification->message,

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
                            "title" => $save_notification->message,

                        ],
                        "data" =>
                        [
                            "type" => 'notification',
                        ]
                    ];
                    App_PushNotification::send($message);
                endif;
            endif;
            $bugstatus['business_name'] = $user->business_name;
            $bugstatus['bug_type'] = $bug->bug_type;
            $bugstatus['bug_screenshot'] = $bug->bug_screenshot;
            $bugstatus['bug_note'] = $request->bug_note;
            $bugstatus['bug_description'] = $bug->bug_description;
            $bugstatus['bug_estimated_date'] = "";
            $bugstatus['require_store'] = "";
            $bugstatus['status'] = $staus_id;
            $bugstatus['multiple'] = 0;

            if ($staus_id == 3) {

                if($user->parent_id == 0){

                    $user_child = User::where('parent_id',$user->id)->get();

                    if (count($user_child) > 0) {
                        foreach ($user_child as $child) {
                            // Mail::to($child->email)->send(new BugStatus($bugstatus));
                        }
                    }

                    // Mail::to($user->email)->send(new BugStatus($bugstatus));
                }
               
            }
            return $staus_id;

            // if($bug->status == 0){
            //   $bugstatus['status'] = 'Pending';
            // }else if($bug->status == 1){
            //   $bugstatus['status'] = 'In Progress';
            // }else{
            //   $bugstatus['status'] = 'Completed';
            // }
            // if($bug->status == 2){
            //   $bugstatus['status'] = 'Done';
            // }else{
            //    $bugstatus['status'] = 'Complete';
            // }
            // if($bug->status != 2){
            //    Mail::to($user->email)->send(new BugStatus($bugstatus));
            // }
            // return $staus_id;
        }
    }
    public function pmmultiple_status_bug(Request $request)
    {
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
            if ($status == 3) {
                // Mail::to($user->email)->send(new BugStatus($dataList));
            }
            return "1";
        }
    }

    public function short_task_list(Request $request)
    {
        if ($request->status == '0') {
            $timelines = Timeline::where('user_id', $request->user_id)
                ->where('app_id', $request->myapp_id)
                ->orderBy('id', 'desc')->get();
        } else {
            $timelines = Timeline::where('user_id', $request->user_id)->where('status', $request->status)
                ->where('app_id', $request->myapp_id)
                ->orderBy('id', 'desc')->get();
        }
    }

    public function maintanence_mail(Request $request)
    {
        $app_id = $request->app_id;
        $user_id = $request->user_id;

        $dataList = array();
        $user = User::find($user_id);
        $dataList['business_name'] = $user->business_name;
        $dataList['country'] = $user->country;
        $user->email;
        Mail::to($user->email)->send(new MaintenanceMail($dataList));
    }

    public function missed_maintanence_mail(Request $request)
    {
        $app_id = $request->app_id;
        $user_id = $request->user_id;

        $dataList = array();
        $user = User::find($user_id);
        $dataList['business_name'] = $user->business_name;
        $dataList['country'] = $user->country;
        $user->email;
        Mail::to($user->email)->send(new MissedMaintenanceMail($dataList));
    }

    public function missed_server_mail(Request $request)
    {
        $app_id = $request->app_id;
        $user_id = $request->user_id;

        $dataList = array();
        $user = User::find($user_id);
        $dataList['business_name'] = $user->business_name;
        $dataList['country'] = $user->country;
        $user->email;
        Mail::to($user->email)->send(new MissedServerMail($dataList));
    }


    public function upload_details(Request $request)
    {

        $upload_details = \App\UploadDetail::where('app_id', $request->app_id)->first();

        if (!is_null($upload_details)) {
            $user = \App\UploadDetail::find($upload_details->id);
            $user->email = $request->email;
            $user->app_id = $request->app_id;
            $user->password = $request->password;
            $user->save();
            return "1";
        } else {
            $user = new \App\UploadDetail;
            $user->user_id = $request->user_id;
            $user->app_id = $request->app_id;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            return "1";
        }
    }


    public function UploadAdminDetail(Request $request)
    {

        $admin_upload_details = \App\UploadAdminDetail::where('app_id', $request->app_id)->first();

        if (!is_null($admin_upload_details)) {
            $user = \App\UploadAdminDetail::find($admin_upload_details->id);
            $user->email = $request->email;
            $user->app_id = $request->app_id;
            $user->password = $request->password;
            $user->url = $request->url;
            $user->save();
            return "1";
        } else {
            $user = new \App\UploadAdminDetail;
            $user->user_id = $request->user_id;
            $user->app_id = $request->app_id;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->url = $request->url;
            $user->save();
            return "1";
        }
    }



    public function project_manager(Request $request)
    {
        if ($request->isMethod('get')) :
            $all_project_manages = User::where('role_id', 2)->orderBy('id', 'desc')->get();
            return view('admin.super_admin.project_manage', compact('all_project_manages'));
        endif;
        if ($request->isMethod('post')) :
            $this->validate($request, [
                'number' => ['required', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
            $user = new User;
            $user->first_name = $request->manager_name;
            $user->role_id = $request->role_id;
            $user->business_name = "AppKit PM";
            $user->email = $request->email;
            $user->number = $request->number;
            $user->country = "United Kingdom";
            $user->password = Hash::make($request->password);
            $user->is_email_verified = 1;
            if ($user->save()) {
                session::flash('statuscode', 'info');
                return back()->with('status', 'Data is Added');
            } else {
                session::flash('statuscode', 'error');
                return back()->with('status', 'Something went wrong');
            }
        endif;
    }

    public function developers(Request $request)
    {
        if ($request->isMethod('get')) :
            $all_developers = User::where('role_id', 4)->orderBy('id', 'desc')->get();
            return view('admin.super_admin.developer', compact('all_developers'));
        endif;
        if ($request->isMethod('post')) :
            $this->validate($request, [
                'number' => ['required', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
            $user = new User;
            $user->first_name = $request->manager_name;
            $user->role_id = $request->role_id;
            $user->business_name = "AppKit Developer";
            $user->email = $request->email;
            $user->number = $request->number;
            $user->country = "India";
            $user->password = Hash::make($request->password);
            $user->is_email_verified = 1;
            if ($user->save()) {
                session::flash('statuscode', 'info');
                return back()->with('status', 'Data is Added');
            } else {
                session::flash('statuscode', 'error');
                return back()->with('status', 'Something went wrong');
            }
        endif;
    }

    public function custom_users(Request $request)
    {
        if ($request->isMethod('get')) :
            $all_developers = User::where('role_id', 1)->orderBy('id', 'desc')->get();
            return view('admin.super_admin.register_user', compact('all_developers'));
        endif;
        if ($request->isMethod('post')) :
            $this->validate($request, [
                'business_name' => ['required', 'unique:users'],
                'first_name' => ['required', 'unique:users'],
                'number' => ['required', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->role_id = $request->role_id;
            $user->user_type = $request->user_type;
            $user->business_name = $request->business_name;;
            $user->email = $request->email;
            $user->number = $request->number;
            $user->country = $request->country;
            $user->password = Hash::make($request->password);
            $user->is_email_verified = 1;
            if ($user->save()) {
                session::flash('statuscode', 'info');
                return back()->with('status', 'Data is Added');
            } else {
                session::flash('statuscode', 'error');
                return back()->with('status', 'Something went wrong');
            }
        endif;
    }

    public function edit_project_manager($id, $type)
    {
        $project_manager = User::where('id', $id)->first();
        if (is_null($project_manager)) {
            session::flash('statuscode', 'error');
            return back()->with('error', 'No User Found');
        } else {
            if ($type == 'PM') {
                $all_project_manages = User::where('role_id', 2)->orderBy('id', 'desc')->get();
                return view('admin.super_admin.edit_project_manage', compact('all_project_manages', 'project_manager'));
            } else {
                $all_developers = User::where('role_id', 4)->orderBy('id', 'desc')->get();
                return view('admin.super_admin.edit_developer', compact('all_developers', 'project_manager'));
            }
        }
    }

    public function edit_custom_users($id, $type)
    {
        $project_manager = User::where('id', $id)->first();
        if (is_null($project_manager)) {
            session::flash('statuscode', 'error');
            return back()->with('error', 'No User Found');
        } else {
            if ($type == 'PM') {
                $all_project_manages = User::where('role_id', 2)->orderBy('id', 'desc')->get();
                return view('admin.super_admin.edit_project_manage', compact('all_project_manages', 'project_manager'));
            } else {
                $all_developers = User::where('role_id', 1)->orderBy('id', 'desc')->get();
                return view('admin.super_admin.edit_custom_user', compact('all_developers', 'project_manager'));
            }
        }
    }

    public function update_project_manager(Request $request, $id, $type)
    {
        $project_manager = User::find($id);
        if (!is_null($project_manager)) {
            if ($type == 'PM') {
                $route = route('project_manager');
            } else {
                $route = route('developers');
            }
            $this->validate($request, [
                'number' => ['required', 'unique:users,number,' . $id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id]
            ]);
            $project_manager->first_name = $request->manager_name;
            $project_manager->email = $request->email;
            $project_manager->number = $request->number;
            if ($request->has('password')) {
                $project_manager->password = Hash::make($request->password);
            }
            if ($project_manager->update()) {
                session::flash('statuscode', 'info');
                return redirect($route)->with('status', 'Data is Updated');
            } else {
                session::flash('statuscode', 'error');
                return back()->with('status', 'Something went wrong');
            }
        } else {
            session::flash('statuscode', 'error');
            return back()->with('status', 'Something went wrong');
        }
    }

    public function update_custom_users(Request $request, $id, $type)
    {
        $project_manager = User::find($id);
        if (!is_null($project_manager)) {
            $this->validate($request, [
                'number' => ['required', 'unique:users,number,' . $id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id]
            ]);
            $project_manager->first_name = $request->first_name;
            $project_manager->last_name = $request->last_name;
            $project_manager->role_id = $request->role_id;
            $project_manager->user_type = $request->user_type;
            $project_manager->business_name = $request->business_name;;
            $project_manager->email = $request->email;
            $project_manager->number = $request->number;
            $project_manager->country = $request->country;
            if ($request->has('password')) {
                $project_manager->password = Hash::make($request->password);
            }
            if ($project_manager->update()) {
                session::flash('statuscode', 'info');
                return redirect('custom_users')->with('status', 'Data is Updated');
            } else {
                session::flash('statuscode', 'error');
                return back()->with('status', 'Something went wrong');
            }
        } else {
            session::flash('statuscode', 'error');
            return back()->with('status', 'Something went wrong');
        }
    }

    public function delete_project_manager($id, $type)
    {
        $project_manager = User::find($id);
        if ($type == 'PM') {
            $route = route('project_manager');
        } else {
            $route = route('developers');
        }
        if (!is_null($project_manager)) {
            $project_manager->delete();
            session::flash('statuscode', 'info');

            return redirect($route)->with('status', 'Deleted successfully');
        } else {
            session::flash('statuscode', 'error');
            return redirect($route)->with('status', 'Something went wrong');
        }
    }

    public function delete_custom_users($id, $type)
    {
        $project_manager = User::find($id);
        if ($type == 'PM') {
            $route = route('project_manager');
        } else {
            $route = route('custom_users');
        }
        if (!is_null($project_manager)) {
            $project_manager->delete();
            session::flash('statuscode', 'info');

            return redirect($route)->with('status', 'Deleted successfully');
        } else {
            session::flash('statuscode', 'error');
            return redirect($route)->with('status', 'Something went wrong');
        }
    }

    public function paymentstatus(Request $request)
    {
        $tier_id = $request->tier_id;
        $paid_status = $request->paid_status;
        $tier = QuoteTier::find($tier_id);
        if (!is_null($tier)) {
            $tier->status = $paid_status;
            $tier->update();
            return $paid_status;
        }
    }

    public function assignpm(Request $request)
    {
        $super_user_id =  $request->super_user_id;
        $customer_id =  $request->customer_id;

        $getdata = Assignpm::where('customer_id', $customer_id)->first();
        if (empty($getdata)) {
            $assignpm = Assignpm::Create(['project_manager_id' => $super_user_id, 'customer_id' => $customer_id]);
            return 1;
        } else {
            //return 0;
            $assignpm = Assignpm::where('customer_id', $customer_id)->first();
            if (!is_null($assignpm)) {
                $assignpm->project_manager_id = $super_user_id;
                $assignpm->update();
            }
            return 0;
        }
    }

    public function clientsstatus(Request $request)
    {
        $customer_id = $request->customer_id;
        $assignpm = Assignpm::where('customer_id', $customer_id)->first();
        if (!is_null($assignpm)) {
            $assignpm->is_confirmed = $request->checked;
            $assignpm->update();
        }
        return $request->checked;
    }
    public function timeline_tasksstatus(Request $request)
    {

        $staus_id = $request->staus_id;
        $taskid   = $request->taskid;
        $timeline = Timeline::find($taskid);
        $app_name = Aboutapp::where('id', $timeline->app_id)->first();
        if (!is_null($timeline)) {
            $timeline->status = $staus_id;
            $timeline->update();

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
            $save_notification->owner_id = Auth::id();
            $save_notification->notify_type = "task";
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

            $get_pm = Assignpm::where('customer_id', $request->userid)->first();
            if (!is_null($get_pm)) {
                $pm = User::find($get_pm->project_manager_id);

                if ($staus_id == 2) {

                    if($user->parent_id == 0){

                        $user_child = User::where('parent_id',$user->id)->get();
    
                        if (count($user_child) > 0) {
                            foreach ($user_child as $child) {
                                Mail::to($child->email)->send(new SendTaskprogressupdate($dataList));
                            }
                        }
    
                        Mail::to($user->email)->send(new SendTaskprogressupdate($dataList));
                    }
                   

                } else {
        
                    if($user->parent_id == 0){

                        $user_child = User::where('parent_id',$user->id)->get();
    
                        if (count($user_child) > 0) {
                            foreach ($user_child as $child) {
                                Mail::to($child->email)->send(new SendTaskupdate($dataList));
                            }
                        }
    
                        Mail::to($user->email)->send(new SendTaskupdate($dataList));
                    }
                }

            } else {
 
                if($user->parent_id == 0){

                    $user_child = User::where('parent_id',$user->id)->get();

                    if (count($user_child) > 0) {
                        foreach ($user_child as $child) {
                            Mail::to($child->email)->send(new SendTaskupdate($dataList));
                        }
                    }

                    Mail::to($user->email)->send(new Sendtaskupdate($dataList));
                }

            }
            return 0;
        }
    }
    public function verifyandroid(Request $request)
    {
        $app_id = $request->app_id;
        $app = \App\Testbuild::where('app_id', $app_id)->first();
        if (!is_null($app)) {
            $app->status_a = $request->checked;
            $app->update();
        }

        $user = User::find($request->user_id);
        $app = Aboutapp::find($request->app_id);

        // $bugstatus['business_name'] = $user->business_name;
        // $bugstatus['app_name'] = $app->app_name;
        // $bugstatus['iosbuild'] = $app->iosbuild;
        // $bugstatus['androidbuild'] = $app->androidbuild;

        // Mail::to($user->email)->send(new BuildMail($bugstatus));

        return $request->checked;
    }
    public function verifyios(Request $request)
    {
        $app_id = $request->app_id;
        $app = \App\Testbuild::where('app_id', $app_id)->first();
        if (!is_null($app)) {
            $app->status_i = $request->checked;
            $app->update();
        }

        // $user = User::find($request->user_id);
        // $app = Aboutapp::find($request->app_id);

        // $bugstatus['business_name'] = $user->business_name;
        // $bugstatus['app_name'] = $app->app_name;
        // $bugstatus['iosbuild'] = $app->iosbuild;
        // $bugstatus['androidbuild'] = $app->androidbuild;

        // Mail::to($user->email)->send(new BuildMail($bugstatus));

        return $request->checked;
    }
}
