<?php
/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

function sendNotification($to="all",$title="", $desc="", $category=0, $action = false, $data = array())
{
	$fcm_server_key =  "AAAATTKpYHw:APA91bEyjXPgRDYirCFLKKEIQQWdtf-fSLZUTYZneKchBBkvETQ3pU1RrQDFBK4abLft3Ok1ZCSbY_PDAUhqK02YKwkfgx15Y1CE8yICC-_t4HBVo1KcX7eKufSAQdmNytAyF5EmKM2J"; 
      //firebase server url to send the curl request
    $url = 'https://fcm.googleapis.com/fcm/send';

    //building headers for the request
    $headers = array(
        'Authorization: key=' . $fcm_server_key,
        'Content-Type: application/json'
    ); 

    $payload = array(
        "to" => $to, //  /topics/all
        "priority" => "high",
        "notification" => array( 
            "title" => $title,
            "body" => $desc,
            "time" => date("H:i"),
            "category" => $category, //document, approval,invoice
            "date" => date("Y-m-d"),
            "click_action" =>"FCM_PLUGIN_ACTIVITY",
            "sound"=> "default"
        ),
        "data" => array( 
            "title" => $title, 
            "body" => $desc,
            "data" => $data,
            "time" => date("H:i"),
            "category" => $category, //document, approval,invoice
            "date" => date("Y-m-d"),
            "click_action" =>"FCM_PLUGIN_ACTIVITY",
            "sound"=> "default" 
        )
    );
    //Initializing curl to open a connection
    $ch = curl_init();

    //Setting the curl url
    curl_setopt($ch, CURLOPT_URL, $url);
    
    //setting the method as post
    curl_setopt($ch, CURLOPT_POST, true);

    //adding headers 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //disabling ssl support
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    //adding the fields in json format 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    //finally executing the curl request 
    $result = curl_exec($ch);

    //Now close the connection
    curl_close($ch);
 
    if($result){
		return $result;
	}

	return false;
 
} 