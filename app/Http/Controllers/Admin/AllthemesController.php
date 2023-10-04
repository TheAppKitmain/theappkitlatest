<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ThemeTemplate;
use App\ThemeCategory;
use Illuminate\Support\Facades\Storage;
use Session;
use App\User;
use Auth;

class AllthemesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
       // $user = User::where('id', $id)->first();  
        $themetemplates= ThemeTemplate::get();
        return view('admin.super_admin.all_themes', compact('themetemplates'));
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
        $themetemplates= ThemeTemplate::where('user_id', $id)->get();
        return $themetemplates;
        return view('admin.super_admin.all_themes', compact('themetemplates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $themecategories = ThemeCategory::get();
        $themetemplates= ThemeTemplate::find($id);
        return view('admin.super_admin.themeedit', compact('themetemplates','themecategories'));
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
        // $this->validate($request,[
        //     'theme_name'=>'required|string|max:255|unique:theme_templates',
        // ]);

        $data = array();
        $data['theme_name'] = $request->theme_name;
        //$data['slug'] = $request->slug;
        $data['theme_details'] = $request->theme_details;
        $data['theme_code'] = $request->theme_code;
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


    //     $theme_thumbnail = $request->file('theme_thumbnail');

    //     if($theme_thumbnail)
    //     {
    //         $name = time().'.'.$theme_thumbnail->getClientOriginalExtension();
    //         $image_full_name = 'img_'.$name;
    //         $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/'.$image_full_name;
    //         Storage::disk('s3')->put($filePath, file_get_contents($theme_thumbnail));
    //         $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
    //         $data['theme_thumbnail'] = $url;
    //     }

    //     $theme_screenshots = $request->file('theme_screenshots');

    //     if($theme_screenshots)
    //     {
    //         foreach($theme_screenshots as $item)
    //         {
    //             $name = time().'.'.$item->getClientOriginalExtension();
    //             $image_full_name = 'img_'.$name;
    //             $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/'.$image_full_name;
    //             Storage::disk('s3')->put($filePath, file_get_contents($item));
    //             $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
    //             $arr[] = $item;
    //         }

    //         $data['theme_screenshots'] = implode(",", $arr);
    //    }

        




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

       $theme_template = ThemeTemplate::where('id',$id)->update($data);

       Session::flash('statuscode','info');
       return redirect('allthemes')->with('status','Template is Added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ThemeTemplate::where('id',$id)->delete();
        Session::flash('statuscode','info');
        return redirect('allthemes')->with('status','Template is Deleted');
    }
}
