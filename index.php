<?php 

	

	include('inc/db_connect.php');
	$_SESSION['page'] = 'active';
	if(isset($_GET['callback'])){
		if($_GET['callback'] == 'post'){
			$message = "Your post was successfully submitted!";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<?php include('inc/head.php') ?>
</head>
<body>
	<div id="total-wrapper">
		<?php include('inc/header.php') ?>

		<div id="container">
			<?php print $message; ?>
		</div>
		<?php
			//Get the posts. If they are anon, get all recent.
			//If they are logged in, get theirs and the people they are following
			if(!isset($_SESSION['uid'])){
				$results = DB::query(
					"SELECT posts.content, posts.timestamp, users.username FROM posts
						LEFT JOIN users on posts.uid=users.id
						ORDER BY posts.timestamp desc limit 30");
				//we now have all results, max of 30, orderd by time posted.
				//Let's print them off.
				foreach($results as $result){
					  	print '<div class="row home-post">
						  	<div class="col-md-12 text-center">'.$result['content'].' -- '.$result['username'].'</div>
						  	<div class="col-md-12 text-center">'.$result['timestamp'].'</div>';
						print '</div>';
				}
			}
		?>


		<?php include('inc/footer.html') ?>
	</div>
</body>

</html>