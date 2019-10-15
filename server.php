<?php

session_start();

//intializing variables

$username = "";
$email = "";
$password_1 = "";
$password_2 = "";

$errors = array();

//connect to database

$db = mysqli_connect('localhost','root','','Practice') or die("Could not connect to database");

//Registering users
if(isset($_POST['reg_user'])){
if(isset($_POST['username'])){
$username = mysqli_real_escape_string($db, $_POST['username']);}

if(isset($_POST['email'])){
$email = mysqli_real_escape_string($db, $_POST['email']);}

if(isset($_POST['password_1'])){
$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);}

if(isset($_POST['password_2'])){
$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);}

//form validation

if(empty($username)){array_push($errors, "username is required");}
if(empty($email)){array_push($errors, "email is required");}
if(empty($password_1)){array_push($errors, "password is required");}
if($password_1 != $password_2){array_push($errors, "passowrds don't match");}

//check db for existing user with same username

$user_check_query = "SELECT * FROM  user WHERE username = '$username' OR email = '$email' LIMIT 1";

$results = mysqli_query($db,$user_check_query); 
$user = mysqli_fetch_assoc($results);

if($user){
	if($user['username'] === $username){array_push($errors, "username already exists");}
	if($user['email'] === $email){array_push($errors, "email already exists");}
}

//Register the user if no error

if(count($errors)==0){

$password = md5($password_1);//encryption
$query = "INSERT INTO user (username,email,password) VALUES ('$username','$email','$password')";

mysqli_query($db, $query);
$_SESSION['username']=$username;
$_SESSION['success']="Logged In";

header("Location: index.php");
}
}
//login user

if(isset($_POST['login_user'])){

	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password_1']);

	if(empty($username)){array_push($errors, "username is required");}
	if(empty($password)){array_push($errors, "password is required");}

	 if(count($errors)==0){

	 	$password = md5($password);

	 	$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

	 	$res = mysqli_query($db, $query);

	 	if(mysqli_num_rows($res)){
	 		header("Location: index.php");	
	 		$_SESSION['username'] = $username;
	 		$_SESSION['success'] = "Logged In!";
	 		 	
	 	}

	 }else{array_push($errors,"Wrong Password/Username Combination");}

}








































?>