<?php

namespace App\Http\Controllers\API\App_kit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyYourAccountApp;
use Validator;
use App\Mail\UserRegisterMail;
use DB;
use Auth;
use App\User;
use App\AppkitOtp;
use App\DeviceType;
use App\Assignpm;
use App\Usertheme;
use App\Designdetail;


use App\app_notification;

use App\Mail\AppkitSendOtp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

class AuthController extends Controller
{
    public function appkit_register_verify(Request $request)
    {
        $rules = [
            'business_name' => 'required|string',
            'first_name' => 'required|string|max:255',
            'number' => 'required|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'country' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        } else {
            $expire_at = Carbon::now()->addMinutes(5);
            $code = mt_rand(100000, 999999);
            $dataList['otp'] = $code;
            $dataList['business_name'] = $request->business_name;
            Mail::to($request->email)->send(new VerifyYourAccountApp($dataList));
            $data['otp'] = $code;
            $data['expire_at'] = $expire_at;
            return response()->json(['status' => true, 'message' => 'verification code', 'payload' => $data]);
        }
    }


    public function user_registration(Request $request)
    {
        $rules = [
            'business_name' => 'required|string',
            'first_name' => 'required|string|max:255',
            'number' => 'required|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'country' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        } else {
            $user = new User;
            $user->business_name = $request->business_name;
            $user->first_name = $request->first_name;
            $user->referred_by = $request->referred_by;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->number = $request->number;
            $user->country_code = $request->country_code;
            $user->phone_code = $request->phone_code;
            $user->country_flag = $request->country_flag;
            $user->country = $request->country;
            $user->role_id = 1;
            $user->user_type = 'custom';
            $user->password = Hash::make($request->password);
            $user->is_email_verified = 1;
            if ($user->save()) {

                $bugstatus['business_name'] = $request->business_name;
                $bugstatus['first_name'] = $request->first_name;
                $bugstatus['last_name'] = $request->last_name;
                $bugstatus['email'] = $request->email;
                $bugstatus['user_type'] = "custom";

                Mail::to('kyle@theappkit.co.uk')->send(new UserRegisterMail($bugstatus));
                Mail::to('support@theappkit.co.uk')->send(new UserRegisterMail($bugstatus));

                if (isset($request->device_id) && !empty($request->device_id)) :
                    $user_device_data = new DeviceType;
                    $user_device_data->user_id = $user->id;
                    $user_device_data->device_id = $request->device_id ?? null;
                    $user_device_data->firebase_token = $request->firebase_token ?? null;
                    $user_device_data->device_type = $request->device_type ?? null;
                    $user_device_data->save();
                endif;
                $data['id'] = $user->id;
                $data['token'] = $user->createToken($user->email)->accessToken;
                return response()->json(['status' => true, 'message' => 'Thank you for signing up.', 'payload' => $data]);
            } else {
                return response()->json(['status' => false, 'message' => 'Something error while registering! Try after some time!.']);
            }
        }
    }

    public function login(Request $request)
    {
        $rules = ['email' => 'required|string|email', 'password' => 'required|string|min:6',];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) :
                $user = User::find(auth()->user()->id);
                if (!is_null($user)) :
                    if (isset($request->device_id) && !empty($request->device_id)) :
                        $device_token = DeviceType::where('device_id', $request->device_id)->first();
                        if (!is_null($device_token)) {
                            $device_token->firebase_token = $request->firebase_token;
                            $device_token->update();
                        } else {
                            $user_device_data = new DeviceType;
                            if (Auth::user()->parent_id == 0) {
                                $user_device_data->user_id = $user->id;
                            } else {
                                $user_device_data->user_id = $user->parent_id;
                            }
                            $user_device_data->device_id = $request->device_id;
                            $user_device_data->device_type = $request->device_type ?? null;
                            $user_device_data->firebase_token = $request->firebase_token;
                            $user_device_data->save();
                        }

