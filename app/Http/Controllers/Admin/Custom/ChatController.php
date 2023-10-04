<?php
namespace App\Http\Controllers\Admin\Custom;

use App\Message;
use App\User;
use App\Assignpm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChatMail;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Notification as EmailNotification;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_id = ($user->parent_id == 0) ? $user->id : $user->parent_id;
        $super_id = Assignpm::where('customer_id',$user_id)->first();
        if(empty($super_id)){
            $assigned = 0;
            return view('admin.custom.chat_new', ['assigned' => $assigned]);
        }
        else
        {
            $assigned = 1;
            $pm = User::where('id',$super_id->project_manager_id)->first();
            $chat = $this->get_chat($user_id,$super_id->project_manager_id);
            $unread_count = $this->get_count();
            return view('admin.custom.chat_new', 
                [
                    'assigned' => $assigned,
                    'pm_id'=> $super_id->project_manager_id,
                    'user_id' => $user_id,
                    'pm' => $pm,
                    'user_chat' => $chat,
                    'unread_count'=> $unread_count
                ]);
        }
    }

    public function get_chat($id,$pm)
    {
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/FirebaseKey.json')->withDatabaseUri('https://theappkit-5c8d6-default-rtdb.firebaseio.com/');
        $database = $factory->createDatabase();

        $customer_unread = $database->getReference('customer_unread_count/')->orderByChild('user_id')->EqualTo($id)->getValue();
        if($customer_unread){
            $keys = array_keys( $customer_unread );
            $database->getReference('customer_unread_count/'.$keys[0])->update(['unread_count'=>0]);
        } 

        $data = $database->getReference('messages/'.$id.'_'.$pm);
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
                if($value['senderType'] == 'user'){
                    $profile_pic = $this->get_profile_pic($value['sender']);
                    if($value['type'] == '1'){
                        $html .= '<li class="message clearfix"><div class="messagemain"><div class="sent"><p class="chat-message-box"><img src="'.$value['message'].'" class="chat_img"></p><p class="date">'.$d->format("d-m-Y, h:i A").'</p><img src="'.$profile_pic.'" class="chat_profile_pic"></div></div></li>';
                    } else {
                        $html .= '<li class="message clearfix"><div class="messagemain"><div class="sent"><p class="chat-message-box">'.ucwords($value['message']).'</p><p class="date">'.$d->format("d-m-Y, h:i A").'</p><img src="'.$profile_pic.'" class="chat_profile_pic"></div></div></li>';
                    }
                } 
                else
                {   $pm_profile_pic = $this->get_profile_pic($pm);
                    if($value['type'] == '1'){
                        $html .= '<li class="message clearfix"><div class="messagemain"><img src="'.$pm_profile_pic.'" class="chat_profile_pic"><div class="received"><p class="chat-message-box"><img src="'.$value['message'].'" class="chat_img"></p><p class="date">'.$d->format("d-m-Y, h:i A").'</p></div></div></li>';
                    } else {
                         $html .= '<li class="message clearfix"><div class="messagemain"><img src="'.$pm_profile_pic.'" class="chat_profile_pic"><div class="received"><p class="chat-message-box">'.ucwords($value['message']).'</p><p class="date">'.$d->format("d-m-Y, h:i A").'</p></div></div></li>';
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

    public function get_user_chat($id,$pm)
    {
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/FirebaseKey.json')->withDatabaseUri('https://theappkit-5c8d6-default-rtdb.firebaseio.com/');
        $database = $factory->createDatabase();

        $customer_unread = $database->getReference('customer_unread_count/')->orderByChild('user_id')->EqualTo($id)->getValue();
        if($customer_unread){
            $keys = array_keys( $customer_unread );
            $database->getReference('customer_unread_count/'.$keys[0])->update(['unread_count'=>0]);
        } 

        $data = $database->getReference('messages/'.$id.'_'.$pm);
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
                if($value['senderType'] == 'user'){
                    $profile_pic = $this->get_profile_pic($value['sender']);
                    if($value['type'] == '1'){
                        $html .= '<li class="message clearfix"><div class="messagemain"><div class="sent"><p class="chat-message-box"><img src="'.$value['message'].'" class="chat_img"></p><p class="date">'.$d->format("d-m-Y, h:i A").'</p><img src="'.$profile_pic.'" class="chat_profile_pic"></div></div></li>';
                    } else {
                        $html .= '<li class="message clearfix"><div class="messagemain"><div class="sent"><p class="chat-message-box">'.ucwords($value['message']).'</p><p class="date">'.$d->format("d-m-Y, h:i A").'</p><img src="'.$profile_pic.'" class="chat_profile_pic"></div></div></li>';
                    }
                } 
                else
                {   $pm_profile_pic = $this->get_profile_pic($pm);
                    if($value['type'] == '1'){
                        $html .= '<li class="message clearfix"><div class="messagemain"><img src="'.$pm_profile_pic.'" class="chat_profile_pic"><div class="received"><p class="chat-message-box"><img src="'.$value['message'].'" class="chat_img"></p><p class="date">'.$d->format("d-m-Y, h:i A").'</p></div></div></li>';
                    } else {
                         $html .= '<li class="message clearfix"><div class="messagemain"><img src="'.$pm_profile_pic.'" class="chat_profile_pic"><div class="received"><p class="chat-message-box">'.ucwords($value['message']).'</p><p class="date">'.$d->format("d-m-Y, h:i A").'</p></div></div></li>';
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
  
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $sender_id = $user->id;
        $user_id = ($user->parent_id == 0) ? $user->id : $user->parent_id;
        $super_id = Assignpm::where('customer_id',$user_id)->first();
        $pm = $super_id->project_manager_id;

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
                    'reciever' =>  $pm,
                    'sender' =>  $sender_id,
                    'senderType' => 'user',
                    'type' => '0'
                ];
                $admin_chat_id = $database->getReference('messages/'.$pm.'_'.$user_id.'/')->push($msgData)->getKey();
                $database->getReference('messages/'.$pm.'_'.$user_id.'/'.$admin_chat_id)->update(['chat_id'=> $admin_chat_id]);

                $user_chat_id = $database->getReference('messages/'.$user_id.'_'.$pm.'/')->push($msgData)->getKey();
                $database->getReference('messages/'.$user_id.'_'.$pm.'/'.$user_chat_id)->update(['chat_id'=> $user_chat_id]);

                $check_last = $database->getReference('latest_messages/'.$pm.'/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
                if($check_last){
                    $keys = array_keys( $check_last );
                    $count = 1+($check_last[$keys[0]]['unread_count']);
                    $update_msg = ['last_msg'=>$utc_time,'unread_count'=>$count];
                    $database->getReference('latest_messages/'.$pm.'/'.$keys[0])->update($update_msg);
                } else {
                    $update_msg = ['user_id'=>$user_id,'last_msg'=>$utc_time,'unread_count'=>1];
                    $database->getReference('latest_messages/'.$pm.'/')->push($update_msg);
                }

                $customer_unread = $database->getReference('customer_unread_count/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
                if($customer_unread){
                    $keys = array_keys( $customer_unread );
                    $database->getReference('customer_unread_count/'.$keys[0])->update(['unread_count'=>0]);
                } 
            }

            if($request->hasFile('chat_image'))
            {
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
                    'reciever' =>  $pm,
                    'sender' =>  $sender_id,
                    'senderType' => 'user',
                    'type' => '1'
                ];

                $admin_chat_id = $database->getReference('messages/'.$pm.'_'.$user_id.'/')->push($msgData)->getKey();
                $database->getReference('messages/'.$pm.'_'.$user_id.'/'.$admin_chat_id)->update(['chat_id'=> $admin_chat_id]);

                $user_chat_id = $database->getReference('messages/'.$user_id.'_'.$pm.'/')->push($msgData)->getKey();
                $database->getReference('messages/'.$user_id.'_'.$pm.'/'.$user_chat_id)->update(['chat_id'=> $user_chat_id]);

                $check_last = $database->getReference('latest_messages/'.$pm.'/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
                if($check_last){
                    $keys = array_keys( $check_last );
                    $count = 1+($check_last[$keys[0]]['unread_count']);
                    $update_msg = ['last_msg'=>$utc_time,'unread_count'=>$count];
                    $database->getReference('latest_messages/'.$pm.'/'.$keys[0])->update($update_msg);
                } else {
                    $update_msg = ['user_id'=>$user_id,'last_msg'=>$utc_time,'unread_count'=>0];
                    $database->getReference('latest_messages/'.$pm.'/')->push($update_msg);
                }

                $customer_unread = $database->getReference('customer_unread_count/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
                if($customer_unread){
                    $keys = array_keys( $customer_unread );
                    $database->getReference('customer_unread_count/'.$keys[0])->update(['unread_count'=>0]);
                } 
            }

            $all_users = \App\DeviceType::where('user_id',$pm)->pluck('firebase_token')->toArray();
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

            return $this->get_user_chat($user_id,$pm);
        } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
            return $e->getMessage();
        }
    }

    public static function get_count()
    {
        $user = Auth::user();
        $user_id = ($user->parent_id == 0) ? $user->id : $user->parent_id;
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/FirebaseKey.json')->withDatabaseUri('https://theappkit-5c8d6-default-rtdb.firebaseio.com');
        $database = $factory->createDatabase();
        $count = 0;
        $customer_unread = $database->getReference('customer_unread_count/')->orderByChild('user_id')->EqualTo($user_id)->getValue();
        if($customer_unread){
            $keys = array_keys($customer_unread);
            $count = $customer_unread[$keys[0]]['unread_count'];
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

   /*---------------------------------chat with pusher backup-------------------------------*/

   /*   
    public function index()
    {
        $user_id = Auth::user()->id;
        $super_id = Assignpm::where('customer_id',$user_id)->first();
        if(empty($super_id))
        {
            $assigned = 0;
            return view('admin.custom.chat', ['assigned' => $assigned]);
        }
        else
        {
            $assigned = 1;
            $user = User::where('id',$super_id->project_manager_id)->first();
            $messages_count = Message::where('to',$user_id)->where('from',$super_id->project_manager_id)->where('is_read',0)->count();
            $getip = $_SERVER['REMOTE_ADDR'];
            if($getip == '127.0.0.1')
            {
                $ip = "198.16.66.100";  //$_SERVER['REMOTE_ADDR']
                $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
                $ipInfo = json_decode($ipInfo);
                $timezone = $ipInfo->timezone;  
            }
            else
            {
               $ip  = $_SERVER['REMOTE_ADDR'];  
            }
            $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
            $ipInfo = json_decode($ipInfo);
            $timezone = $ipInfo->timezone;
            return view('admin.custom.chat', ['assigned' => $assigned,'user' => $user,'messages_count'=> $messages_count,'timezone' => $timezone]);
        }
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        $getip = $_SERVER['REMOTE_ADDR'];
        if($getip == '127.0.0.1'){
            $ip = "198.16.66.100";  //$_SERVER['REMOTE_ADDR']
            $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
            $ipInfo = json_decode($ipInfo);
            $timezone = $ipInfo->timezone;  
        }
        else
        {
           $ip  = $_SERVER['REMOTE_ADDR'];  
        }
        $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
        $ipInfo = json_decode($ipInfo);
        $timezone = $ipInfo->timezone;

        return view('admin.custom.chat.index', ['messages' => $messages,'timezone'=> $timezone]);
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
        $data->type = "customer";
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

        //$data['message'] = 'hello world'; // sending from and to user id when pressed enter
        $data1 = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data1);

        $messages = Message::where('from',Auth::id())->where('to',$data->to)->where('type','customer')->count();
        if($messages == 1)
        {
            $pm = User::find($data->to);
            Mail::to($pm->email)->send(new ChatMail($data));
           
        }
    }
    */
}
