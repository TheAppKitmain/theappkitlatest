<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OurWork;
use Session;

class OurWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $ourworks = OurWork::orderBy('id','asc')->paginate(5);
        return view("admin.super_admin.our_work.index",compact('ourworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ourwork = OurWork::orderBy('id','asc')->get();
        return view("admin.super_admin.our_work.create",compact('ourwork'));
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
            'app_name'=>'required|string|max:255'
        ]);

        $data = array();
        $data['app_name'] = $request->app_name;
        
        $app_logo = $request->file('app_logo');

        if ($app_logo) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($app_logo->getClientOriginalExtension());
            $image_full_name = 'img_'.$image_name.'.'.$ext;
            $upload_path = 'media/';
            $image_url = $upload_path.$image_full_name;
            $success = $app_logo->move($upload_path,$image_full_name);
            $data['app_logo'] = $image_url;
        }

        $app_screenshots = $request->file('app_screenshots');

        if($app_screenshots)
        {
            foreach($app_screenshots as $item)
            {
                $var = date_create();
                $time = date_format($var, 'YmdHis');
                $imageName = $time . '-' . $item->getClientOriginalName();
                $item->move('media/', $imageName);
                $arr[] = $imageName;
            }
            $data['app_screenshots'] = implode(",", $arr);
       }

       $data['app_type'] = $request->app_type;
       $data['client_name'] = $request->client_name;
       $data['app_links'] = $request->app_links;
       $data['client_designation'] = $request->client_designation;
       $data['app_android_link'] = $request->app_android_link;
       $data['app_reviews'] = $request->app_reviews;

       $our_work = OurWork::create($data);

       Session::flash('statuscode','info');
       return redirect('our_work')->with('status','Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $our_work = OurWork::find($id);
        return view("admin.super_admin.our_work.edit",compact('our_work'));
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
        $this->validate($request,[
            'app_name'=>'required|string|max:255'
        ]);

        $data = array();
        $data['app_name'] = $request->app_name;
        
        $app_logo = $request->file('app_logo');

        if ($app_logo) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($app_logo->getClientOriginalExtension());
            $image_full_name = 'img_'.$image_name.'.'.$ext;
            $upload_path = 'media/';
            $image_url = $upload_path.$image_full_name;
            $success = $app_logo->move($upload_path,$image_full_name);
            $data['app_logo'] = $image_url;
        }

        $app_screenshots = $request->file('app_screenshots');

        if($app_screenshots)
        {
            foreach($app_screenshots as $item)
            {
                $var = date_create();
                $time = date_format($var, 'YmdHis');
                $imageName = $time . '-' . $item->getClientOriginalName();
                $item->move('media/', $imageName);
                $arr[] = $imageName;
            }
            $data['app_screenshots'] = implode(",", $arr);
       }

       $data['app_type'] = $request->app_type;
       $data['client_name'] = $request->client_name;
       $data['app_links'] = $request->app_links;
       $data['app_reviews'] = $request->app_reviews;
       $data['app_android_link'] = $request->app_android_link;
       $data['app_reviews'] = $request->app_reviews;

       $our_work = OurWork::where('id',$id)->update($data);

       Session::flash('statuscode','info');
       return redirect('our_work')->with('status','Submitted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = OurWork::find($id);
        if(!is_null($post))
        {
            $post->delete(); 
            return redirect()->route('our_work.index')->with(['alert'=>'success','heading'=>'Well done!','message'=>'App has been deleted successfully!.']);
        }
        else
        {
            return redirect()->route('our_work.index')->with(['alert'=>'danger','heading'=>'Oops!','message'=>'App has not been deleted!.']);  
        }
    }
}
