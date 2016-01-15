<?php 
	include 'inc/db_connect.php';
	$results = DB::query("SELECT users.id, users.username FROM users");
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include('inc/head.php') ?>
</head>
<body>
	<?php include('inc/header.php') ?>

	<div class="container">
		
			<?php 
				foreach($results as $user){
					print '<div class="row">';
						print '<div class="user">'.$user['username'].'</div>';
						print '<div class="follow-user">
							<button class="btn btn-primary follow-button" uid='.$user['id'].'>Follow</button></div>';
					print '</div>';
				}
			?>
		</div>
	</div>


	<?php include('inc/footer.php') ?>

</body>
</html>