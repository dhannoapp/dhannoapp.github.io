<?php
	require_once 'googleAPI/vendor/autoload.php';
	require_once 'config.php';

    if(isset($_SESSION['access_token']))
    {
        header('Location: date.php');
    }

    echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
?>