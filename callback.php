<?php
    require_once 'config.php';
    require_once 'index.php';
    
    if(isset($_SESSION['access_token']))
        $client->setAccessToken($_SESSION['access_token']);
    else if (isset($_GET['code'])) 
	{
	   $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	   $_SESSION['access_token'] = $token;
	} 
    
    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
	$name =  $google_account_info->name; 
    $phone =  $google_account_info->phone;

	echo $name .'<br>'. $email .'<br>'. $phone;
?>