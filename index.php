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
						$results = DB::query("SELECT * FROM posts
							ORDER BY timestamp desc limit 30");
			}				
		?>


		<?php include('inc/footer.html') ?>
	</div>
</body>

</html>