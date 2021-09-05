<?php
session_start();

if (isset($_SESSION['id'])) {
	if ($_SESSION['module'] === 'patient') {
		header('Location: ./Admin/');
		die();
	}
	if ($_SESSION['module'] === 'doctor') {
		header('Location: ./Doctor/doctor.php');
		die();
	}
	if ($_SESSION['module'] === 'reception') {
		header('Location: ./Reception/recep2.php');
		die();
	}
	if ($_SESSION['module'] === 'medr') {
		header('Location: ./MedicalR/mr.php');
		die();
	}
	if ($_SESSION['module'] === 'chemist') {
		header('Location: ./chemist/chemist1.php');
		die();
	}
	if ($_SESSION['module'] === 'admin') {
		header('Location: ./Admin/');
		die();
	}
}

include './api/loginApi.php';

?>

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

			<?php
				if (isset($_POST["submit"])) {
	
					$object = new loginApi($_POST["uname"], $_POST["passw"], $_POST["module"]);
					$message = $object->validator();					

					$code = $message['code'];
					
					if ($code != 200) {
						echo "<div class='alert alert-danger'><strong>Invalid Credentials</strong>.</div>";
					} else {

						$_SESSION['module'] = $_POST['module'];
						$_SESSION['id'] = $message['id'];
						$_SESSION['uname'] = $_POST['uname'];

						if ($_POST['module'] === 'patient') {
							header('Location: ./Patient/patient.php');
							die();
						}

						if ($_POST['module'] === 'reception') {
							header('Location: ./Reception/recep2.php');
						}

						if ($_POST['module'] === 'doctor') {
							header('Location: ./Doctor/doctor.php');
							
						}

						if ($_POST['module'] === 'medr') {
							header('Location: ./MedicalR/mr.php');
							
						}

						if ($_POST['module'] === 'chemist') {
							header('Location: ./Chemist/chemist1.php');
							die();
						}

						if ($_POST['module'] === 'admin') {
							header('Location: ./Admin/');
								
						}
					}
				} 
			?>

			<form method="POST" autocomplete="off" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<select class="custom-select" id="table" name="module">
					<option>Select Module</option>
					<option value="patient">Patient</option>
					<option value="doctor">Doctor</option>
					<option value="reception">Receptionist</option>
					<option value="chemist">Chemist</option>
					<option value="medr">Medical Representative</option>
					<option value="admin">Admin</option>
				</select>
				<div class="form-group">
					<label>Username</label>
					<input class="form-control" autocomplete="off" id="uname" type="text" name="uname" placeholder="Username">

					<label>Password</label> 
					<input class="form-control" autocomplete="off" id="passw" type="password" name="passw" placeholder="Password">

					<button type="submit" name="submit" class="btn btn-primary mt-5" value="submit">Login Here</button>
					<label class="forgot-password"><a href="./forgotPassword.php">Forgot Password?</a></label>
				</div>
			</form>
			<hr>
		</div>
	</div>


</body>
</html>