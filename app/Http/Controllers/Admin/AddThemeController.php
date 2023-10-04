<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ThemeTemplate;
use App\ThemeCategory;
use image;
use Session;

class AddThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themecategories = ThemeCategory::get();
        return view('admin.super_admin.add_themes',compact('themecategories'));
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

        $this->validate($request,[
            'theme_name'=>'required|string|max:255|unique:theme_templates',
        ]);

        $data = array();
        $data['theme_name'] = $request->theme_name;
        $data['slug'] = $request->slug;
        $code = $this->genrate_code();
        $data['theme_code'] = $request->slug.'_'.$code;
        $data['theme_details'] = $request->theme_details;
        $data['category_id'] = $request->category_id;
        
        $theme_thumbnail = $request->file('theme_thumbnail');

        if ($theme_thumbnail) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($theme_thumbnail->getClientOriginalExtension());
            $image_full_name = 'img_'.$image_name.'.'.$ext;
            $upload_path = 'media/';
            $image_url = $upload_path.$image_full_name;
            $success = $theme_thumbnail->move($upload_path,$image_full_name);
            $data['theme_thumbnail'] = $image_url;
        }

        $theme_screenshots = $request->file('theme_screenshots');

        if($theme_screenshots)
        {
            foreach($theme_screenshots as $item)
            {
                $var = date_create();
                $time = date_format($var, 'YmdHis');
                $imageName = $time . '-' . $item->getClientOriginalName();
                $item->move('media/', $imageName);
                $arr[] = $imageName;
            }
            $data['theme_screenshots'] = implode(",", $arr);
       }
       $data['monthly_gbp'] = $request->monthly_gbp;
       $data['yearly_gbp'] = $request->yearly_gbp;
       $data['monthly_usd'] = $request->monthly_usd;
       $data['yearly_usd'] = $request->yearly_usd;

       $theme_template = ThemeTemplate::create($data);

       Session::flash('statuscode','info');
       return redirect('addtheme')->with('status','Template is Added');

    }

    public function genrate_code(){
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";
        for ($i = 0; $i < 6; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return $res;
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
