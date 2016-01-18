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

					$posts = DB::query("SELECT posts.content, posts.timestamp, users.username, posts.id FROM posts 
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
				  		$count = 0;
					  	print '<div class="row home-post">
						  	<div class="col-md-10 text-left">'.$post['content'].' -- '.$post['username'].'</div>
							<div class="col-md-2">
								<div class="vote vote-up" post_id='.$post['id'].'>
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="imgView" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 451.847 451.846" style="enable-background:new 0 0 451.847 451.846;" xml:space="preserve" class="detail convertSvgInline replaced-svg" data-id="32323" data-kw="navigate6">
											<g>
												<path style="fill:#4099ff;" d="M248.292,106.406l194.281,194.29c12.365,12.359,12.365,32.391,0,44.744c-12.354,12.354-32.391,12.354-44.744,0   L225.923,173.529L54.018,345.44c-12.36,12.354-32.395,12.354-44.748,0c-12.359-12.354-12.359-32.391,0-44.75L203.554,106.4   c6.18-6.174,14.271-9.259,22.369-9.259C234.018,97.141,242.115,100.232,248.292,106.406z"></path>
											</g>
										</svg>
								</div>

								<div class="vote-up-down-number" up-down-id='.$post['id'].'>';

									//get the vote up/down number.
									$vote_results = DB::query("SELECT * FROM post_votes
										WHERE post_id =".$post['id']);		

									if(!empty($vote_results)) {
										foreach ($vote_results as $vote){
											$count = $count + $vote['vote'];
										}
										print $count;
									}else{
										print '0';
									}
									print '</div>

								<div class="vote vote-down" post_id='.$post['id'].'>
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="imgView" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 307.053 307.053" style="enable-background:new 0 0 307.053 307.053;" xml:space="preserve" class="detail convertSvgInline replaced-svg" data-id="26046" data-kw="down14">
												<g id="_x34_86._Down">
													<g>
														<path style="fill:#4099ff;" d="M302.445,80.796l-11.101-11.103c-6.123-6.131-16.074-6.131-22.209,0L153.67,183.707L37.907,67.959     c-6.134-6.13-16.08-6.13-22.209,0L4.597,79.06c-6.129,6.133-6.129,16.067,0,22.201l137.83,137.829     c6.129,6.136,16.067,6.136,22.203,0l137.815-136.096C308.589,96.864,308.589,86.926,302.445,80.796z"></path>
													</g>
												</g>
										</svg>
								</div>
								<div class="error" error_id='.$post['id'].'></div>
							</div>

						  	<div class="col-md-8 text-left">'.date('D, F j, Y', (strtotime($post['timestamp']))).'</div>					
						</div>';

					}
		?>


		<?php include('inc/footer.html') ?>
	</div>
</body>

</html>