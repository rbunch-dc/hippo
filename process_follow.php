<?php

	include 'inc/db_connect.php';

	//If the user is not currently following, then insert the relationship in the table
	if($_POST['follow_type'] == 'followed'){
		DB::insert('following', array(
		  'user_id' => $_SESSION['uid'],
		  'user_id_to_follow' => $_POST['uid']
		));
	//if the user is following, then clicked to unfollow. Delete the relationship
	}elseif($_POST['follow_type'] == 'unfollow'){
		DB::delete('following', "user_id=%i AND user_id_to_follow=%i", $_SESSION['uid'], $_POST['uid']);
	}

function my_error_handler($params) {
  echo "Error: " . $params['error'] . "<br>\n";
  echo "Query: " . $params['query'] . "<br>\n";
  die; // don't want to keep going if a query broke
}

print $_POST['follow_type'];
exit;


?>
