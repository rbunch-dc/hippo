<?php
	include 'inc/db_connect.php';
	// if($_GET['error'] == 'yes'){
	// 	$error = '<div class="alert alert-danger">There was an error with your regsitration. Please try again or contact support.</div>';
	// }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'inc/head.php'; ?>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<!-- Add nav here -->
		<div id="signup-page">
			<div class="container col-md-6 col-md-offset-3">
				<div class="col-md-12 text-center">
					<h2>Join the millions fighting for Hippos today!</h2>
					<?php if(isset($error)){print $error;} ?>
				</div>

				<form class="col-md-6 text-center" action="signup_process.php" method="post">
				    <div class="form-group">
				        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Full Name" required>
				    </div>

				    <div class="form-group">
				        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required>
				    </div>
				    <div class="form-group">
				        <input type="text" class="form-control" id="inputPassword" name="inputUsername" placeholder="Username/HippoHandle" required>
				    </div>
				    <div class="form-group">
				        <input type="password" data-minlength="6" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
				    </div>


				    <button type="submit" class="btn btn-primary col-md-12">Sign Up</button>
				</form>
		</div>
  	</div>

		<div id="footer">
			<!-- Footer here -->
	  	</div>


	</body>
</html>