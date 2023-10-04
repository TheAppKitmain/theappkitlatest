<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use DB;
use App\Usertheme;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    public $successStatus = 200;
    
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['status'=>true,'login_data' => $success], $this->successStatus);
        }
        else {
            return response()->json(['status'=>false,
            'login_data' =>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {

        $this->validate($request,[
            'business_name' => ['required', 'string', 'max:255','unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'country' => ['required',],
        ]);

        $user =  User::create([
            'business_name' => $request['business_name'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'number' => '+'.$request['phone_number_phoneCode'].''.$request['phone_number'],
            'email' => $request['email'],
            'country' => $request['country'],
            'user_type' => $request['user_type'],
            'role_id' => $request['role_id'],
            'password' => Hash::make($request['password']),
        ]);

        $user_id =  DB::getPdo()->lastInsertId();
        \App\Usertheme::create([
            'user_id' => $user_id,
            'user_template' => $request['template_name'],
        ]);
        return response()->json([
            "message" => "User record created"
        ], 200);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function index()
    {
       $user = User::all();
       return response()->json(['success' => $user], $this->successStatus);
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        if($user)
           $user->delete();
        else
            return response()->json(error);
        return response()->json(null);
    }

}
