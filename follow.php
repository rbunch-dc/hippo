<?php 
	include 'inc/db_connect.php';
	//All users
	$results = DB::query("select * from users WHERE id !=".$_SESSION['uid']);

	$results_following = DB::query("SELECT distinct(user_id_to_follow) FROM following following
		WHERE following.user_id=%i" , $_SESSION['uid']);

	$last = count($results_following);

	$following_array = [];
	if($last > 0){
		foreach($results_following as $following){
			$following_array[] = $following['user_id_to_follow'];
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include('inc/head.php') ?>
</head>
<body>
	<?php include('inc/header.php') ?>
<pre>
	<div class="container">
		<?php foreach($results as $user){

	    	if(in_array($user['id'],$following_array)){
	    		$button_text = 'Unfollow';
	    		$follow = "unfollow";
	    		$button_class = 'btn-default';
	    	}else{
	    		$button_text = 'Follow';
	    		$follow = "followed";
	    		$button_class = 'btn-primary';

	    	}
	    	print '<div class="user">';
	    		// print '<div class="user-name col-md-6 text-left">'.$user['realname'].'</div>';
	    		print '<div class="user-hippo col-md-12 text-left">'.$user['username'].'</div>';
	    		print '<button type="button" class="btn '.$button_class.' col-md-2 text-left follow-button" data-follow="'.$follow.'" uid='.$user['id'].'>'.$button_text.'</button>';
	    	print '</div>';
	    }
	    ?>

		</div>
	</div>


	<?php include('inc/footer.php') ?>

</body>
</html>