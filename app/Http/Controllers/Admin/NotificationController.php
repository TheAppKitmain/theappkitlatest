<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\app_notification;
use Auth;

class NotificationController extends Controller
{

    public function manage_notification(Request $request)
    {
        if ($request->isMethod('get')) {
            $all_users  = \App\User::where('role_id', '!=', 4)->where('parent_id', 0)->orderBy('id', 'desc')->get();
            return view('admin.super_admin.notifications', compact('all_users'));
        }
        if ($request->isMethod('post')) {

            $noti_body = $request->notif_body;
            if ($request->notif_to == 1) {
                $all_users  = \App\User::orderBy('id', 'desc')->pluck('id');
                if (count($all_users) > 0) {


                    foreach ($all_users as $ky => $val) {
                        $save_notification = new app_notification;
                        $save_notification->user_id =  $val;
                        $save_notification->owner_id = Auth::id();

                        $logo = Auth::user()->avatar;
                        if (!is_null($logo)) {
                            $save_notification->app_logo = $logo;
                        }
                        $save_notification->message = $noti_body;
                        $save_notification->save();
                    }

                    $all_users = \App\DeviceType::WhereIn('user_id', $all_users)->pluck('firebase_token')->toArray();
                    $all_guest_users = \App\DeviceType::whereNull('user_id')->whereNotNull('firebase_token')->pluck('firebase_token')->toArray();
                    if (count($all_guest_users) > 0) {
                        $all_firebase_tokens = array_merge($all_users, $all_guest_users);
                    } else {
                        $all_firebase_tokens = $all_users;
                    }

                    if (count($all_firebase_tokens) > 0) {

                        $message = [
                            "registration_ids" => $all_firebase_tokens,
                            "priority" => 'high',
                            "sound" => 'default',
                            "badge" => '1',
                            "data" =>
                            [
                                "body"  => $noti_body,
                                "type" => 'notification',
                            ],
                            "notification" =>
                            [
                                "body"  => $noti_body,
                                "type" => 'notification',
                            ]
                        ];
                        \App\App_PushNotification::send($message);
                    }
                }

                return redirect()->route('manage_notification')->with(['alert' => 'success', 'message' => 'notification sent successfully.']);
            } else {
                $customer_ids = $request->users_id;
                if (count($customer_ids) > 0) {

                    foreach ($customer_ids as $ky => $val) {
                        $save_notification = new app_notification;
                        $save_notification->user_id =  $val;
                        $save_notification->owner_id = Auth::id();

                        $logo = Auth::user()->avatar;
                        if (!is_null($logo)) {
                            $save_notification->app_logo = $logo;
                        } else {
                            $save_notification->app_logo = $logo;
                        }

                        $save_notification->message = $noti_body;
                        $save_notification->save();
                    }

                    $all_users = \App\DeviceType::WhereIn('user_id', $customer_ids)->pluck('firebase_token')->toArray();
                    if (count($all_users) > 0) {
                        $message = [
                            "registration_ids" => $all_users,
                            "priority" => 'high',
                            "sound" => 'default',
                            "badge" => '1',
                            "data" =>
                            [
                                "body"  => $noti_body,
                                "type" => 'notification',
                            ],
                            "notification" =>
                            [
                                "body"  => $noti_body,
                                "type" => 'notification',
                            ]
                        ];
                        \App\App_PushNotification::send($message);
                    }
                }
                return redirect()->route('manage_notification')->with(['alert' => 'success', 'message' => 'notification sent successfully.']);
            }
        }
    }
}
