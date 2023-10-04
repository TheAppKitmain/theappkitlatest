<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pushnotification extends Model
{
    public static function send($message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=AAAA9VsKwvs:APA91bGkNG6gHu7qRfc3IrH9-o1fTqio75JmYnAidJRGG6cEjns5DcXHJVPV5v7iAmzbqVp2CMicJbp6_jCjip-12INN6OERi4sEj8Km7vfcutXs5lOPg1i6dy4DfuIvI3wgnyQQRCtW',
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
