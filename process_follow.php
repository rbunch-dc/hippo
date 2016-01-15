<?php

	include 'inc/db_connect.php';

	try{
		DB::insert('following', array(
			'user_id' => $_SESSION['uid'],
			'user_id_to_follow' => $_POST['uid']
		));		
	}catch(MeekroDBException $e){
		header('Location: /follow.php?error=true');
		exit;
	}
	print json_encode("Success!");


?>