                    endif;
                    $data['id'] = $user->id;
                    $data['owner_account'] = $user->parent_id == 0 ? 1 : 0;
                    if ($user->role_id !== 4) {
                        $data['token'] = $user->createToken($user->email)->accessToken;
                        return response()->json(['status' => true, 'message' => 'Thanks for login with App kit.', 'payload' => $data, 'role_id' => $user->role_id, 'name' => $user->first_name, 'parent_id' => $user->parent_id]);
                    } else {
                        return response()->json(['status' => false, 'message' => 'You are not authorized to login.']);
                    }
                else :
                    return response()->json(['status' => false, 'message' => 'user not found.']);
                endif;
            else :
                return response()->json(['status' => false, 'message' => 'These credentials do not match our records.']);
            endif;
        }
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email']);
        if ($validator->fails()) :
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        endif;
        $user = User::whereEmail($request->email)->first();
        if (!is_null($user)) :
            $otp = AppkitOtp::whereUserId($user->id)->first();
            if (!is_null($otp)) :
                $otp->user_id = $user->id;
                $otp->expire_at = Carbon::now()->addMinutes(5);
                $otp->code = mt_rand(100000, 999999);
                if ($otp->save()) :
                    Mail::to($request->email)->send(new AppkitSendOtp($otp));
                    return response()->json(['status' => true, 'message' => 'OTP sent to your mail.', 'payload' => $user->id]);
                else :
                    return response()->json(['status' => false, 'message' => 'Something problem when generating otp.']);
                endif;
            else :
                $otp = new AppkitOtp;
                $otp->user_id     = $user->id;
                $otp->expire_at = Carbon::now()->addMinutes(5);
                $otp->code = mt_rand(100000, 999999);
                if ($otp->save()) :
                    Mail::to($request->email)->send(new AppkitSendOtp($otp));
                    return response()->json(['status' => true, 'message' => 'OTP sent to your mail.', 'payload' => $user->id]);
                else :
                    return response()->json(['status' => false, 'message' => 'Something problem when generating otp.']);
                endif;
            endif;
        else :
            return response()->json(['status' => false, 'message' => 'User not found.']);
        endif;
    }

    public function match_otp(Request $request)
    {
        $validator = Validator::make($request->all(), ['otp' => 'required|integer', 'user_id' => 'required|integer']);
        if ($validator->fails()) :
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        endif;
        $user = User::find($request->user_id);
        if (!is_null($user)) :
            $otp = AppkitOtp::whereCode($request->otp)->whereUserId($user->id)->first();
            if (!is_null($otp)) :
                if (Carbon::now() > $otp->expire_at) :
                    return response()->json(['status' => false, 'message' => 'OTP Expired.']);
                else :
                    return response()->json(['status' => true, 'message' => 'OTP Matched.']);
                endif;
            else :
                return response()->json(['status' => false, 'message' => 'OTP not matched.']);
            endif;
        else :
            return response()->json(['status' => false, 'message' => 'User not found.']);
        endif;
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), ['user_id' => 'required|integer', 'password' => 'required|string|min:8|confirmed']);
        if ($validator->fails()) :
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        endif;
        $user = User::find($request->user_id);
        if (!is_null($user)) :
            $password = \Hash::make($request->password);
            $user->password = $password;
            if ($user->save()) :
                return response()->json(['status' => true, 'message' => 'Your password has been changed successfully.']);
            else :
                return response()->json(['status' => false, 'message' => 'Your password has not been changed.']);
            endif;
        else :
            return response()->json(['status' => false, 'message' => "User not found."]);
        endif;
    }

    public function customerprofile()
    {
        $id =  Auth::user()->id;
        $appkituser = User::find($id);

        if ($appkituser->avatar == "avatar.png") {
            $appkituser->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
        }

        $assignpm = Assignpm::where('customer_id', $appkituser->id)->first();
        if (!is_null($assignpm)) {
            $project_manager = User::where('id', $assignpm->project_manager_id)->select('id', 'first_name', 'last_name', 'avatar')->first();
            if ($project_manager->avatar == "avatar.png") {
                $project_manager->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
            }
            return response()->json(['status' => true, 'message' => $appkituser, 'project_manager' => $project_manager]);
        } else {
            return response()->json(['status' => true, 'message' => $appkituser, 'project_manager' => 'No project manager assign yet']);
        }
    }

    public function customerregisterupdate(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'number' => 'required',
            'country' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $id =  Auth::user()->id;
            $data = array();
            $data['first_name'] = $request->first_name;
            $data['last_name'] = $request->last_name;
            $data['country'] = $request->country;
            $data['number'] = $request->number;
            $data['country_code'] = $request->country_code;
            $data['phone_code'] = $request->phone_code;
            $data['country_flag'] = $request->country_flag;


            $user_profile = $request->file('avatar');

            if ($user_profile) {
                $name = time() . '.' . $user_profile->getClientOriginalExtension();
                $image_full_name = 'img_' . $name;
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                Storage::disk('s3')->put($filePath, file_get_contents($user_profile));
                $url = config('services.base_url') . "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/" . $image_full_name;
                $data['avatar'] = $url;
            }
            $appuser = User::where('id', $id)->update($data);
            return response()->json(['status' => True, "message" => "customer record updated"]);
        }
    }



    public function logout(Request $request)
    {
        $user = \App\User::find($request->user()->id);
        if ($user->save()) {
            $request->user()->token()->revoke();
            if (isset($request->device_id) && !empty($request->device_id)) :
                $user_device_data = \App\DeviceType::where('device_id', $request->device_id)->first();
                if (!is_null($user_device_data)) {
                    $user_device_data->delete();
                }
            endif;
            return response()->json(['status' => true, 'message' => 'You are successfully logged out!.']);
        } else {
            return response()->json(['status' => false, 'message' => "Something went wrong."]);
        }
    }

    public function notification(Request $request)
    {
        $notifications = app_notification::where('user_id', $request->user_id)->orderBy('id', 'desc')->get();
        if (count($notifications) > 0) {

            foreach ($notifications as $notification) {

                $single = \App\app_notification::find($notification->id);
                $single->status = '1';
                $single->save();
                if ($notification->app_logo == "avatar.png") {
                    $notification->app_logo == "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                }
            }

            return response()->json(['status' => true, 'message' => $notifications]);
        } else {
            return response()->json(['status' => false, 'message' => 'No Notifications']);
        }
    }



    public function count_notification(Request $request)
    {
        if (Auth::user()->parent_id == 0) {
            $notifications = \App\app_notification::where('user_id', $request->user()->id)->where('status', '0')->count();
        } else {
            $notifications = \App\app_notification::where('user_id', $request->user()->parent_id)->where('status', '0')->count();
        }
        return response()->json(['status' => true, 'message' => 'notifications count.', 'payload' => $notifications]);
    }




    public function user_details(Request $request)
    {

        if ($request->role_id == 2) :

            $assignpm = Assignpm::where('project_manager_id', $request->user_id)->first();

            if (!is_null($assignpm)) :

                $project_manager = User::where('id', $assignpm->project_manager_id)->select('id', 'business_name', 'first_name', 'last_name', 'avatar')->first();
                if ($project_manager->avatar == "avatar.png") {
                    $project_manager->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                }

                $customer_id = Assignpm::where('project_manager_id', $request->user_id)->pluck('customer_id')->toArray();
                $customer = User::whereIn('id', $customer_id)->select('id', 'business_name', 'first_name', 'last_name', 'avatar')->get();
                foreach ($customer as $data) {
                    if ($data->avatar == "avatar.png") {
                        $data->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                    }
                }

                return response()->json(['Status' => true, 'project_manager' => $project_manager, 'customer' => $customer]);

            endif;

        elseif ($request->role_id == 1 || $request->role_id == 3) :
            $assignpm = Assignpm::where('customer_id', $request->user_id)->first();
            if (!is_null($assignpm)) {
                $project_manager = User::where('id', $assignpm->project_manager_id)->select('id', 'business_name', 'first_name', 'last_name', 'avatar')->first();
                if ($project_manager->avatar == "avatar.png") {
                    $project_manager->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                }
                $customer = User::where('id', $assignpm->customer_id)->select('id', 'business_name', 'first_name', 'last_name', 'avatar')->first();

                if ($customer->avatar == "avatar.png") {
                    $customer->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                }
                return response()->json(['status' => true, 'customer' => $customer, 'project_manager' => $project_manager]);
            } else {
                return response()->json(['status' => false, 'customer' => '', 'project_manager' => '']);
            }
        endif;
    }

    public function update_firebase_token(Request $request)
    {
        $rules = ['device_id' => 'required', 'token' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $user_device_data = DeviceType::where('user_id', $request->user()->id)->where('device_id', $request->device_id)->first();
            if (!is_null($user_device_data)) {
                $user_device_data->firebase_token = $request->token;
                $user_device_data->update();
                return response()->json(['status' => true, 'message' => 'tokens updated successfully.']);
            } else {
                return response()->json(['status' => true, 'message' => 'tokens updated successfully.']);
            }
        }
    }


    public function new_user(Request $request)
    {
        if ($request->isMethod('get')) {
            $user = \App\User::find($request->user()->id);
            $all_users_list  = User::where('parent_id', $user->id)->orderBy('id', 'desc')->get();
            return response()->json(['status' => true, 'payload' => $all_users_list]);
        }

        if ($request->isMethod('post')) {
            $customer = \App\User::find($request->user()->id);
            $rules = [
                'first_name' => 'required|string|max:255',
                'number' => 'required|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
            } else {
                $user = new User;
                $user->first_name = $request->first_name;
                $user->role_id = $customer->role_id;
                $user->business_name = $customer->business_name;
                $user->email = $request->email;
                $user->number = $request->number;
                $user->country = $customer->country;
                $user->user_type = $customer->user_type;
                $user->parent_id = $customer->id;
                $user->password = Hash::make($request->password);
                $user->is_email_verified = 1;
                $user->save();
                return response()->json(['status' => true, 'message' => 'User added successfully.']);
            }
        }
    }

    public function edit_customer_user($id)
    {
        $custom_user = User::find($id);
        return response()->json(['status' => true, 'payload' => $custom_user]);
    }

    public function update_customer_user(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'first_name' => 'required|string|max:255',
            'number' => 'required', 'unique:users,number,' . $request->user_id,
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user_id
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $user = \App\User::find($request->user_id);
            if ($user) {
                $user->first_name = $request->first_name;
                $user->email = $request->email;
                $user->number = $request->number;
                if ($request->has('password')) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();
                return response()->json(['status' => true, 'message' => 'User updated successfully.']);
            } else {
                return response()->json(['status' => false, 'message' => 'User not found.']);
            }
        }
    }

    public function delete_user($id)
    {
        $custom_user = User::find($id);
        if (!is_null($custom_user)) {
            $custom_user->delete();
            return response()->json(['status' => true, 'message' => 'Deleted successfully.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong.']);
        }
    }


    public function user_firebase(Request $request)
    {
        $validator = Validator::make($request->all(), ['user_id' => 'required|integer']);
        if ($validator->fails()) :
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        endif;
        $user = DeviceType::where('user_id', $request->user_id)->get();
        if (count($user) > 0) {
            return response()->json(['status' => true, 'message' => $user]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong.']);
        }
    }


    public function customerprofileImage(Request $request)
    {
        $id =  $request->user_id;
        $appkituser = User::select('first_name', 'last_name', 'avatar')->where('id', $id)->get();
        if (count($appkituser) > 0) {
            foreach ($appkituser as $notification) {
                if ($notification->avatar == "avatar.png") {
                    $notification->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                }
            }
        }
        return response()->json(['status' => true, 'userimage' =>  $appkituser]);
    }

    public function childProfileImage(Request $request)
    {
        $id =  $request->user_id;
        $appkituser = User::where('id', $id)->first();
        if ($appkituser->parent_id == 0) {
            $user_child = User::where('parent_id', $appkituser->id)->get();
            if (count($user_child) > 0) {
                foreach ($user_child as $child) {
                    $child->first_name ==  $child->first_name;
                    $child->last_name ==  $child->last_name;
                    if ($child->avatar == "avatar.png") {
                        $child->avatar = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                    }
                }
            }
        }
        return response()->json(['status' => true, 'parent' =>  $appkituser, 'child' =>  $user_child]);
    }
}
