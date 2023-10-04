<?php

namespace App\Http\Controllers\Admin\Template\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usertheme;
use App\Models\Template\E_Commerce\SplashScreen;
use App\Models\Template\E_Commerce\EcommerceCollection;
use App\Models\Template\E_Commerce\TempLoginSetting;
use App\Models\Template\E_Commerce\TempSignupSetting;
use App\Models\Template\E_Commerce\ProductCategory;
use App\Models\Template\E_Commerce\AppSetting;
use App\Models\Template\E_Commerce\Shipping;
use App\Models\Template\E_Commerce\Product;
use Illuminate\Support\Facades\Storage;
use Image;
use App\ThemeTemplate;
use Auth;
use DB;
use Session;

class TemplateSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $id = auth()->user()->id;

        $template_id = session('theme_id');

        $theme_code = session('theme_code');

        if(session('theme_id') != null){

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $splashscreen = SplashScreen::where('user_id', $id)->where('template_id', $template_id)->first();
        $temploginsetting = TempLoginSetting::where('user_id', $id)->where('template_id', $template_id)->first();
        $tempsignupsetting = TempSignupSetting::where('user_id', $id)->where('template_id', $template_id)->first();
        $collections = EcommerceCollection::where('user_id', $id)->where('template_id', $template_id)->orderBy('id', 'ASC')->get();
        $products = Product::with('get_collection_name')->where('user_id', $id)->where('template_id', $template_id)->get();

        }
        else{
            Auth::logout();
            return redirect('login');
        }

        if($theme_code == 'car-wash_13MZEO'){

            return view('admin.template.Booking.themes.car_wash',compact('splashscreen','themetemplate','temploginsetting','products','collections','tempsignupsetting'));
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

    public function splash_screen (Request $request)
    {
        $request['template_id'] = session('theme_id');
        $exists = SplashScreen::where('user_id',$request->user_id)->where('template_id', $request->template_id)->first();
        if(!is_null($exists)){

            $data = array();
            $data['user_id'] = $request->user_id;
            $data['template_name'] = $request->template_name;
            $data['template_id'] = $request->template_id;
            $data['splash_background_color'] = $request->splash_bg_color;
            $splash_logo = $request->file('splash_logo');
            if($splash_logo){

            $name = time().'.'.$splash_logo->getClientOriginalExtension();
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($splash_logo));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
            $data['splash_logo'] = $url;

            }
            $splash_background_image = $request->file('splash_background_image');

            if($splash_background_image){

                $name = time().'.'.$splash_background_image->getClientOriginalExtension();
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($splash_background_image));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
                $data['splash_background_image'] = $url;

            }
            $splashscreen = SplashScreen::where('user_id',$request->user_id)->where('template_id', $request->template_id)->update($data);

            if($splashscreen){

                $success = true;
                $message = "Submitted";
            }
            else
            {
                $success = false;
                $message = "Something went wrong";
            }
            return response()->json(['success' => $success,'message' => $message,]);
        }
        else
        {
            $data = array();
            $data['user_id'] = $request->user_id;
            $data['template_name'] = $request->template_name;
            $data['template_id'] = $request->template_id;
            $data['splash_background_color'] = $request->splash_bg_color;
            $splash_logo = $request->file('splash_logo');
            if($splash_logo){

                $name = time().'.'.$splash_logo->getClientOriginalExtension();
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($splash_logo));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
                $data['splash_logo'] = $url;

            }

            $splash_background_image = $request->file('splash_background_image');
            if($splash_background_image)
            {
                $name = time().'.'.$splash_background_image->getClientOriginalExtension();
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($splash_background_image));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
                $data['splash_background_image'] = $url;
            }

            $splashscreen = SplashScreen::create($data);
            if(!is_null($splashscreen)){
                 $success = true;
                $message = "Submitted";
            }
            else
            {
                $success = false;
                $message = "Something went wrong";
            }
            return response()->json(['success' => $success,'message' => $message]);
        }
    }


    public function login_screen (Request $request){
        $exists = TempLoginSetting::where('user_id',$request->user_id)->where('template_id', $request->template_id)->first();
        if(!is_null($exists)){
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['template_id'] = $request->template_id;
        $data['login_bg_color'] = $request->login_bg_color;
        $data['login_btn_color'] = $request->login_btn_color;
        $data['login_btn_font_size'] = $request->login_btn_font_size;

        $login_bg_image = $request->file('login_bg_image');

        if($login_bg_image)
        {
                $name = time().'.'.$login_bg_image->getClientOriginalExtension();
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($login_bg_image));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
                $data['login_bg_image'] = $url;
        }

        $login_screen = TempLoginSetting::where('user_id',$request->user_id)->where('template_id', $request->template_id)->update($data);

        if($login_screen){
            $success = true;
            $message = "Submitted";
        }
        else
        {
            $success = false;
            $message = "Something went wrong";
        }
        return response()->json(['success' => $success,'message' => $message]);

        }

        else{

        $data = array();
        $data['user_id'] = $request->user_id;
        $data['template_id'] = $request->template_id;
        $data['login_bg_image'] = $request->login_bg_image;
        $data['login_bg_color'] = $request->login_bg_color;
        $data['login_btn_color'] = $request->login_btn_color;
        $data['login_btn_font_size'] = $request->login_btn_font_size;

        $login_bg_image = $request->file('login_bg_image');

        if($login_bg_image)
        {
            $name = time().'.'.$login_bg_image->getClientOriginalExtension();
            $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($login_bg_image));
            $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
            $data['login_bg_image'] = $url;
        }

        $login_screen = TempLoginSetting::create($data);

        if(!is_null($login_screen)){
            $success = true;
           $message = "Submitted";
       }
       else
       {
           $success = false;
           $message = "Something went wrong";
       }
       return response()->json(['success' => $success,'message' => $message]);

        }

    }


    public function signup_screen (Request $request)
    {


        $exists = TempSignupSetting::where('user_id',$request->user_id)->where('template_id', $request->template_id)->first();

        if(!is_null($exists))
        {
            $data = array();
            $data['user_id'] = $request->user_id;
            $data['template_id'] = $request->template_id;
            $data['signup_bg_color'] = $request->signup_bg_color;
            $data['signup_btn_color'] = $request->signup_btn_color;
            $data['signup_btn_font_size'] = $request->signup_btn_font_size;

            if(isset($request->signup_status)){

                $data['status'] = $request->signup_status;

            }else{

                $data['status'] = 0 ;
            }
            $signup_bg_image = $request->file('signup_bg_image');

            if($signup_bg_image)
            {
                $name = time().'.'.$signup_bg_image->getClientOriginalExtension();
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($signup_bg_image));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
                $data['signup_bg_image'] = $url;
            }

            $signup_screen = TempSignupSetting::where('user_id',$request->user_id)->where('template_id', $request->template_id)->update($data);

            if($signup_screen){
                $success = true;
                $message = "Submitted";
            }
            else
            {
                $success = false;
                $message = "Something went wrong";
            }

            return response()->json(['success' => $success,'message' => $message]);

        }

        else
        {

            $data = array();
            $data['user_id'] = $request->user_id;
            $data['template_id'] = $request->template_id;
            $data['signup_bg_color'] = $request->signup_bg_color;
            $data['signup_btn_color'] = $request->signup_btn_color;
            $data['signup_btn_font_size'] = $request->signup_btn_font_size;

            if(isset($request->signup_status)){

                $data['status'] = $request->signup_status;

            }else{

                $data['status'] = 0 ;
            }

            $signup_bg_image = $request->file('signup_bg_image');

            if($signup_bg_image)
            {
                $name = time().'.'.$signup_bg_image->getClientOriginalExtension();
                $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($signup_bg_image));
                $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$name;
                $data['signup_bg_image'] = $url;
            }

            $signup_screen = TempSignupSetting::create($data);

            if(!is_null($signup_screen)){
                $success = true;
               $message = "Submitted";
           }
           else
           {
               $success = false;
               $message = "Something went wrong";
           }
           return response()->json(['success' => $success,'message' => $message]);
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
        $user_id = auth()->user()->id;
        $themetemplate = ThemeTemplate::where('id', $id)->first();
        session()->put('theme_id',$id);
        session()->put('theme_code',$themetemplate->theme_code);

        $splashscreen = SplashScreen::where('user_id', $user_id)->where('template_id', $id)->first();

        $temploginsetting = TempLoginSetting::where('user_id', $user_id)->where('template_id', $id)->first();
        $tempsignupsetting = TempSignupSetting::where('user_id', $user_id)->where('template_id', $id)->first();

        $collections = EcommerceCollection::where('user_id', $user_id)->where('template_id', $id)->orderBy('id', 'ASC')->get();
        $products = Product::with('get_collection_name')->where('user_id', $user_id)->where('template_id', $id)->get();

        if($themetemplate->theme_code == 'car-wash_13MZEO'){
            return view('admin.template.Booking.themes.car_wash',compact('splashscreen','themetemplate','temploginsetting','products','collections','tempsignupsetting'));
        }

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
        $usertheme = Usertheme::where('template_id', $id)->delete();
        $ecommerceCollection = EcommerceCollection::where('template_id', $id)->delete();
        $product = Product::where('template_id', $id)->delete();
        $splashScreen = SplashScreen::where('template_id', $id)->delete();
        $tempLoginSetting = TempLoginSetting::where('template_id', $id)->delete();
        $AppSetting = AppSetting::where('template_id', $id)->delete();
        $Shipping = Shipping::where('template_id', $id)->delete();
        $tempSignupSetting = TempSignupSetting::where('template_id', $id)->delete();

        session::flash('statuscode','error');
        return back()->with('status','Theme is Deleted');
    }
}
