<!DOCTYPE html>
<html>
<head>
	<title>Login - HMS</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">

	<link href="./css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>

	<!-- Loading custom stylesheet -->
	<link href="./css/custom/login_style.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="wrapper">
			<div class="wrapper-header text-center">
				<h3 style="font-weight: 700;">Hospital Management System</h3>
				<hr>
			</div>

			<div class="alert alert-danger">
				<strong>Invalid Credentials</strong>
			</div>

			<form method="POST" autocomplete="off" action="in_validate">
				<select class="custom-select" id="table" name="table">
					<option>Select Module</option>
					<option>Patient</option>
					<option>Doctor</option>
					<option>Admin</option>
				</select>
				<div class="form-group">
					<label>Username</label>
					<input class="form-control" autocomplete="off" id="uname" type="text" name="uname" placeholder="Username">

					<label>Password</label> 
					<input class="form-control" autocomplete="off" id="passw" type="password" name="passw" placeholder="Password">

					<button type="submit" name="submit" class="btn btn-primary mt-5" value="submit">Login Here</button>
					<label class="forgot-password"><a href="#">Forgot Password?</a></label>
				</div>
			</form>
			<hr>
		</div>
	</div>
</body>
</html>