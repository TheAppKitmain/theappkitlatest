<?php

namespace App\Http\Controllers\Admin\Template\Meal_Prep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usertheme;
use App\Models\Template\E_Commerce\AppSetting;
use App\ThemeTemplate;
use Session;
use Auth;

class TypographyController extends Controller
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

        if(session('theme_id') != null){

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $appsetting = AppSetting::where('user_id', $id)->where('template_id', $template_id)->first();
        return view('admin.template.E_Commerce.branding', compact('themetemplate','appsetting'));
        
        }
        else{
            Auth::logout();
            return redirect('login');
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
        
        $template_id = session('theme_id');

        $exists = AppSetting::where('user_id',$request->user_id)->where('template_id', $template_id)->first();

        if(!is_null($exists))
        {
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['template_id'] = $request->template_id;
        $data['theme_name'] = $request->template_name;
        $data['nav_bg_color'] = $request->nav_bg_color;
        $data['nav_heading_color'] = $request->nav_heading_color;
        $data['nav_heading_font'] = $request->nav_heading_font;
        $data['heading_color'] = $request->heading_color;
        $data['heading_font'] = $request->heading_font;
        $data['sub_heading_color'] = $request->sub_heading_color;
        $data['sub_heading_font'] = $request->sub_heading_font;
        $data['paragraph_color'] = $request->paragraph_color;
        $data['paragraph_font'] = $request->paragraph_font;
        $data['primary_btn_color'] = $request->primary_btn_color;
        $data['primary_btn_font'] = $request->primary_btn_font;
        $data['primary_btnbg_color'] = $request->primary_btnbg_color;
        $data['success_btn_color'] = $request->success_btn_color;   
        $data['success_btn_font'] = $request->success_btn_font;
        $data['success_btnbg_color'] = $request->success_btnbg_color;
        $data['danger_btn_color'] = $request->danger_btn_color;
        $data['danger_btn_font'] = $request->danger_btn_font;   
        $data['danger_btnbg_color'] = $request->danger_btnbg_color;
        $data['screen_bg_color'] = $request->screen_bg_color;
        $typography = AppSetting::where('user_id',$request->user_id)->where('template_id', $template_id)->update($data);

        }
        else
        {
            $data = array();
            $data['user_id'] = $request->user_id;
            $data['template_id'] = $request->template_id;
            $data['theme_name'] = $request->template_name;
            $data['nav_bg_color'] = $request->nav_bg_color;
            $data['nav_heading_color'] = $request->nav_heading_color;
            $data['nav_heading_font'] = $request->nav_heading_font;
            $data['heading_color'] = $request->heading_color;
            $data['heading_font'] = $request->heading_font;
            $data['sub_heading_color'] = $request->sub_heading_color;
            $data['sub_heading_font'] = $request->sub_heading_font;
            $data['paragraph_color'] = $request->paragraph_color;
            $data['paragraph_font'] = $request->paragraph_font;
            $data['primary_btn_color'] = $request->primary_btn_color;
            $data['primary_btn_font'] = $request->primary_btn_font;
            $data['primary_btnbg_color'] = $request->primary_btnbg_color;
            $data['success_btn_color'] = $request->success_btn_color;   
            $data['success_btn_font'] = $request->success_btn_font;
            $data['success_btnbg_color'] = $request->success_btnbg_color;
            $data['danger_btn_color'] = $request->danger_btn_color;
            $data['danger_btn_font'] = $request->danger_btn_font;   
            $data['danger_btnbg_color'] = $request->danger_btnbg_color;
            $data['screen_bg_color'] = $request->screen_bg_color;
            $typography = AppSetting::create($data);
        }

        session::flash('statuscode','info');
        return redirect('theme/branding')->with('status','App Setting is Added');
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
