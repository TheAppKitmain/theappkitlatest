<?php

namespace App\Http\Controllers\API\App_kit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Bug;
use Illuminate\Support\Facades\Mail;
use App\Mail\BugMail;
use Illuminate\Support\Facades\Storage;
use App\Assignpm;
use App\Aboutapp;
use App\User;
use App\Mail\BugStatus;
use App\app_notification;
use App\App_PushNotification;

class BugController extends Controller
{
    public function index(Request $request)
    {
        $about_app = Aboutapp::find($request->app_id);
        if ($request->role_id == 2) {
            $bugs = Bug::with('about_app')->where('app_id', $request->app_id)->orderBy('created_at', 'desc')->get();
        } else {
            $bugs = Bug::with('about_app')->where('app_id', $request->app_id)->where('bugforclient', 1)->orderBy('created_at', 'desc')->get();
        }
        return response()->json(['status' => true, 'payload' => $bugs, 'about_app' => $about_app->app_name]);
    }

    public function show(Request $request)
    {
        $id = $request->bug_id;
        $bug_details = Bug::where('id', $id)->first();
        return response()->json(['status' => true, 'payload' => $bug_details]);
    }

    public function store(Request $request)
    {
        $id = [];
        session()->put('app_id', $request->app_id);
        if ($request->app_id == 0) {
            return response()->json(['status' => false, "message" => "Please Add App first"]);
        } else {
            $app_id = $request->app_id;
            $bug_type = $request->bug_type;
            $bug_device =  $request->bug_device;
            $bug_descriptions = $request->bug_description;
            $user_id = $request->user_id;
            $bugby = $request->bugby;
            if (count($request->bug_description) > 0) {
                foreach ($request->bug_description as $ky => $val) {
                    $bug = new Bug;
                    $bug->bug_description = $val;
                    $bug->app_id = $app_id;
                    $bug->bug_type = $bug_type[$ky];
                    $bug->bug_device = $bug_device[$ky];
                    $bug->user_id = $user_id;

                    if (!is_null($request->bugforclient)) {
                        $bug->bugforclient = $request->bugforclient;
                    } else {
                        $bug->bugforclient = 1;
                    }

                    if ($request->bugby == "") {
                        $bug->bugby = "client";
                    } else {
                        $bug->bugby = $request->bugby;
                    }
                    if (!empty($request->bug_screenshot[$ky])) {

                        $bug_screenshots = $request->file('bug_screenshot');

                        foreach ($bug_screenshots as $key => $value) {
                            if ($ky == $key) {
                                $name = time() . '.' . $value->getClientOriginalExtension();
                                $image_full_name = 'img_' . $name;
                                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                                Storage::disk('s3')->put($filePath, file_get_contents($value));
                                $url = config('services.base_url') . "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/" . $image_full_name;
                                $bug->bug_screenshot = $url;
                            }
                        }
                    }

                    $bug->save();

                    $about_app = Aboutapp::where('id', $app_id)->first();

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

                    $name = Auth::user()->first_name;
                    $logo = Auth::user()->avatar;

                    $rollId = Auth::user()->role_id;

                    if ($bug->bugforclient == 1) :
                        if ($rollId == 2) {
                            $save_notification = new \App\app_notification;
                            $save_notification->user_id = $about_app->user_id;
                            $save_notification->app_id = $app_id;
                            $save_notification->app_logo = $logo;
                            $save_notification->owner_id = Auth::id();
                            $save_notification->notify_type = "bug";
                            $save_notification->message = $name . " has added a new Bug in " . $about_app->app_name;
                            $save_notification->save();
                        } else {
                            $save_notification = new \App\app_notification;
                            $save_notification->user_id = $projectM;
                            $save_notification->app_id = $app_id;
                            $save_notification->app_logo = $logo;
                            $save_notification->owner_id = Auth::id();
                            $save_notification->notify_type = "bug";
                            $save_notification->message = $name . " has added a new Bug in " . $about_app->app_name;
                            $save_notification->save();
                        }

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
                    endif;
                    $id  = array();
                    $id[] = $bug->id;
                }
            }

            $dataList = array();
            $user = User::find($user_id);
            if ($user->role_id = "2") {

                return response()->json(['status' => true, "message" => "Bug Submitted"]);
            } else {
                $dataList['business_name'] = $user->business_name;
                $dataList['bug_id'] = $id;
                $get_pm = Assignpm::where('customer_id', $request->user_id)->first();
                if (!is_null($get_pm)) {
                    $pm = User::find($get_pm->project_manager_id);
                    Mail::to($pm->email)->send(new BugMail($dataList));
                } else {
                    return response()->json(['status' => false, "message" => "project manager is not assigned yet"]);
                }
                return response()->json(['status' => true, "message" => "Bug Submitted"]);
            }
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

            $user = User::find($user_id);
            $name = Auth::user()->first_name;

            $projectManager = Assignpm::where('customer_id', Auth::user()->id)->first();
            if (!is_null($projectManager)) {
                $projectM = $projectManager->project_manager_id;
            }

            $rollId = Auth::user()->role_id;
            if ($rollId == 2) {
                $save_notification = new app_notification;
                $app = \App\Designdetail::where('app_id', $bug->app_id)->first();
                if (!is_null($app)) {
                    if (!is_null($app->logo)) {
                        $save_notification->app_logo = $app->logo;
                    }
                }
                $save_notification->user_id = $app_name->user_id;
                $save_notification->app_id = $bug->app_id;
                $save_notification->owner_id = Auth::id();
                $save_notification->notify_type = "bug";

                if ($staus_id == 1) {
                    $save_notification->message =  $app_name->app_name . " bug in progress";
                } elseif ($staus_id == 2) {
                    $save_notification->message =  $app_name->app_name . " bug in progress";
                } else {
                    $save_notification->message =  $app_name->app_name . " bug complete";
                }
                $save_notification->save();
            } else {
                $save_notification = new app_notification;
                $app = \App\Designdetail::where('app_id', $bug->app_id)->first();
                if (!is_null($app)) {
                    if (!is_null($app->logo)) {
                        $save_notification->app_logo = $app->logo;
                    }
                }
                $save_notification->user_id = $projectM;
                $save_notification->app_id = $bug->app_id;
                $save_notification->owner_id = Auth::id();

                if ($staus_id == 1) {
                    $save_notification->message =  $app_name->app_name . " bug in progress";
                } elseif ($staus_id == 2) {
                    $save_notification->message =  $app_name->app_name . " bug in progress";
                } else {
                    $save_notification->message =  $app_name->app_name . " bug is complete";
                }
                $save_notification->save();
            }
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
            $bugstatus = array();
            $userId = User::find($app_name->user_id);
            $bugstatus['business_name'] = $userId->business_name;
            $bugstatus['bug_type'] = $bug->bug_type;
            $bugstatus['bug_screenshot'] = $bug->bug_screenshot;
            $bugstatus['bug_note'] = $request->bug_note;
            $bugstatus['bug_description'] = $bug->bug_description;
            $bugstatus['status'] = $staus_id;
            $bugstatus['multiple'] = 0;
            $bugstatus['bug_estimated_date'] = "";
            $bugstatus['require_store'] = "";

            if ($staus_id == 3) {
                if ($userId->parent_id == 0) {
                    $user_child = User::where('parent_id', $userId->id)->get();
                    if (count($user_child) > 0) {
                        foreach ($user_child as $child) {
                            // Mail::to($child->email)->send(new BugStatus($bugstatus));
                        }
                    }
                    // Mail::to($userId->email)->send(new BugStatus($bugstatus));
                }
            }

            return response()->json(['status' => true, "message" => "Bug status updated successfully", "payload" => $staus_id]);;
        }
    }

    public function bugs(Request $request)
    {
        $bugs = Bug::with('about_app:id,app_name')->orderBy('created_at', 'desc')->get();
        return response()->json(['status' => true, 'payload' => $bugs]);
    }
}
