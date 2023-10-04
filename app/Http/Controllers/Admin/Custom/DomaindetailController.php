<?php

namespace App\Http\Controllers\Admin\Custom;

use App\Http\Controllers\Controller;
use App\Domaindetail;
use Illuminate\Http\Request;
use Session;

class DomaindetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_id = session('app_id');
        if($app_id == 0){
            return redirect()->route('app.aboutapp.index')->with('status','Please Add App first');
        }
        else
        {
            $domain_detail = Domaindetail::where('app_id',$app_id)->first();
            return view("admin.custom.domaindetail",compact('domain_detail'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view("admin.aboutapp");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['app_id'] = $request->app_id;
        $data['domain_details'] = $request->domain_details;
        $data['domain_provider'] = $request->domain_provider;
        $data['domain_email'] = $request->domain_email;
        $data['domain_password'] = $request->domain_password;
        if($data['app_id'] == 0){
            return redirect()->route('app/appstore')->with('status','Please Add App first');
        }
        else
        {
            if( !empty($data['domain_details'])  || !empty($data['domain_provider']) ||  !empty($data['domain_email']) ||  !empty($data['domain_password'])){
                $domain = Domaindetail::create($data);
                session::flash('statuscode','info');
                return back()->with('status','Submitted');
            }
            else
            {
                session::flash('statuscode','error');
                return back()->with('status','Please fill some data');
            }
            
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
        $domain_detail = Domaindetail::find($id);
        return view("admin.custom.domaindetail",compact('domain_detail'));
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
    public function update(Request $request, $id){
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['app_id'] = $request->app_id;
        $data['domain_details'] = $request->domain_details;
        $data['domain_provider'] = $request->domain_provider;
        $data['domain_email'] = $request->domain_email;
        $data['domain_password'] = $request->domain_password;
        if( !empty($data['domain_details'])  || !empty($data['domain_provider']) ||  !empty($data['domain_email']) ||  !empty($data['domain_password'])){
            $domain = Domaindetail::where('id',$id)->update($data);
            session::flash('statuscode','info');
            return back()->with('status','Submitted');
        }
        else
        {
            session::flash('statuscode','error');
            return back()->with('status','Please fill some data');
        }
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
