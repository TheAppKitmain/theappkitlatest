<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Template\E_Commerce\AppUser;
use App\Models\Template\E_Commerce\EcommDeviceType;
use App\Models\Template\E_Commerce\eComm_stripe_credentials;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stripe\Stripe;
use Auth;
use Str;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\EcommRegisterMail;
use App\Mail\SendOTP;
class CustomerRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:app_user')->except('logout');
    }

    public function customerregister(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:app_users'],
            'password' => ['required', 'string', 'min:8'],
        ];

        $validator = Validator::make($request->all(), $rules);

	    if ($validator->fails())
	    {
	      return response()->json(['status' => false,'message' => $validator->errors()->first()]);
	    }
	    else
	    {
        $user = new AppUser;
        $user->owner_id = $request->owner_id;
        $user->template_id = $request->template_id;
        $user->name = $request->name;
        $user->number = $request->number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $bugstatus['name'] = $request->name;
        
        Mail::to($user->email)->send(new EcommRegisterMail($bugstatus));

        if(isset($request->device_id) && !empty($request->device_id)):

          $device_token = EcommDeviceType::where('device_id',$request->device_id)->first();

          if(!is_null($device_token)){
            $device_token->firebase_token = $request->firebase_token;
            $device_token->update();
          }
          else {

              $user_device_data = new EcommDeviceType;
              $user_device_data->owner_id = $request->owner_id;
              $user_device_data->template_id = $request->template_id;
              $user_device_data->app_user_id = $user->id;
              $user_device_data->device_id = $request->device_id;
              $user_device_data->firebase_token = $request->firebase_token;
              $user_device_data->device_type = $request->device_type;
              $user_device_data->save();

          }
        endif;

        $stripe = eComm_stripe_credentials::where('owner_id', $user->owner_id)->where('template_id', $user->template_id)->first();

        if(!is_null($stripe))
        {    
          Stripe::setApiKey($stripe->stripe_secret);
          $customer = \Stripe\Customer::create(array('name'=>$user->name,'email'=>$request->email,));
          $stripe_customer = AppUser::find($user->id);
          $stripe_customer->stripe_customer_id = $customer->id;
          $stripe_customer->save();
        }


        if($user->user_profile == ""){

          $user->user_profile = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";

        }

            return response()->json(['status'=>True, "message" => "customer record created","name" => $user->name,"email" => $user->email,"profile" => $user->user_profile ]);
        }

    }

    public function signin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $rules = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return  response()->json(["message" => $validator->errors()->first()],400);
        }
        $credentials = [ 'email' => $request->email, 'password' => $request->password ];

        if (auth('app_user')->attempt($credentials))
        {
            $id = auth('app_user')->user()->id;
            $token = auth('app_user')->user()->createToken('MyApp')->accessToken;

            $appuser = AppUser::find($id);
           
            $stripe = eComm_stripe_credentials::where('owner_id', $appuser->owner_id)->where('template_id', $appuser->template_id)->first();

            if(!is_null($stripe))
            {    
              Stripe::setApiKey($stripe->stripe_secret);
              if(!is_null($appuser->stripe_customer_id))
              {

              }else
              {
                $customer = \Stripe\Customer::create(array('name'=>$appuser->name,'email'=>$request->email,));
                $stripe_customer = AppUser::find($id);
                $stripe_customer->stripe_customer_id = $customer->id;
                $stripe_customer->save();
              }

            }

            if($appuser->user_profile == ""){

                $appuser->user_profile = "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";

            }

            if(isset($request->device_id) && !empty($request->device_id)):

              $device_token = EcommDeviceType::where('device_id',$request->device_id)->first();
    
              if(!is_null($device_token)){

                $device_token->firebase_token = $request->firebase_token;
                $device_token->update();
    
              }
              else {
    
                  $user_device_data = new EcommDeviceType;
                  $user_device_data->owner_id = $appuser->owner_id;
                  $user_device_data->template_id = $appuser->template_id;
                  $user_device_data->app_user_id = $appuser->id;
                  $user_device_data->device_id = $request->device_id;
                  $user_device_data->firebase_token = $request->firebase_token;
                  $user_device_data->device_type = $request->device_type;
                  $user_device_data->save();
    
              }
            endif;

            return response( array( "message" => "Sign In Successful", 'status'=>true, "data" => [ "token" => $token ,"id" => $appuser->id, "name" => $appuser->name,"email" => $appuser->email,"profile" => $appuser->user_profile ,"customer_id" => $appuser->stripe_customer_id, "stripe" => $stripe ]  ), 200 );
                   
        }
        else
        {
            return response( array( "message" => "Wrong Credentials." ), 400 );
        }

    }

    public function editprofile($id)
    {
        $appuser = AppUser::find($id);
        return response()->json(['status'=>true,'payload'=>$appuser]);
    }


    public function customerregisterupdate(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

	    if ($validator->fails())
	    {
	      return response()->json(['status' => false,'message' => $validator->errors()->first()]);
	    }
	    else
	    {
            $id =  Auth::guard('app_user_api')->user()->id;

            $data = array();
            $data['name'] = $request->name;
            $data['number'] = $request->number;
            $user_profile = $request->file('user_profile');

            if ($user_profile) {

                $name = time().'.'.$user_profile->getClientOriginalExtension();
                $image_full_name = 'img_'.$name;
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/'.$image_full_name;
                Storage::disk('s3')->put($filePath, file_get_contents($user_profile));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
                $data['user_profile'] = $url;
            }

            $appuser = AppUser::where('id',$id)->update($data);

            if(isset($request->device_id) && !empty($request->device_id)):

              $device_token = EcommDeviceType::where('device_id',$request->device_id)->first();
    
              if(!is_null($device_token)){
    
                $device_token->firebase_token = $request->firebase_token;
                $device_token->update();
    
              }
              else {
    
                  $user_device_data = new EcommDeviceType;
                  $user_device_data->owner_id = $request->owner_id;
                  $user_device_data->template_id = $request->template_id;
                  $user_device_data->app_user_id = $appuser->id;
                  $user_device_data->device_id = $request->device_id;
                  $user_device_data->firebase_token = $request->firebase_token;
                  $user_device_data->device_type = $request->device_type;
                  $user_device_data->save();
    
              }
            endif;

            return response()->json(['status'=>True, "message" => "customer record updated"]);
        }

    }

    public function customerprofile()
    {
        $id =  Auth::guard('app_user_api')->user()->id;
        $appuser = AppUser::find($id);
        return $appuser;
    }

    public function create_custom_token(){
        $token = Str::random(100);
        return $token;
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), ['email'=>'required|email']);
        if ($validator->fails()):
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        endif;
        $user = AppUser::where('email',$request->email)->first();
        if(!is_null($user)):
            $otp = \App\TemplateOTP::whereUserId($user->id)->first();
            if(!is_null($otp)):
                $otp->expire_at = Carbon::now()->addMinutes(2);
                $otp->code = mt_rand(100000,999999);
                if($otp->save()):
                  Mail::to($request->email)->send(new SendOTP($otp));
                  return response()->json(['status' => true,'message' => 'OTP sent to your mail.','user_id'=>$user->id,'user_name'=>$user->name]);
                else:
                  return response()->json(['status' => false,'message' => 'Something problem when generating otp.']);
                endif;
            else:
                $otp = new \App\TemplateOTP;
                $otp->user_id = $user->id;
                $otp->expire_at = Carbon::now()->addMinutes(2);
                $otp->code = mt_rand(100000,999999);
                if($otp->save()):
                  Mail::to($request->email)->send(new SendOTP($otp));
                  return response()->json(['status' => true,'message' => 'OTP sent to your mail.','user_id'=>$user->id,'user_name'=>$user->name]);
                else:
                  return response()->json(['status' => false,'message' => 'Something problem when generating otp.']);
                endif;
            endif;
        else:
            return response()->json(['status' => false,'message' => 'User not found.']);
        endif;
    }

    public function match_otp(Request $request)
    {
        $validator = Validator::make($request->all(), ['otp'=>'required|integer','user_id'=>'required|integer']);
        if ($validator->fails()):
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        endif;
        $user = AppUser::find($request->user_id);
        if(!is_null($user)):
          $otp = \App\TemplateOTP::whereCode($request->otp)->whereUserId($user->id)->first();
          if(!is_null($otp)):
            if(Carbon::now() > $otp->expire_at):
              return response()->json(['status' => false,'message' => 'OTP Expired.']);
            else:
              return response()->json(['status' => true,'message' => 'OTP Matched.']);
            endif;
          else:
            return response()->json(['status' => false,'message' => 'OTP not matched.']);
          endif;
        else:
          return response()->json(['status' => false,'message' => 'User not found.']);
        endif;
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), ['user_id'=>'required|integer','password'=>'required|string|min:6|confirmed']);
        if ($validator->fails()):
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        endif;
        $user = AppUser::find($request->user_id);
        if(!is_null($user)):
            $password = \Hash::make($request->password);
            $user->password = $password;
            if($user->save()):
              return response()->json(['status' => true,'message' => 'Your password has been reset successfully.']);
            else:
              return response()->json(['status' => false,'message' => 'Your password has not been reset.']);
            endif;
        else:
          return response()->json(['status' => false,'message' => "User not found."]);
        endif;
    }

    public function change_password(Request $request)
    {
        $id = Auth::guard('app_user_api')->user()->id;
        $user = AppUser::find($id);
        if(!is_null($user)):
            $validator = Validator::make($request->all(), ['old_password'=>'required','password'=>'required|string|min:6|confirmed']);
            if ($validator->fails()):
                return response()->json(['status' => false,'message' => $validator->errors()->first()]);
            endif;
            $password = \Hash::make($request->password);
            if(\Hash::check($request->old_password,$user->password)):
                $user->password = $password;
                if($user->save()):
                  return response()->json(['status' => true,'message' => 'Your password has been changed successfully.']);
                else:
                  return response()->json(['status' => false,'message' => 'Your password has not been changed.']);
                endif;
            else:
                return response()->json(['status' => false,'message' => "Please enter correct password."]);
            endif;
        else:
            return response()->json(['status'=>false,'message'=>'User not found.']);
        endif;
    }

    public function logout(Request $request){

      $user = AppUser::find($request->appuser_id);
      if($user->save()){

        // $request->user()->token()->revoke();

        if(isset($request->device_id) && !empty($request->device_id)):
          EcommDeviceType::where('device_id',$request->device_id)->delete();
        endif;

        return response()->json(['status'=>true,'message' => 'You are successfully logged out!.']);

      } else {

        return response()->json(['status' => false,'message' => "Something went wrong."]);

      }  
  }
}
