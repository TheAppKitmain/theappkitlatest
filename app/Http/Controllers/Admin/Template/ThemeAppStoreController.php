<?php

namespace App\Http\Controllers\Admin\Template;

use App\Http\Controllers\Controller;
use App\Models\Template\TempAppStore;
use Illuminate\Http\Request;
use App\ThemeTemplate;
use Session;


class ThemeAppStoreController extends Controller
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
        $appstore = TempAppStore::where('user_id', $id)->where('template_id', $template_id)->first();

        return view('admin.template.themeappstore', compact('appstore'));
        
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
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['done_ios'] = $request->done_ios;
        $data['done_android'] = $request->done_android;
        $data['template_id'] = session('theme_id');

        $store = TempAppStore::where('template_id',$data['template_id'])->where('user_id',auth()->user()->id)->first();

         if(!is_null($store))
         {
            if($data['done_ios'])
            {
                $appstore = TempAppStore::where('id',$store->id)->where('user_id',$data['user_id'])->update(['done_ios'=>$data['done_ios']]);
            }
            if($data['done_android'])
            {
                $appstore = TempAppStore::where('id',$store->id)->where('user_id',$data['user_id'])->update(['done_android'=>$data['done_android']]);
            }
            session::flash('statuscode','info');
            return redirect('theme/appstore')->with('status','Access provided');
         }
         else
         {
            $appstore = TempAppStore::create($data);
            session::flash('statuscode','info');
            return redirect('theme/appstore')->with('status','Access provided');
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
