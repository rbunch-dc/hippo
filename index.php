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

		 	<div class="col-md-12 text-center header-image">
		 		<img src="/images/africa-guardians.png">
				<div id="defenders-text">Defending animals in Africa since 2020 B.C.</div>		 		
		 	</div>


		<div id="container">
			<?php 
				if(isset($message)){
					print $message; 	
				}
				
			?>
		</div>
		<?php
			//Get the posts. If they are anon, get all recent.
			//If they are logged in, get theirs and the people they are following
			if(!isset($_SESSION['uid'])){
				$posts = DB::query(
					"SELECT posts.content, posts.timestamp, users.username FROM posts
						LEFT JOIN users on posts.uid=users.id
						ORDER BY posts.timestamp desc limit 30");
				//we now have all results, max of 30, orderd by time posted.

			}else{
				//The JOIN version
				/*
				$result = DB::query(

                        "SELECT * FROM posts
                        INNER JOIN following 
                        	ON following.user_id_to_follow=posts.uid 
                        INNER JOIN users
                        	ON users.id = posts.uid
                        WHERE user_id=%s", $_SESSION['uid']
                    );
				*/

				$results_following = DB::query("SELECT distinct(user_id_to_follow) FROM following following
					WHERE following.user_id=%i" , $_SESSION['uid']);

				$last = count($results_following);

				if($last > 0){
					$i = 0;
					$following_array = '';
					foreach($results_following as $following){
						$i++;
						$following_array .= $following['user_id_to_follow'];
						if($i != $last){$following_array .= ",";}
					}

					$posts = DB::query("SELECT * FROM posts 
						LEFT JOIN users on posts.uid=users.id
						WHERE uid IN ($following_array)");					
				}else{
					$posts = DB::query(
						"SELECT posts.content, posts.timestamp, users.username FROM posts
							LEFT JOIN users on posts.uid=users.id
							ORDER BY posts.timestamp desc limit 30");
					//we now have all results, max of 30, orderd by time posted.

				}
			}
				//Let's print them off.
				foreach($posts as $post){
					  	print '<div class="row home-post">
						  	<div class="col-md-12 text-center">'.$post['content'].' -- '.$post['username'].'</div>
						  	<div class="col-md-12 text-center">'.$post['timestamp'].'</div>';
						print '</div>';
				}
		?>


		<?php include('inc/footer.html') ?>
	</div>
</body>

</html>