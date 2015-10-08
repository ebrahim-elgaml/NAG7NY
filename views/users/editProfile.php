<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" href="../../CSS/registration.css" type="text/css">
		<?php session_start() ?>	  
		<?php include '../../actions/users.php';
		include '../../db-connections/db-connection.php'; ?>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<title>Edit Profile</title>
	</head>
	<body>
		<?php
			$user_info = getUserInfo();  

			if (isset($_GET["error"])) { 
			    $error_msg = '...';
			    switch ($_GET['error']) {
			      case 1:
			        $error_msg = "password does not match password confirmation";
			        break;
			      case 2: 
			        $error_msg = "the email must be in a valid format";
			        break;
			      case 3: 
			        $error_msg = "this email is already taken";
			        break;
			      case 4: 
			        $error_msg = "the image was not uploaded";
			        break;
			        
			      default:
			        $error_msg = "an error has occured";
			        break;
			    }
		    echo '<div class="alert alert-danger" role="alert">';
		    echo '<a href="#" class="alert-link">'.$error_msg. '</a>';
		    echo '</div>' ;
		       
		  } 
		?>
		<div class="container">
			<h1>Edit Profile</h1>
			<hr>
			<form class="form-horizontal" id="editProfile" action="<?php changeUserInfo(); ?>" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-3">
					<div class="text-center">
						<?php 
						if(isset($_SESSION['user'])) {
							$sql = "select * from user where id = '{$_SESSION['user']}'";
							$result = mysqli_query($db,$sql);
							$row = $result->fetch_array();
						    $email = $row['email'] ; 
							if(file_exists('../../uploads/'.$email.'.jpg')) {
					    		echo '<img src="../../uploads/'.$email.'.jpg" class="avatar img-circle img-responsive" alt="avatar" >';
								
					        } else {
					            echo '<img src="//placehold.it/100" class="avatar img-circle" alt="avatar">';
						
					        }
						}
						?>
						<h6>Upload a different photo...</h6>
						<input type="file" name="image" id="image" class="form-control">
					</div>
				</div>
				<div class="col-md-9 personal-info">
					<h3>Personal info</h3>
						<div class="form-group">
							<label class="col-lg-3 control-label">First name:</label>
							<div class="col-lg-8">
								<input name="first_name" id="first_name" class="form-control" type="text" value="<?php echo $user_info['first_name'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Last name:</label>
							<div class="col-lg-8">
								<input name="last_name" id="last_name" class="form-control" type="text" value="<?php echo $user_info['last_name'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Email:</label>
							<div class="col-lg-8">
								<input name="email" id="email" class="form-control" type="text" value="<?php echo $user_info['email'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Password:</label>
							<div class="col-md-8">
								<input name="password" id="password" class="form-control" type="password" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Password Confirmation:</label>
							<div class="col-md-8">
								<input name="passwordconfirmation" id="passwordconfirmation" class="form-control" type="password" value="">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">
							</label>
							<div class="col-md-8">
								<button type='submit' name='changeInfo' id="changeInfo" class="btn btn-default">save changes </button>
								<input type="reset" class="btn btn-default" value="Cancel" >
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
			<hr>
	</body>
</html>

