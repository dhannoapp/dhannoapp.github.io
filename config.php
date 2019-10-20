<?php

    session_start();
    require_once "googleAPI/vendor/autoload.php";
    $client = new Google_Client();
    $client->setClientId("783378175969-098kbl8tmalgfdss6v4cn0v8mcpb919l.apps.googleusercontent.com");
    $client->setClientSecret("rZFAegLeq7zYxuPbPFAl4pZs");
    $client->setApplicationName("Dhanno");
    $client->setRedirectUri("https://dhannowebsite.000webhostapp.com/date.php");
    $client->addScope("https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.login");
	$client->addScope("email");
	$client->addScope("profile");
?>