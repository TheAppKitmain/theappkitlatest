<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Usertheme;
use App\ThemeTemplate;
use App\Models\Template\E_Commerce\E_Commerce_Owner;
use App\Models\Template\E_Commerce\E_commerce_theme;
use App\Otp;
use App\Mail\UserRegisterMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyYourAccount;
use Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;


class OtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $otp = session()->get('otp_code');
        if(!empty($otp)){
          return view ('appkit.otp'); 
        }else{
          return redirect()->route('myhome');
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
        //
    }
    

    public function user_otp(Request $request)
    {
      //dd($request->all());
      $otp = session()->get('otp_code');
        if(!empty($otp)){
          $otp_chck =  $request->otp;
      if($otp == $otp_chck){
        $expire_at = session()->get('expire_at');
        if(Carbon::now() > $expire_at){
            return back()->with(['alert'=>'danger','message'=>'OTP Expired']);
        }
        else 
        {
           $business_name = session()->get('business_name');
           $first_name = session()->get('first_name');
           $last_name = session()->get('last_name');
           $number = session()->get('number');
           $email = session()->get('email');
           $referred_by = session()->get('referred_by');
           $password = session()->get('password');
           $country = session()->get('country');
           $role_id = session()->get('role_id');
           $template_id = session()->get('template_id');
           $category_id = session()->get('category_id');
           $template_name = session()->get('template_name');
           $user_type = session()->get('user_type');
           $slug = session()->get('slug');

          if($user_type=='template')
          {
            $user = new User;
            $user->business_name = $business_name;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $email;
            $user->number = $number;
            $user->country = $country;
            $user->referred_by = $referred_by;
            $user->user_type = $user_type;
            $user->role_id = $role_id;
            $user->password = Hash::make($password);
            $user->is_email_verified = 1;
            $user->save();

            $e_Commerce_Owner = new E_Commerce_Owner;
            $e_Commerce_Owner->owner_id = $user->id;
            $e_Commerce_Owner->busniess_name = $business_name;
            $e_Commerce_Owner->email = $email;
            $e_Commerce_Owner->save();

            $e_commerce_theme = new E_commerce_theme;
            $e_commerce_theme->owner_id = $user->id;
            $e_commerce_theme->template_name = $template_name;
            $e_commerce_theme->template_id = $template_id;
            $e_commerce_theme->save();

            $usertheme = new Usertheme;
            $usertheme->user_id = $user->id;
            $usertheme->template_id = $template_id;
            $usertheme->user_category = $category_id;
            $usertheme->user_template = $template_name;

            if($usertheme->save())
              {
                $bugstatus['business_name'] = $business_name;
                $bugstatus['first_name'] = $first_name;
                $bugstatus['last_name'] = $last_name;
                $bugstatus['email'] = $email;
                $bugstatus['user_type'] = $user_type;

                Mail::to('support@theappkit.co.uk')->send(new UserRegisterMail($bugstatus));
                // Mail::to('sameer.ece564@gmail.com')->send(new UserRegisterMail($bugstatus));
                // Mail::to('admin@smartitventures.com')->send(new UserRegisterMail($bugstatus));   
                // Mail::to('support@theappkit.co.uk')->send(new UserRegisterMail($bugstatus));

                  if(auth()->attempt(array('email' => $email, 'password' => $password)))
                    {
                      return redirect('dashboard');
                    } 
                    else
                    {
                      return back()->with(['alert'=>'danger','message'=>'Something went wrong']);
                    }
              }
                    else
                    {
                        return back()->with(['alert'=>'danger','message'=>'Something went wrong']);
                    }
          }
          elseif($user_type=='shopify')
          {
            $user = new User;
            $user->business_name = $business_name;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $email;
            $user->number = $number;
            $user->country = $country;
            $user->referred_by = $referred_by;
            $user->user_type = $user_type;
            $user->role_id = $role_id;
            $user->password = Hash::make($password);
            $user->is_email_verified = 1;
            if($user->save())
            {
                $bugstatus['business_name'] = $business_name;
                $bugstatus['first_name'] = $first_name;
                $bugstatus['last_name'] = $last_name;
                $bugstatus['email'] = $email;
                $bugstatus['user_type'] = $user_type;

                Mail::to('support@theappkit.co.uk')->send(new UserRegisterMail($bugstatus));
                // Mail::to('sameer.ece564@gmail.com')->send(new UserRegisterMail($bugstatus));
                // Mail::to('admin@smartitventures.com')->send(new UserRegisterMail($bugstatus));   
                // Mail::to('support@theappkit.co.uk')->send(new UserRegisterMail($bugstatus));
                
                if(auth()->attempt(array('email' => $email, 'password' => $password)))
                  {
                    return redirect('shopify_page');
                  } 
                  else
                  {
                    return back()->with(['alert'=>'danger','message'=>'Something went wrong']);
                  }
            }
                  else
                  {
                      return back()->with(['alert'=>'danger','message'=>'Something went wrong']);
                  }
          }

          else{
              $user = new User;
              $user->business_name = $business_name;
              $user->first_name = $first_name;
              $user->last_name = $last_name;
              $user->email = $email;
              $user->number = $number;
              $user->country = $country;
              $user->referred_by = $referred_by;
              $user->user_type = $user_type;
              $user->role_id = $role_id;
              $user->password = Hash::make($password);
              $user->is_email_verified = 1;
              if($user->save())
              {
                $bugstatus['business_name'] = $business_name;
                $bugstatus['first_name'] = $first_name;
                $bugstatus['last_name'] = $last_name;
                $bugstatus['email'] = $email;
                $bugstatus['user_type'] = $user_type;

                Mail::to('support@theappkit.co.uk')->send(new UserRegisterMail($bugstatus));
                //Mail::to('support@theappkit.co.uk')->send(new UserRegisterMail($bugstatus));

                  if(auth()->attempt(array('email' => $email, 'password' => $password)))
                    {
                      return redirect('/app/aboutapp');
                    } 
                    else
                    {
                      return back()->with(['alert'=>'danger','message'=>'Something went wrong']);
                    }
              }
                    else
                    {
                        return back()->with(['alert'=>'danger','message'=>'Something went wrong']);
                    }
          }
        }
      }
      else
      {
        return back()->with(['alert'=>'danger','message'=>'OTP not matched']); 
      } 
        }else{
          return redirect()->route('myhome');
        }
    }


    public function otp_resend()
    {
        $expire_at = Carbon::now()->addMinutes(5);
        $code = mt_rand(100000,999999);
        session()->put('expire_at', $expire_at);
        session()->put('otp_code', $code);
        $email = session()->get('email');
        Mail::to($email)->send(new VerifyYourAccount($code));
        return back()->with(['alert'=>'danger','message'=>'OTP sent successfully']);
    }



   public function user_register(Request $request)
   {
      $request['number'] = '+'.$request->phone_number_phoneCode.''.$request->phone_number;
       $this->validate($request,[
          'business_name' => ['required', 'string'],
          'first_name' => ['required', 'string', 'max:255'],
          'number' => ['required','unique:users'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],  
          'password' => ['required', 'string', 'min:8'],
          'country' => ['required',],
          // 'g-recaptcha-response' => ['required','captcha'],
        ]);

        session()->put('business_name', $request->business_name);
        session()->put('first_name', $request->first_name);
        session()->put('last_name', $request->last_name);
        session()->put('number', $request['number']);
        session()->put('email', $request->email);
        session()->put('password', $request->password);
        session()->put('referred_by', $request->referred_by);
        session()->put('country', $request->country);
        session()->put('user_type', $request->user_type);
        session()->put('template_id', $request->template_id);
        session()->put('category_id', $request->category_id);
        session()->put('template_name', $request->template_name);
        session()->put('role_id', $request->role_id);
        session()->put('slug', $request->slug);

        $expire_at = Carbon::now()->addMinutes(5);
        $code = mt_rand(100000,999999);
        session()->put('expire_at', $expire_at);
        session()->put('otp_code', $code);
        Mail::to($request->email)->send(new VerifyYourAccount($code));
        return redirect('otp');
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
}
