<?php

function send($phone,$file)
{
	$file = $file;
	$file_name  = md5($file.microtime()).substr($file,-5,5);
	move_uploaded_file($_FILES['file']['tmp_name'],'image/'.$file_name);
	$number = $phone;
	$apiURL = 'https://eu187.chat-api.com/instance220285/';
	$token = 'wzs5ybiwn02avn0k';
	$data = json_encode(array(
	'chatId'=>$phone.'@c.us',
	'body'=>'https://plustor.ir/watsapp/image/'.$file_name,
	'filename'=>$file_name,
	'caption'=>'This File Send with Api'
	));

	$url = $apiURL.'sendFile?token='.$token;
	$options = stream_context_create(['http' => [
	'method'  => 'POST',
	'header'  => 'Content-type: application/json',
	'content' => $data
	]
	]);
	$response = file_get_contents($url,false,$options);
	$data = json_decode($response,true);
	$message =  $data['message'];
	if($message == "")
	{
		echo '<script>alert("image not send");</script>';
	}
	else
	{
		echo '<script>alert("image send!!!");</script>';
	}
	
}

?>