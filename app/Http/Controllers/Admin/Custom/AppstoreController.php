<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appstore;
use App\StoreInformation;
use Session;

class AppstoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){  
        $app_id = session('app_id');
        if($app_id == 0){
            return redirect()->route('app.aboutapp.index')->with('status','Please Add App first');
        } else {
            $app_id = session('app_id');
            $store = Appstore::where('app_id',$app_id)->where('user_id',auth()->user()->id)->first();
            return view("admin.custom.appstore",compact('store'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $app_id = session('app_id');
        if($app_id == 0){
            return redirect()->route('app.aboutapp.index')->with('status','Please Add App first');
        } else {
            $app_id = session('app_id');
            $store = StoreInformation::where('app_id',$app_id)->where('user_id',auth()->user()->id)->first();
            return view("admin.custom.store_information",compact('store'));
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
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['done_ios'] = $request->done_ios;
        $data['done_android'] = $request->done_android;
        $data['app_id'] = session('app_id');
        $store = Appstore::where('app_id',$data['app_id'])->where('user_id',auth()->user()->id)->first();
         if(!is_null($store))
         {
            if($data['done_ios'])
            {
                $appstore = Appstore::where('id',$store->id)->where('user_id',$data['user_id'])->update(['done_ios'=>$data['done_ios']]);
            }
            if($data['done_android'])
            {
                $appstore = Appstore::where('id',$store->id)->where('user_id',$data['user_id'])->update(['done_android'=>$data['done_android']]);
            }
            session::flash('statuscode','info');
            return redirect('app/appstore')->with('status','Access provided');
         }
         else
         {
            $appstore = Appstore::create($data);
            session::flash('statuscode','info');
            return redirect('app/appstore')->with('status','Access provided');
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
