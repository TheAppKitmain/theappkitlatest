<?php

namespace App\Http\Controllers\API\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\FoodSendOtp;
use Validator;
use Auth;
use App\Models\Template\Booking\BookingAppUser;
use App\Models\Template\Booking\BookingCartype;
use App\Models\Template\Booking\BookingUserCarData;
use App\Models\Template\Booking\BookingDeviceType;
use App\Models\Template\Booking\BookingUserInformation;
use App\Models\Template\Food_Delivery\FoodOtp;
use Illuminate\Support\Facades\Storage;
use App\UserCarData;
use Carbon\Carbon;
use App\Models\Template\Booking\BookingCount;
use DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:booking_app_users',
            'password' => 'required|string|min:6',
            'number' => 'required|unique:booking_app_users',
            'address' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            // 'licence_plate' => 'required|unique:booking_user_car_data',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'cartype' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {

            $user = new BookingAppUser;
            $user->owner_id = $request->owner_id;
            $user->template_id = $request->template_id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = \Hash::make($request->password);
            $user->number = $request->number;

            if ($user->save()) {

                if (isset($request->device_id) && !empty($request->device_id)) :

                    $device_token = BookingDeviceType::where('device_id', $request->device_id)->first();

                    if (!is_null($device_token)) {
                        $device_token->firebase_token = $request->firebase_token;
                        $device_token->update();
                    } else {

                        $user_device_data = new BookingDeviceType;
                        $user_device_data->owner_id = $request->owner_id;
                        $user_device_data->template_id = $request->template_id;
                        $user_device_data->booking_user_id = $user->id;
                        $user_device_data->device_id = $request->device_id;
                        $user_device_data->firebase_token = $request->firebase_token;
                        $user_device_data->device_type = $request->device_type;
                        $user_device_data->save();
                    }
                endif;

                $info = $user->user_information ?? new BookingUserInformation;
                $info->booking_app_user_id = $user->id;
                $info->address = $request->address;
                $info->address_line = $request->address_line ?? null;
                $info->city = $request->city;
                $info->postcode = $request->postcode;
                $token = $user->createToken($user->email)->accessToken;
                if ($info->save()) {
                    $user_car_data = new BookingUserCarData;
                    $user_car_data->app_user_id = $info->user_id;
                    $user_car_data->licence_plate = $request->licence_plate;
                    $user_car_data->make = $request->make;
                    $user_car_data->model = $request->model;
                    $user_car_data->year = $request->year;
                    $user_car_data->cartype = $request->cartype;
                    $user_car_data->mode = '1';
                    $user_car_data->save();

                    return response()->json(['status' => true, 'message' => 'Thanks for registering with ShoUp Car wash.', 'payload' => $token]);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something error while registering! Try after some time!.']);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Something error while registering! Try after some time!.']);
            }
        }
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $credentials = request(['email', 'password']);
            if (Auth::guard('booking_app_user')->attempt($credentials)) {
                $id = Auth::guard('booking_app_user')->user()->id;
                $user = BookingAppUser::find($id);

                if (isset($request->device_id) && !empty($request->device_id)) :

                    $device_token = BookingDeviceType::where('device_id', $request->device_id)->first();

                    if (!is_null($device_token)) {

                        $device_token->firebase_token = $request->firebase_token;
                        $device_token->update();
                    } else {

                        $user_device_data = new BookingDeviceType;
                        $user_device_data->owner_id = $user->owner_id;
                        $user_device_data->template_id = $user->template_id;
                        $user_device_data->booking_user_id = $user->id;
                        $user_device_data->device_id = $request->device_id;
                        $user_device_data->firebase_token = $request->firebase_token;
                        $user_device_data->device_type = $request->device_type;
                        $user_device_data->save();
                    }
                endif;
                $user->role =  'customer';
                $user->user_information = $user->user_information;
                $user->carinfo = BookingUserCarData::where('app_user_id', $user->id)->first(['licence_plate', 'make', 'model', 'year', 'cartype']);
                if ($user->carinfo) {
                    $user->cartype = BookingCartype::find($user->carinfo['cartype']);
                }
                $user->token = $user->createToken($user->email)->accessToken;
                return response()->json(['status' => true, 'message' => 'Thanks for login with ShoUp Car wash.', 'payload' => $user], 200);
            } else {
                return response()->json(['status' => false, 'message' => "user not found"]);
            }
        }
    }

    public function update_firebase_token(Request $request)
    {
        $rules = ['token' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $user = BookingAppUser::find(Auth::guard('booking_app_user_api')->user()->id);
            $device_token = BookingDeviceType::where('booking_user_id', $user->id)->first();
            $device_token->firebase_token = $request->token;
            if ($device_token->save()) {
                return response()->json(['status' => true, 'message' => 'tokens updated successfully.']);
            } else {
                return response()->json(['status' => false, 'message' => "Something went wrong."]);
            }
        }
    }

    public function logout(Request $request)
    {
        $user = BookingAppUser::find(Auth::guard('booking_app_user_api')->user()->id);
        $device_token = BookingDeviceType::where('booking_user_id', $user->id)->first();
        $device_token->firebase_token = null;

        if ($device_token->save()) {
            // $request->user()->token()->revoke();
            return response()->json(['status' => true, 'message' => 'You are successfully logged out!.']);
        } else {
            return response()->json(['status' => false, 'message' => "Something went wrong."]);
        }
    }

    public function profile(Request $request)
    {
        $user = BookingAppUser::find(Auth::guard('booking_app_user_api')->user()->id, ['id', 'name', 'email', 'mobile', 'image']);
        $user->user_information = $user->user_information;
        $user->carinfo = BookingUserCarData::where('app_user_id', $user->id)->where('mode', '1')->first(['licence_plate', 'make', 'model', 'year', 'cartype', 'mode']);
        if ($user->carinfo) {
            $user->cartype = BookingCartype::find($user->carinfo['cartype']);
        }
        $booking_count =  BookingCount::where('user_id', $user->id)->first(['booking_count']);
        if ($booking_count) {
            $user->booking_count = $booking_count['booking_count'];
        } else {
            $user->booking_count = 0;
        }

        return response()->json(['status' => true, 'payload' => $user]);
    }

    public function edit_profile(Request $request)
    {
        $rules = [
            'name' => 'required',
            'number' => 'required|unique:booking_app_users,number,' . Auth::guard('booking_app_user_api')->user()->id,
            'address' => "required",
            'postcode' => 'required',
            'city' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $user = BookingAppUser::find(Auth::guard('booking_app_user_api')->user()->id);
            if (!is_null($user)) :
                $user->name = $request->name;
                $user->mobile = $request->mobile;
                if ($request->hasFile('image')) {
                    $user->profile = $request->file('image')->store('user');
                    $name = time() . '.' . $request->file('image')->getClientOriginalExtension();
                    $image_full_name = 'img_' . $name;
                    $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                    Storage::disk('s3')->put($filePath, file_get_contents($request->file('image')));
                    $url = config('services.base_url') . "/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/" . $image_full_name;
                    $user->image = $url;
                }
                if ($user->save()) {
                    $info = $user->user_information ?? new BookingUserInformation;
                    $info->booking_app_user_id = $user->id;
                    $info->address = $request->address;
                    $info->address_line = $request->address_line ?? null;
                    $info->city = $request->city;
                    $info->postcode = $request->postcode;
                    $info->save();
                    $user->user_information = $info;
                    return response()->json(['status' => true, 'message' => 'Your profile has been updated.', 'payload' => $user]);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something error while updating your profile! Try after some time.']);
                }
            else :
                return response()->json(['status' => false, 'message' => 'No user found.']);
            endif;
        }
    }

    public function edit_address(Request $request)
    {
        $rules = [
            'address' => "required",
            'postcode' => 'required',
            'city' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        } else {
            $user = BookingAppUser::find(Auth::guard('booking_app_user_api')->user()->id);
            if (!is_null($user)) :
                $info = $user->user_information ?? new BookingUserInformation;
                $info->booking_app_user_id = Auth::guard('booking_app_user_api')->user()->id;
                $info->address = $request->address;
                $info->address_line = $request->address_line ?? null;
                $info->city = $request->city;
                $info->postcode = $request->postcode;
                if ($info->save()) {
                    return response()->json(['status' => true, 'message' => 'Your address has been updated!']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something error while updating your address! Try after some time!.']);
                }
            else :

                return response()->json(['status' => false, 'message' => 'No user found.']);
            endif;
        }
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email']);
        if ($validator->fails()) :
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        endif;
        $user = BookingAppUser::whereEmail($request->email)->first();
        if (!is_null($user)) :
            $otp = FoodOtp::whereAppUserId($user->id)->first();
            if (!is_null($otp)) :
                $otp->expire_at = Carbon::now()->addMinutes(2);
                $otp->code = mt_rand(100000, 999999);
                if ($otp->save()) :
                    Mail::to($request->email)->send(new FoodSendOtp($otp));
                    return response()->json(['status' => true, 'message' => 'OTP sent to your mail.', 'payload' => $user->id]);
                else :
                    return response()->json(['status' => false, 'message' => 'Something problem when generating otp.']);
                endif;
            else :
                $otp = new FoodOtp;
                $otp->app_user_id = $user->id;
                $otp->expire_at = Carbon::now()->addMinutes(2);
                $otp->code = mt_rand(100000, 999999);
                if ($otp->save()) :
                    Mail::to($request->email)->send(new FoodSendOtp($otp));
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
        $user = BookingAppUser::find($request->user_id);
        if (!is_null($user)) :
            $otp = FoodOtp::whereCode($request->otp)->whereAppUserId($user->id)->first();
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
        $validator = Validator::make($request->all(), ['user_id' => 'required|integer', 'password' => 'required|string|min:6']);
        if ($validator->fails()) :
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        endif;
        $user = BookingAppUser::find($request->user_id);
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

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), ['old_password' => 'required', 'new_password' => 'required|min:6|different:password']);
        if ($validator->fails()) :
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        endif;
        $user = BookingAppUser::find(Auth::guard('booking_app_user_api')->user()->id);
        if (!is_null($user)) :
            if (\Hash::check($request->old_password, $user->password)) {
                $password = \Hash::make($request->new_password);
                $user->password = $password;
                if ($user->save()) :
                    return response()->json(['status' => true, 'message' => 'Your password has been changed successfully.']);
                else :
                    return response()->json(['status' => false, 'message' => "Something went wrong."]);
                endif;
            } else {
                return response()->json(['status' => false, 'message' => 'Password does not match']);
            }
        else :
            return response()->json(['status' => false, 'message' => "User not found."]);
        endif;
    }
}
