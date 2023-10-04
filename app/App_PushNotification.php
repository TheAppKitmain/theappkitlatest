<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_PushNotification extends Model
{
    public static function send($message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=AAAA6iSCzPM:APA91bHyMYJH5-LUEojn2zsMxoHhDjK6h5NtUVUI-56JQJkSqrZKipgIYaSzF2Z5_220RRCPYLkBBtCQEwv1VBMC9dqDvoSq176ATLofvUwrRvvHxUl8931e-52km9gcu6PrBuZhKBVZ',
            'Content-Type: application/json'
        );
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            $msg = 'Curl failed:' . curl_error($ch);
            return response()->json(["status" => false, "message" => $msg]);
        }
        return response()->json(["status" => true, "message" => $result]);
    }
}
