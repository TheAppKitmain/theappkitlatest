<?php

namespace App\Http\Controllers;

use App\ThemeCategory;
use App\ThemeTemplate;
use Illuminate\Http\Request;
use Session;
use Auth;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template = ThemeTemplate::orderBy('position', 'asc')->get();

        foreach($template as $temp){
            $temp->img_arry = explode(",",$temp->theme_screenshots);
        }
            $themecategories = ThemeCategory::get();
        return view('appkit.theme',compact('themecategories','template'));
       
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
     * @param  \App\ThemeCategory  $theme
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $html=[];
        $templates = ThemeTemplate::where('category_id', $id)->get();
        if(count($templates)>0){
            foreach($templates as $data){
                $data->img_arry = explode(",",$data->theme_screenshots);
                
                $img = asset('media/'.$data->img_arry[0]);
                $name = $data->theme_name;
                $thumbnail = $data->theme_thumbnail;
                $id  = $data->id;
                $html[]='<div class="col-md-4 ourworkcol default_show"><a onClick="template_modal('.$id.')" class="tp-btn" href="#"><i class="fa fa-eye" aria-hidden="true"></i>Theme Preview</a><a href="#" onClick="template_modal('.$id.')" ><div class="our-work-img"><a href="#" onClick="template_modal('.$id.')"><img class="bgmb" src="'.$thumbnail.'" alt="right-mobile"><div class="hover-overlayer">'.$name.'</div></a></div></a></div>';
            }
        }
        return $html;
    }


/*    public function template_modal(Request $request)
    {
        $images=[];
        $template = ThemeTemplate::find($request->id);
        $imgs = explode(",",$template->theme_screenshots);
        if(count($imgs)>0){
            foreach($imgs as $img){
                $images[] = '<img class="appfrm" src="'.asset('media/'.$img).'"/>';
            }
        }
        $template_route = route('template',$template->slug);
        $goto_token_subdomain_route = route('goto_token_subdomain',$template->id);
        return array('theme_id'=>$template->id,'category_id'=>$template->category_id,'theme_name'=>$template->theme_name,'images'=>$images,'theme_slug'=>$template->slug,'theme_details'=>$template->theme_details,'template_route'=>$template_route,'subdomain_route'=>$goto_token_subdomain_route);
    }*/


    public function template_modal(Request $request){
        $template = ThemeTemplate::find($request->id);
        $imgs = explode(",",$template->theme_screenshots);
        $all_imgs = '';
        if(count($imgs)>0){
            foreach($imgs as $img){
               $singl_img = '<div class="theme-slide-itm"><img class="appfrm" src="'.asset('media/'.$img).'" alt=""></div>';
               $all_imgs .= $singl_img; 
            }
        }

        $template_route = route('template',$template->slug);
        $all_data = '';
        $all_data.='<div class="row"><div class="col-md-8"><div class="theme-show"><div id="theme-showcase" class="app-showcase-main owl-carousel">'.$all_imgs.'</div></div></div><div class="col-md-4"><div class="theme-right-text"><h4 class="theme_name">'.$template->theme_name.'</h4><p class ="theme_details">'.$template->theme_details.'</p></div><div class="text-left mt-20m"><form method="post" action="'.$template_route.'" id="templateForm"><input type="hidden" name="_token" value="'.csrf_token().'"><input type="hidden" name="theme_name" value="'.$template->theme_name.'"><input type="hidden" name="theme_id" value="'.$template->id.'"><input type="hidden" name="category_id" value="'.$template->category_id.'"><button class="btn btn-primary btn-select-theme">Customize Theme</button></form></div></div></div>';
        return $all_data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ThemeCategory  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(ThemeCategory $theme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ThemeCategory  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThemeCategory $theme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ThemeCategory  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThemeCategory $theme)
    {
        //
    }

    public function logout(Request $request) {

        Auth::logout();
        return redirect('/login');
    }
}
