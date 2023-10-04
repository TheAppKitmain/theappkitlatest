<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use App\User;
use App\Assignpm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChatMail;
class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //  $users = DB::select("select users.id, users.first_name, users.avatar, users.email, count(is_read) as unread 
        // from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        // where users.id != " . Auth::id() . " 
        // group by users.id, users.first_name, users.avatar, users.email");

        // return view('admin.super_admin.chat', ['users' => $users]);
         $super_id = Auth::user()->id;
         $user_id  = Assignpm::where('project_manager_id',$super_id)->pluck('customer_id');
         if($user_id->isEmpty()){
            $assigned = 0;
            return view('admin.super_admin.chat', ['assigned' => $assigned]);
         }else{
            $assigned = 1;
            $users = User::whereIn('id',$user_id)->get();
            $getip = $_SERVER['REMOTE_ADDR'];
            if($getip == '127.0.0.1'){
                $ip = "198.16.66.100";  //$_SERVER['REMOTE_ADDR']
                $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
                $ipInfo = json_decode($ipInfo);
                $timezone = $ipInfo->timezone;  
            }else{
               $ip  = $_SERVER['REMOTE_ADDR'];  
            }
            $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
            $ipInfo = json_decode($ipInfo);
            $timezone = $ipInfo->timezone;
            return view('admin.super_admin.chat', ['assigned' => $assigned,'users' => $users,'super_id' => $super_id,'timezone' => $timezone]);
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

      public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        //$ip = "14.98.87.202";  //$_SERVER['REMOTE_ADDR']
        $getip = $_SERVER['REMOTE_ADDR'];
            if($getip == '127.0.0.1'){
                $ip = "198.16.66.100";  //$_SERVER['REMOTE_ADDR']
                $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
                $ipInfo = json_decode($ipInfo);
                $timezone = $ipInfo->timezone;  
            }else{
               $ip  = $_SERVER['REMOTE_ADDR'];  
            }
            $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
            $ipInfo = json_decode($ipInfo);
            $timezone = $ipInfo->timezone;


        return view('admin.super_admin.chat.index', ['messages' => $messages,'timezone'=> $timezone]);
    }

       public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->type = "admin";
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
                \Config::get('broadcasting.connections.pusher.key'),
                \Config::get('broadcasting.connections.pusher.secret'),
                \Config::get('broadcasting.connections.pusher.app_id'),
                $options
        );

        $data1 = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data1);

        $messages = Message::where('from',$data->from)->where('to',$data->to)->where('type','admin')->count();
        if($messages == 1)
        {
            $pm = User::find($data->to);
            Mail::to($pm->email)->send(new ChatMail($data));
        }
    }
}
