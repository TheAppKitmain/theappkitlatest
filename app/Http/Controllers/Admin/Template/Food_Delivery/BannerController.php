<?php

namespace App\Http\Controllers\Admin\Template\Food_Delivery;

use App\Http\Controllers\Controller;
use App\Models\Template\Food_Delivery\FoodBanner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\ThemeTemplate;
use Image;
use Auth;
use Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function banner(Request $request)
    {
        if($request->isMethod('get')):

        $id = auth()->user()->id;
        $template_id = session('theme_id');

        if(session('theme_id') != null){

        $themetemplate = ThemeTemplate::where('id', $template_id)->first();
        $banners = FoodBanner::orderBy('position','asc')->where('owner_id', $id)->where('template_id', $template_id)->get();

        }
        else{
            Auth::logout();
            return redirect('login');
        }
        return view('admin.template.Food_Delivery.banner',compact('banners','themetemplate'));

        endif;

        if($request->isMethod('post')):
            $banner = new FoodBanner;
            $banner->owner_id = $request->user_id;
            $banner->template_id = $request->template_id;
            $banner->name = $request->name;
            $image = $request->file('banner');
                if($image)
                {
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $image_full_name = 'img_'.$name;
                    $filePath = 'theappkit/theappkitproject/Template/Ecommerce/Wardrobes/' . $image_full_name;
                    Storage::disk('s3')->put($filePath, file_get_contents($image));
                    $url = config('services.base_url')."/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/".$image_full_name;
                    $banner->banner = $url;
                }
            $banner->status = $request->status;
            if($banner->save())
            {
                session::flash('statuscode','info');
                return back()->with('status','Banner has been created!.');
              
            }
            else
            {
                session::flash('statuscode','info');
                return back()->with('status','Banner has not been created!.');
            }
        endif;

        if($request->isMethod('delete')):
            $banner = FoodBanner::find($request->id);
            if(!is_null($banner))
            {
                $banner->delete();
                session::flash('statuscode','error');
                return back()->with('status','Banner has been removed successfully!.');

            }
            else
            {
                session::flash('statuscode','error');
                return back()->with('status','Banner has been not removed successfully!.');
            }
            
        endif;



        if($request->isMethod('put')):

            $banner = FoodBanner::find($request->id);

            if(!is_null($banner))
            {
                $banner->position = $request->position;
                $banner->save();
                session::flash('statuscode','info');
                return back()->with(['success','Banner has been updated successfully!.']);
            }
            else
            {
                session::flash('statuscode','info');
                return back()->with(['Banner has not been updated!.']);  
            }
        endif;

    }

    public function position(Request $request, $id)
    {
        $banner = FoodBanner::find($id);

        if(!is_null($banner))
        {
            $banner->position = $request->position;
            $banner->save();

            session::flash('statuscode','info');
            return back()->with(['status','Banner has been updated successfully!.']);
 
        }
        else
        {
            session::flash('statuscode','info');
            return back()->with(['status','Banner has not been updated!.']);  
        }


    }

    public function delete(Request $request, $id)
    {
        $banner = FoodBanner::find($id);
        if(!is_null($banner))
        {
            $banner->delete();
            session::flash('statuscode','error');
            return back()->with('status','Banner has been removed successfully!.');

        }
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Banner has been not removed successfully!.');
        }
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
