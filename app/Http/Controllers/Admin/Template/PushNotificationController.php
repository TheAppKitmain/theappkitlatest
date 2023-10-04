<?php

namespace App\Http\Controllers\Admin\Template;

use App\Http\Controllers\Controller;
use App\Models\Template\E_Commerce\PushNotification;
use App\Models\Template\E_Commerce\AppUser;
use Illuminate\Http\Request;
use App\Models\Template\E_Commerce\EcommDeviceType;
use Session;

class PushNotificationController extends Controller
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

        $all_users  = AppUser::orderBy('id','desc')->where('owner_id', $id)->where('template_id', $template_id)->get();
        return view("admin.template.pushnotification",compact('all_users'));   

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
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function manage_notification(Request $request){

            if($request->select_user_type == 1){

                $all_users  = AppUser::orderBy('id','desc')->pluck('id');

                foreach ($all_users as $id) {

                return $user = AppUser::find($id);

                $device = EcommDeviceType::where('app_user_id',$user->id)->first();


                $registration_ids = $device->firebase_token;
                
                  
                  if(!is_null($registration_ids)){

                      $message = [ 
                          "to" => $registration_ids,
                          "priority" => 'high',
                          "sound" => 'default', 
                          "badge" => '1',
                          "notification" =>
                            [
                                "title" => $request->notif_title,
                                "body" => $request->notif_body,
                            ]
                        ];

                PushNotification::send($message);

                }
              }
              session::flash('statuscode','info');
              return back()->with('status','Notification is successfully sent');
            }

            else
            {


              $customer_ids = $request->select_customers;

              foreach ($customer_ids as $id) {

                  $user = AppUser::find($id);

                  $device = EcommDeviceType::where('app_user_id',$user->id)->first();

                  $registration_ids = $device->firebase_token;

                  if(!is_null($registration_ids)){

                      $message = [ 
                          "to" => $registration_ids,
                          "priority" => 'high',
                          "sound" => 'default', 
                          "badge" => '1',
                          "notification" =>
                            [
                                "title" => $request->notify_title,
                                "body" => $request->notify_message,
                            ]
                        ];

                PushNotification::send($message);

                }
              }

                session::flash('statuscode','info');
                return back()->with('status','Notification is successfully sent');
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
