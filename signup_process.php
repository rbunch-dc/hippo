<?php

session_start();
require_once('inc/meekrodb.2.3.class.php');

$username = $_POST['email'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	try{
		DB::insert('users',array(
			'id' => '',
			'name' => $username,
			'pass' => $hashed_password,
			'status' => 1
		));
	}catch(MeekroDBException $e){
		header('Location: /signup.php?error=yes');
		exit;
	}

	$_SESSION['username'] = $username;
	$_SESSION['uid'] = DB::insertId();
	header('Location: /?callback=registration');

?>
