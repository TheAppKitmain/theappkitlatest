<?php

namespace App\Models\Template\E_Commerce;

class PushNotification 
{
	public static function send($message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
	    $headers = array(
	    	'Authorization: key=AAAAeE0fpLw:APA91bHa00WLp0pBfmmIFquZypiyySP5PRNMCdxEYFzLVZN-Ql_d-Ye4rn8dO6XDI44Ux4fPz68Muwx2dFABkukxnwHektEcbLfHfvtqlmggJOWTmd1Jw9uVj95bcCLe2CRitoCvlQIy',
	        // 'Authorization: key=AAAAlr2Pojs:APA91bEVmJTcav9XVYh3aFs5CkNBG46iJoYjMzLp2hy_RPTtTIEnCYMeoFMtexxzrjGFO7mdNjIL0QLX91f03wjRjYOMXLGO_cXK7TRqgSownOtOhBZ4PirQ2LxO3kqvGea7-Sl0-XJ3',
	    	//'Authorization: key=AAAA1ER5kMY:APA91bHp_gN9CdolyU3-fzpiM-VzFx2Mwx2hFoOLX1pBA24RhWL1nV2MMYEgC-QEBbx92q6QAu7myPEGgIqu69QpSGolMmlVYSon0bA4n0dOomW34_3HxAMru_6MW3K87FpzKPCPJnxm',
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
	    if ($result === FALSE)
	    {
	        $msg = 'Curl failed:'.curl_error($ch);
	        return response()->json(["status"=>false,"message"=>$msg]);
	    }
	    //curl_close($ch);
	    return response()->json(["status"=>true,"message"=>$result]);
	}
}