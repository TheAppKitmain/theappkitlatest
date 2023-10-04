<?php

namespace App\Http\Controllers\API\Food_Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template\Food_Delivery\FoodAppUser;
use App\Models\Template\Food_Delivery\FoodOtp;
use App\Models\Template\Food_Delivery\FoodDeviceType;
use App\Models\Template\Food_Delivery\FoodUserInformation;
use App\Models\Template\Food_Delivery\FoodCart;
use Illuminate\Support\Facades\Storage;
use App\Mail\FoodSendOtp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Registration;
use Illuminate\Support\Facades\Hash;
use Auth;
use Str;
use Validator;



class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:food_app_user')->except('logout');
    }
 


    public function register(Request $request)
    {

    	$rules = [
    		'name'=>'required',
    		'email'=>'required|string|email|max:255|unique:food_app_users',
    		'password'=>'required|string|min:6',
    		'number'=>'required|unique:food_app_users',
    		'address'=>"required",
    		'postcode'=>'required',
        'city'=>'required',
    	];
    	$validator = Validator::make($request->all(), $rules);
    	if ($validator->fails()) 
    	{
      	return response()->json(['status' => false,'message' => $validator->errors()->first()]);
    	}
    	else
    	{
  
        	$user = new FoodAppUser;
          $user->owner_id = $request->owner_id;
          $user->template_id = $request->template_id; 
  	    	$user->name = $request->name;           
  	    	$user->email = trim($request->email);
  	    	$user->password = \Hash::make($request->password);
  	    	$user->number = $request->number;

  	    	if($user->save())
  	    	{

            $info = $user->user_information ?? new FoodUserInformation;
  	    		$info->app_user_id = $user->id;
  	    		$info->address = $request->address;
  	    		$info->address_line = $request->address_line ?? null;
  	    		$info->city = $request->city;
  	    		$info->postcode = $request->postcode;
  	    		$info->save();

            if(isset($request->device_type) && !empty($request->device_type)):

              $device_type =  FoodDeviceType::create([
  
                  'owner_id' => $request['owner_id'],
                  'template_id' => $request['template_id'],
                  'app_user_id' => $user->id,
                  'firebase_token' => $request['firebase_token'],
                  'device_type' => $request['device_type'],
  
              ]);

            endif;
              
            Mail::to($user->email)->send(new Registration($user));
            $token = $user->createToken('MyApp')->accessToken;

  	    		return response()->json(['status'=>true,'message'=>'Thanks for signing up on We Go Delivery.','payload'=>array("token"=>$token,'id'=>$user->id)]);
  	    	}
  	    	else
  	    	{
  	    		return response()->json(['status'=>false,'message'=>'Something error while registering! Try after some time.']);
  	    	}
   
    	}
    }

    public function logout(Request $request)
    {
      $user = FoodAppUser::find(Auth::guard('food_app_user_api')->user()->id);
      // $request->user()->token()->revoke();
      return response()->json(['status'=>true,'message' => 'You are successfully logged out.']);
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


        if (auth('food_app_user')->attempt($credentials))
        {

            $user = FoodAppUser::where('email',$request->email)->first();
          //   if(isset($request->device_id) && !empty($request->device_id)  ):
          //     $device_token = FoodDeviceType::where('device_id',$request->device_id)->first();
          //     if(!is_null($device_token)){
          //       $device_token->firebase_token = $request->firebase_token;
          //       $device_token->update();
          //     }
          //     else
          //     {
          //        $user_device_data = new FoodDeviceType;
          //        $user_device_data->app_user_id = $user->id;
          //        $user_device_data->owner_id = $request->owner_id;
          //        $user_device_data->template_id = $request->template_id; 
          //        $user_device_data->device_type = $request->device_type ?? null;
          //        $user_device_data->firebase_token = $request->firebase_token;
          //        $user_device_data->save();
          //     }
          //  endif;
            $token = auth('food_app_user')->user()->createToken('MyApp')->accessToken;

          
            return response()->json(['status'=>true,'message'=>'Thanks for login with We Go Delivery.','payload'=>array("token"=>$token,'id'=>$user->id)]);
        }
        else
        {
            return response( array( "message" => "Wrong Credentials." ), 400 );
        }
    }

    
    public function user(Request $request)
    {
      $id =  Auth::guard('food_app_user_api')->user()->id;
    	$user = FoodAppUser::find($id);
      if(!is_null($user)):
        $user->user_information = $user->user_information;
        return response()->json(['status'=>true,'payload'=>$user]);
      else:
        return response()->json(['status'=>false,'message'=>'No user found.']);
      endif;
    }

    public function edit_profile(Request $request)
    {
      $user = FoodAppUser::find(Auth::guard('food_app_user_api')->user()->id);
        if(!is_null($user)):
        	$rules = [
        		'name'=>'required',
        		'number'=>'required|unique:food_app_users,number,'.$user->id,
        		'address'=>"required",
        		'postcode'=>'required',	
            'city'=>'required'
        	];
        	$validator = Validator::make($request->all(), $rules);
        	if ($validator->fails()) 
        	{
          	return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        	}
        	else
        	{
    	    	$user->name = $request->name;
            $user->number = $request->number ;
            if($request->file('image'))
            {
              $user->profile = $request->file('image')->store('user');
              $name = time().'.'.$request->file('image')->getClientOriginalExtension();
              $image_full_name = 'img_'.$name;
              $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/'.$image_full_name;
              Storage::disk('s3')->put($filePath, file_get_contents($request->file('image')));
              $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
              $user->profile = $url;
            }   	
    	    	if($user->save())
    	    	{
    	    		$info = $user->user_information ?? new FoodUserInformation;
    	    		$info->app_user_id = $user->id;
    	    		$info->address = $request->address;
    	    		$info->address_line = $request->address_line ?? null;
    	    		$info->city = $request->city;
    	    		$info->postcode = $request->postcode;
    	    		$info->save();
              $user->user_information = $info;
    	    		return response()->json(['status'=>true,'message'=>'Your profile has been updated.','payload'=>$user]);
    	    	}
    	    	else
    	    	{
    	    		return response()->json(['status'=>false,'message'=>'Something error while updating your profile! Try after some time.']);
    	    	}
        	}
        else:
          return response()->json(['status'=>false,'message'=>'No user found.']);
        endif;
    }

    public function forgot_password(Request $request)
    {
      $validator = Validator::make($request->all(), ['email'=>'required|email']);
      if ($validator->fails()):
        return response()->json(['status' => false,'message' => $validator->errors()->first()]);
      endif;
      $user = FoodAppUser::whereEmail($request->email)->first();
      if(!is_null($user)):
        $otp = FoodOtp::whereAppUserId($user->id)->first();
        if(!is_null($otp)):
          $otp->app_user_id =  $request->app_user_id;
          $otp->expire_at = Carbon::now()->addMinutes(5);
          $otp->code = mt_rand(100000,999999);
          if($otp->save()):
            Mail::to($request->email)->send(new FoodSendOtp($otp));
            return response()->json(['status' => true,'message' => 'OTP sent to your mail.','payload'=>$user->id]);
          else:
            return response()->json(['status' => false,'message' => 'Something problem when generating otp.']);
          endif;
        else:
          $otp = new FoodOtp;
          $otp->app_user_id	 = $user->id;
          $otp->expire_at = Carbon::now()->addMinutes(5);
          $otp->code = mt_rand(100000,999999);
          if($otp->save()):
            Mail::to($request->email)->send(new FoodSendOtp($otp));
            return response()->json(['' => true,'message' => 'OTP sent to your mail.','payload'=>$user->id]);
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
        $validator = Validator::make($request->all(), ['otp'=>'required|integer','app_user_id'=>'required|integer']);
        if ($validator->fails()):
          return response()->json(['status' => false,'message' => $validator->errors()->first()]);
        endif;
        $user = FoodAppUser::find($request->app_user_id);
        if(!is_null($user)):
          $otp = FoodOtp::whereCode($request->otp)->whereAppUserId($user->id)->first();
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

    public function remove_account(Request $request)
    {
      $validator = Validator::make($request->all(), ['device_id'=>'required']);
      if ($validator->fails()):
        return response()->json(['status' => false,'message' => $validator->errors()->first()]);
      endif;

        $user = FoodAppUser::find(Auth::guard('food_app_user_api')->user()->id);
        if(!is_null($user)):
          // $user->save();
          FoodAppUser::where('id',$user->id)->delete();
          FoodCart::where('app_user_id',$user->id)->delete();
          
          return response()->json(['status'=>true,'message'=>'Your account has been deleted.']);
        else:
          return response()->json(['status'=>false,'message'=>'User not found.']);
        endif;

    }

}
