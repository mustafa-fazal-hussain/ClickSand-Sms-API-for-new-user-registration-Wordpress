<?php 

/*
Plugin Name: ClickSand SMS API For Admin
Description: It's a hook for sending SMS when new user registered. 
Version: 0.0.1
Author: Mustafa Fazal Hussain
Author URI: http://mustafafazal.me
*/


add_action( 'user_register', 'send_sms_hook', 10, 1 );

function send_sms_hook( $user_id ) {
	
	$user_info 	= get_userdata($user_id);
  $uname		  = $user_info->user_login;
	$message 	  = 'New user registered with a name '.$uname.' ';
	
	$clicksand_username = "";
	$api_key 			      = "";
	$number 			      = "";


	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://api-mapper.clicksend.com/rest/v2/send.json");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);

	curl_setopt($ch, CURLOPT_POST, TRUE);

	curl_setopt($ch, CURLOPT_POSTFIELDS, "to=".$number."&message=".$message."");

	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . base64_encode("".$clicksand_username.":".$api_key."")]);
	$response = curl_exec($ch);
	curl_close($ch);

}


?>
