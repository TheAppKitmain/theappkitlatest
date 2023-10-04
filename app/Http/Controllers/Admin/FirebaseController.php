<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Notification as EmailNotification;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Auth;
class FirebaseController extends Controller
{
    public function index(){
        $result = $this->get_all_users_chat();
        if(!empty($result['users_list'])){
           $users_list = $result['users_list'];
        } else {
           $users_list =  "";
        }
        return view('admin.super_admin.chat_new', compact('users_list'));
    }

    public function load_ajex_data(Request $request, $id = NULL){
        if(!is_null($id)){  
            return $this->get_single_user_data($id);
        } else {
            return $this->get_all_users_chat();
        }
    }

    public function send_message(Request $request){
        $pm = Auth::id();
        $user = \App\User::find($request['user_id']);
        $user_id = $user->id;
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/FirebaseKey.json')
        ->withDatabaseUri('https://theappkit-5c8d6-default-rtdb.firebaseio.com');
        $database = $factory->createDatabase();
        try 
        {
            if(!is_null($request['message'])){
                $utc_time = Carbon::now();
                $msgData = [
                    'a_remove' => '0',
                    'createdAt'=> $utc_time,
                    'isSeen' => '1',
                    'message' => $request['message'],
                    'reciever' => $user_id,
                    'sender' =>  $pm,
                    'senderType' => 'Admin',
                    'type' => '0',
                ];

                $admin_chat_id = $database->getReference('messages/'.$pm.'_'.$user_id.'/')->push($msgData)->getKey();
                $database->getReference('messages/'.$pm.'_'.$user_id.'/'.$admin_chat_id)->update(['chat_id'=> $admin_chat_id]);

                $user_chat_id = $database->getReference('messages/'.$user_id.'_'.$pm.'/')->push($msgData)->getKey();
                $database->getReference('messages/'.$user_id.'_'.$pm.'/'.$user_chat_id)->update(['chat_id'=> $user_chat_id]);

                $check_last = $database->getReference('latest_messages/'.$pm.'/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
                if($check_last){
                    $keys = array_keys( $check_last );
                    $update_msg = ['last_msg'=>$utc_time,'unread_count'=>0];
                    $database->getReference('latest_messages/'.$pm.'/'.$keys[0])->update($update_msg);
                } else {
                    $update_msg = ['user_id'=>$user_id,'last_msg'=>$utc_time,'unread_count'=>0];
                    $database->getReference('latest_messages/'.$pm.'/')->push($update_msg);
                }

                $customer_unread = $database->getReference('customer_unread_count/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
                if($customer_unread){
                    $keys = array_keys( $customer_unread );
                    $count = 1+($customer_unread[$keys[0]]['unread_count']);
                    $update_msg = ['unread_count'=>$count];
                    $database->getReference('customer_unread_count/'.$keys[0])->update($update_msg);
                } else {
                    $update_msg = ['user_id'=>$user_id,'unread_count'=>1];
                    $database->getReference('customer_unread_count/')->push($update_msg);
                }
            }

            if($request->hasFile('chat_image')){
                $file = $request->file('chat_image');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $filePath = 'images/messages/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                $url = config('services.base_url') . "/images/messages/" . $name;
                $utc_time = Carbon::now();
                $msgData = [
                    'a_remove' => '0',
                    'createdAt'=> $utc_time,
                    'isSeen' => '1',
                    'message' => $url,
                    'reciever' => $user_id,
                    'sender' =>  $pm,
                    'senderType' => 'Admin',
                    'type' => '1'
                ];

                $admin_chat_id = $database->getReference('messages/'.$pm.'_'.$user_id.'/')->push($msgData)->getKey();
                $database->getReference('messages/'.$pm.'_'.$user_id.'/'.$admin_chat_id)->update(['chat_id'=> $admin_chat_id]);

                $user_chat_id = $database->getReference('messages/'.$user_id.'_'.$pm.'/')->push($msgData)->getKey();
                $database->getReference('messages/'.$user_id.'_'.$pm.'/'.$user_chat_id)->update(['chat_id'=> $user_chat_id]);

                $check_last = $database->getReference('latest_messages/'.$pm.'/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
                if($check_last){
                    $keys = array_keys( $check_last );
                    $update_msg = ['last_msg'=>$utc_time,'unread_count'=>0];
                    $database->getReference('latest_messages/'.$pm.'/'.$keys[0])->update($update_msg);
                } else {
                    $update_msg = ['user_id'=>$user_id,'last_msg'=>$utc_time,'unread_count'=>1];
                    $database->getReference('latest_messages/'.$pm.'/')->push($update_msg);
                }

                $customer_unread = $database->getReference('customer_unread_count/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
                if($customer_unread){
                    $keys = array_keys( $customer_unread );
                    $count = 1+($customer_unread[$keys[0]]['unread_count']);
                    $update_msg = ['unread_count'=>$count];
                    $database->getReference('customer_unread_count/'.$keys[0])->update($update_msg);
                } else {
                    $update_msg = ['user_id'=>$user_id,'unread_count'=>1];
                    $database->getReference('customer_unread_count/')->push($update_msg);
                }
            }

            $all_users = \App\DeviceType::where('user_id',$user_id)->pluck('firebase_token')->toArray();
            if(count($all_users) > 0) {
                $message = [
                    "registration_ids" => $all_users,
                    "priority" => 'high',
                    "sound" => 'default',
                    "badge" => '1',
                    "data" =>
                    [
                        "title" => 'You have a new message',
                        "type" => 'chat',
                    ],
                    "notification" =>
                    [
                        "title" => 'You have a new message',
                        "type" => 'chat',
                    ]
                ];
              \App\App_PushNotification::send($message);
            }
            return $this->get_user_chat($user_id);
        } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
            return $e->getMessage();
        }
    }

    public function get_message($user_id){
       $result = $this->get_single_user_data($user_id);
        if(!empty($result['users_list'])){
           $users_list =  $result['users_list'];
        } else {
          $users_list =  "";
        }
        if(!empty($result['user_chat'])){
           $user_chat =  $result['user_chat'];
        } else {
           $user_chat =  "";
        }
        return view('admin.super_admin.chat_new', compact('users_list','user_chat'));
    }

    function get_all_users_chat(){
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/FirebaseKey.json')
        ->withDatabaseUri('https://theappkit-5c8d6-default-rtdb.firebaseio.com/');
        $database = $factory->createDatabase();
        $pm = Auth::id();
        $latest_msg = $database->getReference('latest_messages/'.$pm.'/')->orderByKey('last_msg')->getValue();
        $latest_msg_users = collect($latest_msg)->sortByDesc('last_msg');
        $lates_ids = [];
        $users_list = '';
        if(!empty($latest_msg_users)){
                foreach ($latest_msg_users as $key => $value) {
                array_push($lates_ids,$value['user_id']);
                $user = \App\User::find($value['user_id']);
                if($user){
                    $my_route = route('get_message',$user->id);
                    if($user->avatar == "avatar.png"){
                       $prfile_img =  "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                    } else {
                        $prfile_img = $user->avatar;
                    }
                    if($value['unread_count'] > 0){
                        $users_list .= '<li class="user" id="'.$user->id.'"><a href="'.$my_route.'"><span class="pending">'.$value['unread_count'].'</span><div class="media"><div class="media-left"><span><img src="'.$prfile_img.'" class="sidebar_profile"></span></div><div class="media-body"><p class="name">'.$user->business_name.'</div></div></a></li>';
                    } else {
                        $users_list .= '<li class="user" id="'.$user->id.'"><a href="'.$my_route.'"><div class="media"><div class="media-left"><span><img src="'.$prfile_img.'" class="sidebar_profile"></span></div><div class="media-body"><p class="name">'.$user->business_name.'</div></div></a></li>';
                    }
                }
            }
        }

        $getall_pending_userid = \App\Assignpm::where('project_manager_id',$pm)->pluck('customer_id')->toArray();
        $all_customers = \App\User::whereIn('id',$getall_pending_userid)->whereNotIn('id',$lates_ids)->orderBy('id','desc')->get();
        $assigned = count($all_customers);
        foreach($all_customers as $user){
            if($user->avatar == "avatar.png"){
                $prfile_img =  "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
            } else {
                $prfile_img = $user->avatar;
            }
            $my_route = route('get_message',$user->id);
            $users_list .=  '<li class="user" id="'.$user->id.'"><a href="'.$my_route.'"><div class="media"><div class="media-left"><span><img src="'.$prfile_img.'" class="sidebar_profile"></span></div><div class="media-body"><p class="name">'.$user->business_name.'</div></div></a></li>';
        }

       $result['users_list'] = $users_list;
       $result['total_count'] = $this->get_count();
       return $result;
    }

    function get_single_user_data($id){
        $pm = Auth::id();
        $user = \App\User::find($id);
        $user_id = $user->id;
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/FirebaseKey.json')->withDatabaseUri('https://theappkit-5c8d6-default-rtdb.firebaseio.com/');
        $database = $factory->createDatabase();
        $check_last = $database->getReference('latest_messages/'.$pm.'/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
        if($check_last){
            $keys = array_keys( $check_last );
            $database->getReference('latest_messages/'.$pm.'/'.$keys[0])->update(['unread_count'=>0]);
        } 
        $latest_msg = $database->getReference('latest_messages/'.$pm.'/')->orderByKey('last_msg')->getValue();
        $latest_msg_users = collect($latest_msg)->sortByDesc('last_msg');
        $lates_ids = [];
        $users_list = '';
        if(!empty($latest_msg_users)){
            foreach($latest_msg_users as $key => $value){
                array_push($lates_ids,$value['user_id']);
                $user = \App\User::find($value['user_id']);
                if($user){
                    if($user->avatar == "avatar.png"){
                       $prfile_img =  "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
                    } else {
                        $prfile_img = $user->avatar;
                    }
                    $my_route = route('get_message',$user->id);
                    $active_class = ($id == $value['user_id']) ? 'user active' : 'user';
                    $un_read_count = ($value['unread_count'] > 0) ? '<span class="pending">'.$value['unread_count'].'</span>' : '';
                    $users_list .= '<li class="'.$active_class.'" id="'.$user->id.'"><a href="'.$my_route.'">'.$un_read_count.'<div class="media"><div class="media-left"><span><img src="'.$prfile_img.'" class="sidebar_profile"></span></div><div class="media-body"><p class="name">'.$user->business_name.'</div></div></a></li>';
                }
            }
        }

        $getall_pending_userid = \App\Assignpm::where('project_manager_id',$pm)->pluck('customer_id')->toArray();
        $all_customers = \App\User::whereIn('id',$getall_pending_userid)->whereNotIn('id',$lates_ids)->orderBy('id','desc')->get();
        $assigned = count($all_customers);
        foreach($all_customers as $user){
            if($user->avatar == "avatar.png"){
               $prfile_img =  "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
            } else {
                $prfile_img = $user->avatar;
            }
            $my_route = route('get_message',$user->id);
            $class = ($id == $user->id) ? 'user active' : 'user';
            $users_list .= '<li class="'.$class.'" id="'.$user->id.'"><a href="'.$my_route.'"><div class="media"><div class="media-left"><span><img src="'.$prfile_img.'" class="sidebar_profile"></span></div><div class="media-body"><p class="name">'.$user->business_name.'</div></div></a></li>';
        }
        $result['users_list'] = $users_list;
        $data = $database->getReference('messages/'.$pm.'_'.$id);
        $all_messages = json_decode(json_encode($data->getValue()), TRUE);
        $getip = $_SERVER['REMOTE_ADDR'];
        if($getip == '::1'){
            $my_timezone = null;  
            $type = 1;
        } else {
            $ip  = $_SERVER['REMOTE_ADDR'];  
            $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
            $ipInfo = json_decode($ipInfo);
            $my_timezone = $ipInfo->timezone; 
            $type = 2;
        }
        if($all_messages)
        {
            $html = '';
            foreach ($all_messages as $key => $value){
                if($type == 1){
                    $d = new \DateTime($value['createdAt'], new \DateTimeZone('UTC'));
                    $d->setTimezone(new \DateTimeZone('Asia/Kolkata'));
                } else {
                    $d = new \DateTime($value['createdAt'], new \DateTimeZone('UTC'));
                    $d->setTimezone(new \DateTimeZone($my_timezone));
                }
                if($value['senderType'] == 'user')
                { 
                    $profile_pic = $this->get_profile_pic($value['sender']);
                    if($value['type'] == '1'){
                        $html .= '<li class="message clearfix"><div class="messagemain"><img src="'.$profile_pic.'" class="chat_profile_pic"><div class="received"><p class="chat-message-box"><img src="'.$value['message'].'" class="chat_img"></p><p class="date">'.$d->format("d-m-Y, h:i A").'</p></div></div></li>';
                    }
                    else
                    {
                        $html .= '<li class="message clearfix"><div class="messagemain"><img src="'.$profile_pic.'" class="chat_profile_pic"><div class="received"><p class="chat-message-box">'.ucwords($value['message']).'</p><p class="date">'.$d->format("d-m-Y, h:i A").'</p></div></div></li>';
                    }
                } 
                else 
                {
                    $pm_profile_pic = $this->get_profile_pic($pm);
                    if($value['type'] == '1'){
                        $html .= '<li class="message clearfix"><div class="messagemain"><div class="sent"><p class="chat-message-box"><img src="'.$value['message'].'" class="chat_img"></p><p class="date">'.$d->format("d-m-Y, h:i A").'</p><img src="'.$pm_profile_pic.'" class="chat_profile_pic"></div></div></li>';
                    } 
                    else 
                    {
                        $html .= '<li class="message clearfix"><div class="messagemain"><div class="sent"><p class="chat-message-box">'.ucwords($value['message']).'</p><p class="date">'.$d->format("d-m-Y, h:i A").'</p><img src="'.$pm_profile_pic.'" class="chat_profile_pic"></div></div></li>';
                    }
                }
            } 
        } 
        else 
        {
            $html = '<div class="w-100 main-chatbox"><div class="media-body" style="margin-left: auto;width: 100%!important;margin-right: auto;text-align: center;"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white"><strong>No messages</strong></p></div></div></div>';
        }
        $result['user_chat'] = $html;
        $result['total_count'] = $this->get_count();
        return $result;
    }

    function get_user_chat($id){
        $pm = Auth::id();
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/FirebaseKey.json')
        ->withDatabaseUri('https://theappkit-5c8d6-default-rtdb.firebaseio.com/');
        $database = $factory->createDatabase();
        $data = $database->getReference('messages/'.$pm.'_'.$id);
        $all_messages = json_decode(json_encode($data->getValue()), TRUE);

        $getip = $_SERVER['REMOTE_ADDR'];
        if($getip == '::1'){
            $my_timezone = null;  
            $type = 1;
         } else {
            $ip  = $_SERVER['REMOTE_ADDR'];  
            $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
            $ipInfo = json_decode($ipInfo);
            $my_timezone = $ipInfo->timezone; 
            $type = 2;
        }
        if($all_messages){
            $html = '';
            foreach ($all_messages as $key => $value){
                if($type == 1){
                    $d = new \DateTime($value['createdAt'], new \DateTimeZone('UTC'));
                    $d->setTimezone(new \DateTimeZone('Asia/Kolkata'));
                } else {
                    $d = new \DateTime($value['createdAt'], new \DateTimeZone('UTC'));
                    $d->setTimezone(new \DateTimeZone($my_timezone));
                }
                if($value['senderType'] == 'user')
                {
                    $profile_pic = $this->get_profile_pic($value['sender']);
                    if($value['type'] == '1'){
                        $html .= '<li class="message clearfix"><div class="messagemain"><img src="'.$profile_pic.'" class="chat_profile_pic"><div class="received"><p class="chat-message-box"><img src="'.$value['message'].'" class="chat_img"></p><p class="date">'.$d->format("d-m-Y, h:i A").'</p></div></div></li>';
                    } else {
                        $html .= '<li class="message clearfix"><div class="messagemain"><img src="'.$profile_pic.'" class="chat_profile_pic"><div class="received"><p class="chat-message-box">'.ucwords($value['message']).'</p><p class="date">'.$d->format("d-m-Y, h:i A").'</p></div></div></li>';
                    }
                } else {
                    $pm_profile_pic = $this->get_profile_pic($pm);
                    if($value['type'] == '1'){
                        $html .= '<li class="message clearfix"><div class="messagemain"><div class="sent"><p class="chat-message-box"><img src="'.$value['message'].'" class="chat_img"></p><p class="date">'.$d->format("d-m-Y, h:i A").'</p><img src="'.$pm_profile_pic.'" class="chat_profile_pic"></div></div></li>';
                    } else {
                         $html .= '<li class="message clearfix"><div class="messagemain"><div class="sent"><p class="chat-message-box">'.ucwords($value['message']).'</p><p class="date">'.$d->format("d-m-Y, h:i A").'</p><img src="'.$pm_profile_pic.'" class="chat_profile_pic"></div></div></li>';
                    }
                }
            } 
        } 
        else 
        {
            $html = '<div class="w-100 main-chatbox"><div class="media-body" style="margin-left: auto;width: 100%!important;margin-right: auto;text-align: center;"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white"><strong>No messages</strong></p></div></div></div>';
        }
       return $html;
    }

    public static function get_count(){
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/FirebaseKey.json')
        ->withDatabaseUri('https://theappkit-5c8d6-default-rtdb.firebaseio.com');
        $auth = $factory->createAuth();
        $database = $factory->createDatabase();
        $count = 0;
        $pm = Auth::id();
        /*$latest_msg_users = $database->getReference('latest_messages/'.$pm.'/')->getValue();
        if(!empty($latest_msg_users)){
            if(count($latest_msg_users) > 0){
                 foreach($latest_msg_users as $last_msg){
                    if($last_msg['unread_count']){ 
                        $count += $last_msg['unread_count'];
                    }
                }
            }
        }*/
        return $count;
    }  
      
    public static function get_test_data(){
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/FirebaseKey.json')
        ->withDatabaseUri('https://theappkit-5c8d6-default-rtdb.firebaseio.com');
        $auth = $factory->createAuth();
        $database = $factory->createDatabase();
        $count = 0;
        $pm = Auth::id();
        $latest_msg_users = $database->getReference('latest_messages/'.$pm.'/')->getValue();
        if(!empty($latest_msg_users)){
            foreach($latest_msg_users as $key => $last_msg){
                if($last_msg['unread_count']){
                    $count += $last_msg['unread_count'];
                }
            }
        }
        return $count;
    }

    public static function get_profile_pic($id){
        $appkituser = \App\User::find($id);
        if(!is_null($appkituser)){
            if($appkituser->avatar == "avatar.png"){
               return "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
            } else {
                return $appkituser->avatar;
            }
        } else {
            return "https://theappkit.s3.us-east-2.amazonaws.com/theappkit/theappkitproject/Template/Ecommerce/Wardrobes/1617774409.png";
        }
    }
}
