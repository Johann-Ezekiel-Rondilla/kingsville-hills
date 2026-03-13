<?php
require 'db_connect.php';

if (isset($_POST['reg_submit'])) {

    // Collect form data
    $fname = mysqli_real_escape_string($conn, $_POST['reg_fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['reg_lname']);
    $email = mysqli_real_escape_string($conn, $_POST['reg_email']);
    $password = mysqli_real_escape_string($conn, $_POST['reg_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['reg_confirm_password']);

    // Default phone number (Fix for phone_num database requirement)
    $phone = "0000000000";

    // Basic validation
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit();
    }

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already registered!');</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $insert_query = "INSERT INTO users (first_name, last_name, email, password, phone_num, role) 
                     VALUES ('$fname', '$lname', '$email', '$hashed_password', '$phone', 'resident')";
    
    if (mysqli_query($conn, $insert_query)) {
        echo "<script>alert('Registration successful! Please log in.'); window.location.href='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Kingsville Connect - Register</title>

		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

		<link href="css/sb-admin-2.min.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">

	</head>

	<body class="bg-kingsville">

		<div class="container">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">

					<div class="row">
						<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>

						<div class="col-lg-7">
							<div class="p-5">

							<div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
							</div>

							<form class="user" action="register.php" method="post">

								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input type="text" class="form-control form-control-user" name="reg_fname" placeholder="First Name">
									</div>

									<div class="col-sm-6">
										<input type="text" class="form-control form-control-user" name="reg_lname" placeholder="Last Name">
									</div>
								</div>

								<div class="form-group">
									<input type="email" class="form-control form-control-user" name="reg_email" placeholder="Email Address">
								</div>

								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input type="password" class="form-control form-control-user" name="reg_password" placeholder="Password">
									</div>

									<div class="col-sm-6">
										<input type="password" class="form-control form-control-user" name="reg_confirm_password" placeholder="Repeat Password">
									</div>
								</div>

								<button type="submit" name="reg_submit" class="btn btn-primary btn-user btn-block">
									Register Account
								</button>

							</form>

							<hr>

							<div class="text-center">
								<a class="small" href="forgot-password.php">Forgot Password?</a>
							</div>

							<div class="text-center">
								<a class="small" href="login.php">Already have an account? Login!</a>
							</div>

							</div>
						</div>

					</div>
				</div>
			</div>

		</div>

		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
		<script src="js/sb-admin-2.min.js"></script>

	</body>
</html>