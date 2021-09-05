<?php
session_start();
include './api/loginApi.php';
error_reporting(0);
$conn = mysqli_connect("localhost:3307","root","","hms6");
if(isset($_POST['submit']))
{
	$_SESSION['module']=$_POST['module'];
	$_SESSION['uname']=$_POST['uname'];
	//$_SESSION['passw']=$_POST['passw'];
}    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login - HMS</title>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<link href="bootstrap-4.6.0-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-4.6.0-dist/jquery/jquery-3.6.0.js"></script>
	<script src="bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
	<link href="appointment.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="wrapper">
			<div class="wrapper-header text-center">
				<h3 style="font-weight: 700;">Hospital Management System</h3>
				<hr>
			</div>

            <?php
				if (isset($_POST["submit"])) {
					$object = new loginApi($_POST["uname"], $_POST["passw"], $_POST["module"]);
					$message = $object->validator();
					$message = json_decode($message);
					$code = $message->{'code'};
					if ($code != 200) 
					{
						echo "<div class='alert alert-danger'><strong>Invalid Credentials</strong>.</div>";
					} 
					else 
					{
						if ($_POST['module'] === 'patient') {
							header('Location: patient.php');
						}
						if ($_POST['module'] === 'doctor') {
							header('Location: doctor.php');
							die();
						}
						/*if ($_POST['module'] === 'doctor') {
							header('Location: ./Doctor/');
							die();
						}
						*/
						if ($_POST['module'] === 'admin') {
							header('Location: ./Admin/');
							die();
						}
					}
				} 
			?>     

			<form method="POST" autocomplete="off" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<select class="custom-select" id="table" name="module">
					<option>Select Module</option>
					<option value="patient">Patient</option>
					<option value="doctor">Doctor</option>
					<option value="admin">Admin</option>
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
