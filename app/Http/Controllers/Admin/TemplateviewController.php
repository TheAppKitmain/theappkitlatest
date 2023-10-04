<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\User;
use App\Usertheme;
use App\ThemeTemplate;
use App\Models\Template\E_Commerce\SplashScreen;
use App\Models\Template\E_Commerce\EcommerceCollection;
use App\Models\Template\E_Commerce\TempLoginSetting;
use App\Models\Template\E_Commerce\TempSignupSetting;
use App\Models\Template\E_Commerce\Product;
use App\Models\Template\E_Commerce\AppSetting;

use Auth;

class TemplateviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {  
        $user_id = Usertheme::get()->pluck('user_id');
        $users = User::whereIn('id',$user_id)->orderBy('id', 'DESC')->paginate(20);
        return view('admin.super_admin.template',compact('users'));   

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        if(is_null($user)){
            return back()->with('error','No User Found');
        } else {
            $template_id = Usertheme::where('user_id', $id)->pluck('template_id');
            $themetemplates = ThemeTemplate::whereIn('id', $template_id)->get();

            return view('admin.super_admin.user_temp',compact('themetemplates','user'));
        }
    }

    public function showuser_temp_data($id)
    {
        $user = User::where('id', $id)->first();  
        $template_id = Usertheme::where('user_id', $id)->pluck('template_id');
        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $splashscreen = SplashScreen::where('user_id', $id)->first();
        $appsetting = AppSetting::where('user_id', $id)->first();
        $products = Product::with('get_collection_name')->where('user_id', $id)->get();
        $collections = EcommerceCollection::where('user_id', $id)->get();  
        return view('admin.super_admin.template_view',compact('themetemplate','splashscreen','appsetting','products','collections','user'));
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
