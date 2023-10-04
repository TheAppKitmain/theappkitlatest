<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bug;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BugMail;
use App\Assignpm;
use Carbon\Carbon;
use Auth;
use App\User;
use App\Aboutapp;
use Session;

class BugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_id = session('app_id');
        if ($app_id == 0) {
            return redirect()->route('app.aboutapp.index')->with('status', 'Please Add App first');
        } else {
            
            if (Auth::user()->parent_id == 0) {
                    $id = Auth::user()->id;
                    $bugs = Bug::where('app_id', $app_id)->where('user_id', $id)->where('bugforclient', 1)->orderBy('created_at', 'desc')->get();
                    foreach ($bugs as $bug) {
                        $bug->img_arry = explode(",", $bug->bug_screenshot);
                    }
                }else{

                    $id = Auth::user()->parent_id;
                    $bugs = Bug::where('app_id', $app_id)->where('user_id', $id)->where('bugforclient', 1)->orderBy('created_at', 'desc')->get();
                    foreach ($bugs as $bug) {
                        $bug->img_arry = explode(",", $bug->bug_screenshot);
                    }

                }

            return view("admin.custom.bug", compact('bugs'));
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
        $app_id = session('app_id');
        $id = [];
        if ($app_id == 0) {
            return redirect()->route('app.aboutapp.index')->with('status', 'Please Add App first');
        } else {
            $bug_type = $request->bug_type;
            $bug_device = $request->bug_device;
            $bug_descriptions = $request->bug_description;
            $user_id = $request->user_id;
            $bugby = $request->bugby;
            if (count($request->bug_description) > 0) {
                for ($i = 0; $i < count($request->bug_description); $i++) {
                    $bug = new Bug;
                    $bug->bug_description = $request->bug_description[$i];
                    $bug->app_id = $app_id;
                    $bug->bug_type = $bug_type[$i];
                    $bug->user_id = $user_id;
                    $bug->bugby = $request->bugby;
                    $bug->bug_priority = $request->bug_priority[$i];
                    $bug->bug_device = $request->bug_device[$i];
                    $bug->bugforclient = 1;
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
                        }
                    }

                    $bug->save();


                    if (Auth::user()->parent_id == 0) {
                        $id = Auth::user()->id;
                        $projectManager = Assignpm::where('customer_id', $id)->first();
                    } else {
                        $id =  Auth::user()->parent_id;
                        $projectManager = Assignpm::where('customer_id', $id)->first();
                    }

                    if (!is_null($projectManager)) {
                        $projectM = $projectManager->project_manager_id;
                    }
                    $about_app = Aboutapp::where('id', $app_id)->first();
                    $logo = Auth::user()->avatar;
                    $name = Auth::user()->first_name;
                    $save_notification = new \App\app_notification;
                    $save_notification->user_id =  $projectM;
                    $save_notification->app_logo = $logo;
                    $save_notification->app_id = $app_id;
                    $save_notification->notify_type = "bug";
                    $save_notification->owner_id = Auth::id();
                    $save_notification->message = $name . " has added a new Bug in " . $about_app->app_name;
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
                                "title" => $name . " has added a new Bug in " . $about_app->app_name,

                            ],
                            "data" =>
                            [
                                "type" => 'notification',
                            ]
                        ];
                        \App\App_PushNotification::send($message);

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
                                "title" => $name . " has added a new Bug in " . $about_app->app_name,

                            ],
                            "data" =>
                            [
                                "type" => 'notification',
                            ]
                        ];
                        \App\App_PushNotification::send($message);
                    endif;
                    $id  = array();
                    $id[] = $bug->id;
                }
            }



            $dataList = array();
            $user = User::find($user_id);
            $dataList['business_name'] = $user->business_name;
            $dataList['bug_id'] = $id;
            $get_pm = Assignpm::where('customer_id', $request->user_id)->first();
            if (!is_null($get_pm)) {
                $pm = User::find($get_pm->project_manager_id);
                Mail::to($pm->email)->send(new BugMail($dataList));
            } else {
                session::flash('statuscode', 'info');
                return redirect('app/bug')->with('status', 'project manager is not assigned yet');
            }
            session::flash('statuscode', 'info');
            return redirect('app/bug')->with('status', 'Bug Submitted');
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

    public function custom_delete($id)
    {
        $bug = Bug::find($id);
        if (!is_null($bug)) {
            $bug->delete();
            $success = true;
            $message = "Bug deleted successfully";
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
    }

    public function buglist(Request $request)
    {
        $super_id = auth()->user()->id;
        $main_id =  explode(',', config('helper.super_admin_id'));
        if (in_array(Auth::user()->id, $main_id)) {
            $get_pm_apps = Aboutapp::get();
        } else {
            $get_pm_customer = Assignpm::where('project_manager_id', $super_id)->pluck('customer_id');
            $get_pm_apps = Aboutapp::whereIn('user_id', $get_pm_customer)->get();
            $get_pm_apps_id = Aboutapp::whereIn('user_id', $get_pm_customer)->pluck('id');
        }
        if (!$request->has('_token')) {
            $status = 10;
            $appid = 0;
            if (in_array(Auth::user()->id, $main_id)) {
                $bugsdata = Bug::orderBy('created_at', 'DESC')->get();
            } else {
                $bugsdata = Bug::whereIn('app_id', $get_pm_apps_id)->orderBy('created_at', 'DESC')->get();
            }
        } else {
            if ($request->bulk_option == "delete") {
                if ($request->has('bug') && count($request->bug) > 0) {
                    $delete_bugs = Bug::whereIn('id', $request->bug)->delete();
                    return redirect(route('buglist'))->with('status', 'Deleted successfully');
                }
            }

            $status = $request->status;
            $appid = $request->appid;
            if ($status == 10 && $appid == 0) {
                if (in_array(Auth::user()->id, $main_id)) {
                    $bugsdata = Bug::orderBy('created_at', 'DESC')->get();
                } else {
                    $bugsdata = Bug::whereIn('app_id', $get_pm_apps_id)->orderBy('created_at', 'DESC')->get();
                }
            } elseif ($status != 10 && $appid == 0) {
                if (in_array(Auth::user()->id, $main_id)) {
                    $bugsdata = Bug::where('status', $status)->orderBy('created_at', 'DESC')->get();
                } else {
                    $bugsdata = Bug::where('status', $status)->whereIn('app_id', $get_pm_apps_id)->orderBy('created_at', 'DESC')->get();
                }
            } elseif ($status == 10 && $appid != 0) {
                if (in_array(Auth::user()->id, $main_id)) {
                    $bugsdata = Bug::where('app_id', $appid)->orderBy('created_at', 'DESC')->get();
                } else {
                    $bugsdata = Bug::where('app_id', $appid)->orderBy('created_at', 'DESC')->get();
                }
            } else {
                if (in_array(Auth::user()->id, $main_id)) {
                    $bugsdata = Bug::where('status', $status)->where('app_id', $appid)->orderBy('created_at', 'DESC')->get();
                } else {
                    $bugsdata = Bug::where('status', $status)->where('app_id', $appid)->orderBy('created_at', 'DESC')->get();
                }
            }
            foreach ($bugsdata as $bug) {
                $bug->img_arry = explode(",", $bug->bug_screenshot);
            }
        }

        return view("admin.custom.buglist", compact('bugsdata', 'status', 'appid', 'get_pm_apps'));
    }



    public function buglist_bckup(Request $request)
    {
        //dd($request->all());
        $super_id = auth()->user()->id;
        $main_id =  explode(',', config('helper.super_admin_id'));
        if (in_array(Auth::user()->id, $main_id)) {
            $get_pm_apps = Aboutapp::get();
        } else {
            $get_pm_customer = Assignpm::where('project_manager_id', $super_id)->pluck('customer_id');
            $get_pm_apps = Aboutapp::whereIn('user_id', $get_pm_customer)->get();
            $get_pm_apps_id = Aboutapp::whereIn('user_id', $get_pm_customer)->pluck('id');
        }

        if (!$request->has('_token')) {
            $status = 10;
            $appid = 0;

            if (in_array(Auth::user()->id, $main_id)) {
                /* Bugs for Superadmin*/
                $bugsdata = Bug::orderBy('created_at', 'DESC')->paginate(15);
            } else {
                /* Bugs for Project managers*/

                $bugsdata = Bug::whereIn('app_id', $get_pm_apps_id)->orderBy('created_at', 'DESC')->paginate(15);
            }
        } else {
            $status = $request->status;
            $appid = $request->appid;
            if ($status == 10 && $appid == 0) {

                if (in_array(Auth::user()->id, $main_id)) {
                    /* Bugs for Superadmin*/
                    $bugsdata = Bug::orderBy('created_at', 'DESC')->paginate(15);
                } else {
                    /* Bugs for Project managers*/
                    $bugsdata = Bug::whereIn('app_id', $get_pm_apps_id)->orderBy('created_at', 'DESC')->paginate(15);
                }
            } elseif ($status != 10 && $appid == 0) {

                if (in_array(Auth::user()->id, $main_id)) {
                    /* Bugs for Superadmin*/
                    $bugsdata = Bug::where('status', $status)->orderBy('created_at', 'DESC')->paginate(15);
                } else {

                    /* Bugs for Project managers*/
                    $bugsdata = Bug::where('status', $status)->whereIn('app_id', $get_pm_apps_id)->orderBy('created_at', 'DESC')->paginate(15);
                }
            } elseif ($status == 10 && $appid != 0) {
                if (in_array(Auth::user()->id, $main_id)) {
                    /* Bugs for Superadmin*/
                    $bugsdata = Bug::where('app_id', $appid)->orderBy('created_at', 'DESC')->paginate(15);
                } else {

                    /* Bugs for Project managers*/
                    $bugsdata = Bug::where('app_id', $appid)->orderBy('created_at', 'DESC')->paginate(15);
                }
            } else {
                if (in_array(Auth::user()->id, $main_id)) {
                    /* Bugs for Superadmin*/
                    $bugsdata = Bug::where('status', $status)->where('app_id', $appid)->orderBy('created_at', 'DESC')->paginate(15);
                } else {
                    /* Bugs for Project managers*/
                    $bugsdata = Bug::where('status', $status)->where('app_id', $appid)->orderBy('created_at', 'DESC')->paginate(15);
                }
            }
            foreach ($bugsdata as $bug) {
                $bug->img_arry = explode(",", $bug->bug_screenshot);
            }
        }

        return view("admin.custom.buglist", compact('bugsdata', 'status', 'appid', 'get_pm_apps'));
    }

    // public function buglist($type = null)
    // {
    //     // $bugs = Bug::select(DB::raw('user_id,business_name,count(*) as count'))
    //     //              ->join('users', 'users.id', '=', 'bugs.user_id')
    //     //              ->where('role_id',1)
    //     //              ->groupBy('user_id')
    //     //              ->get();
    //     // return view("admin.custom.buglist",compact('bugs'));
    //     $super_id = auth()->user()->id;
    //     $main_id =  explode(',', config('helper.super_admin_id'));
    //     if ($type == null) {
    //         if (in_array(Auth::user()->id, $main_id)) {
    //             $bugsdata = Bug::orderBy('created_at', 'DESC')->paginate(15);
    //             foreach ($bugsdata as $bug) {
    //                 $bug->img_arry = explode(",", $bug->bug_screenshot);
    //             }
    //         } else {
    //             $get_pm_customer = Assignpm::where('project_manager_id', $super_id)->pluck('customer_id');
    //             $get_pm_apps = Aboutapp::whereIn('user_id', $get_pm_customer)->pluck('id');
    //             $bugsdata = Bug::whereIn('app_id', $get_pm_apps)->orderBy('created_at', 'DESC')->paginate(15);
    //             foreach ($bugsdata as $bug) {
    //                 $bug->img_arry = explode(",", $bug->bug_screenshot);
    //             }
    //         }
    //     } else {
    //         if (in_array(Auth::user()->id, $main_id)) {
    //             //dd($type);
    //             if ($type == 'pending') {
    //                 $bugsdata = Bug::where('status', 0)->orderBy('created_at', 'DESC')->paginate(15);
    //                 foreach ($bugsdata as $bug) {
    //                     $bug->img_arry = explode(",", $bug->bug_screenshot);
    //                 }
    //             } elseif ($type == 'in-progress') {
    //                 $bugsdata = Bug::where('status', 1)->orderBy('created_at', 'DESC')->paginate(15);
    //                 foreach ($bugsdata as $bug) {
    //                     $bug->img_arry = explode(",", $bug->bug_screenshot);
    //                 }
    //             } elseif ($type == 'done') {
    //                 $bugsdata = Bug::where('status', 2)->orderBy('created_at', 'DESC')->paginate(15);
    //                 foreach ($bugsdata as $bug) {
    //                     $bug->img_arry = explode(",", $bug->bug_screenshot);
    //                 }
    //             } else {
    //                 $bugsdata = Bug::where('status', 3)->orderBy('created_at', 'DESC')->paginate(15);
    //                 foreach ($bugsdata as $bug) {
    //                     $bug->img_arry = explode(",", $bug->bug_screenshot);
    //                 }
    //             }
    //         } else {
    //             $get_pm_customer = Assignpm::where('project_manager_id', $super_id)->pluck('customer_id');
    //             $get_pm_apps = Aboutapp::whereIn('user_id', $get_pm_customer)->pluck('id');
    //             if ($type == 'pending') {
    //                 $bugsdata = Bug::where('status', 0)->whereIn('app_id', $get_pm_apps)->orderBy('created_at', 'DESC')->paginate(15);
    //                 foreach ($bugsdata as $bug) {
    //                     $bug->img_arry = explode(",", $bug->bug_screenshot);
    //                 }
    //             } elseif ($type == 'in-progress') {
    //                 $bugsdata = Bug::where('status', 1)->whereIn('app_id', $get_pm_apps)->orderBy('created_at', 'DESC')->paginate(15);
    //                 foreach ($bugsdata as $bug) {
    //                     $bug->img_arry = explode(",", $bug->bug_screenshot);
    //                 }
    //             } elseif ($type == 'done') {
    //                 $bugsdata = Bug::where('status', 2)->whereIn('app_id', $get_pm_apps)->orderBy('created_at', 'DESC')->paginate(15);
    //                 foreach ($bugsdata as $bug) {
    //                     $bug->img_arry = explode(",", $bug->bug_screenshot);
    //                 }
    //             } else {
    //                 $bugsdata = Bug::where('status', 3)->whereIn('app_id', $get_pm_apps)->orderBy('created_at', 'DESC')->paginate(15);
    //                 foreach ($bugsdata as $bug) {
    //                     $bug->img_arry = explode(",", $bug->bug_screenshot);
    //                 }
    //             }
    //         }
    //     }

    //     // $bugsdata = Bug::orderBy('created_at', 'DESC')->paginate(15);
    //     // foreach ($bugsdata as $bug) {
    //     //     $bug->img_arry = explode(",", $bug->bug_screenshot);
    //     // }
    //     return view("admin.custom.buglist", compact('bugsdata', 'type'));
    // }


    public function getbug($id)
    {
        $bugsdata = Bug::where('id', $id)->first();
        $bugsdata->img_arry = explode(",", $bugsdata->bug_screenshot);
        return view("admin.custom.singlebuglist", compact('bugsdata'));
    }

    // public function buglistpm(){
    //     $bugs = Bug::select(DB::raw('user_id,business_name,count(*) as count'))
    //                  ->join('users', 'users.id', '=', 'bugs.user_id')
    //                  ->where('role_id',2)
    //                  ->groupBy('user_id')
    //                  ->get();
    //     return view("admin.custom.buglist",compact('bugs'));
    // }


}
