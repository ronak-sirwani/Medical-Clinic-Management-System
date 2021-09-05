<!DOCTYPE html>
<html>
<head>
	<title>Request Access</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">

	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./js/jquery.min.js"></script>

	<!-- Custom CSS Here -->
	<link rel="stylesheet" type="text/css" href="./css/custom/login_style.css">

	<script src="https://kit.fontawesome.com/2fc6ba5c8f.js" crossorigin="anonymous"></script>

</head>
<body>

	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		<a class="navbar-brand" href="#">HMS</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>	
		
		<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
			<ul class="navbar-nav"> 
				<li class="nav-item">
					<a class="nav-link" style="margin-top: 6px;" href="./aboutus.php">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" style="margin-top: 6px;" href="./contactus.php">Contact Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" style="margin-top: 6px;" href="./registrar.php">Work</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./login.php"><button class="btn btn-outline-primary">Login</button></a>
				</li>
			</ul>
		</div>

	</nav>

	<div class="container">
		<div class="wrapper">
			<div class="wrapper-header text-center">
				<h3 style="font-weight: 700;">Hospital Management System</h3>
				<hr>
			</div>
			<div id="msg"></div>
			<?php

				if (isset($_POST['submit'])) {
					if ($_POST['module'] === 'Chemist') {
			?>
						<form id="cForm">
							<input type="text" name="name" placeholder="Full Name" class="form-control" value="<?php echo $_POST['name']; ?>" id="name">

							<input type="text" name="email" placeholder="Email Address" class="form-control mt-3" value="<?php echo $_POST['email']; ?>" id="email">
						
							<input type="text" name="mobile" placeholder="Mobile Number" class="form-control mt-3" value="<?php echo $_POST['mobile']; ?>" id="mobile">

							<input type="text" name="shopName" placeholder="Shop Name" class="form-control mt-3" value="<?php echo $_POST['shopName']; ?>" id="sname">

							<textarea class="form-control mt-3" placeholder="Shop Address" id="addr"></textarea>

							<button name="submit" value="submit" class="btn btn-info mt-3">Request Access</button>
						</form>
			<?php
					} elseif ($_POST['module'] === 'Medical Representative') {
			?>
						<form id="mrForm">
							<input type="text" name="name" placeholder="Full Name" class="form-control" value="<?php echo $_POST['name']; ?>" id="name">

							<input type="text" name="email" placeholder="Email Address" class="form-control mt-3" value="<?php echo $_POST['email']; ?>" id="email">
						
							<input type="text" name="mobile" placeholder="Mobile Number" class="form-control mt-3" value="<?php echo $_POST['mobile']; ?>" id="mobile">

							<input type="text" name="bdName" placeholder="Brand Name" class="form-control mt-3" value="<?php echo $_POST['bdName']; ?>" id="bdName">

							<button name="submit" value="submit" class="btn btn-info mt-3">Request Access</button>

						</form>
			<?php
					} else {
						echo "Form not generated!";
					}
				} else {
			?>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form">
						<select class="custom-select" id="module" name="module">
							<option>Select Type</option>
							<option>Chemist</option>
							<option>Medical Representative</option>
						</select>
						<button type="submit" class="btn btn-success mt-3" name="submit" value="submit">Generate Form</button>
					</form>
			<?php
				}
			?>
		</div>
	</div>
	<script>
		$('#cForm').on('submit', function(e) {
			e.preventDefault();
			
			var name = $('#name').val();
			var email = $('#email').val();
			var mobile = $('#mobile').val();
			var sname = $('#sname').val();
			var addr = $('#addr').val();

			$.ajax({
				type: 'POST',
				url: 'api/addChemist.php',
				data: {
					'submit': 'submit',
					'module': 'chemist',
					'name': name,
					'email': email,
					'mobile': mobile,
					'sname': 'sname',
					'addr': addr, 
				},
				success: function(msg) {
					if (msg === '1') {
						$('#msg').html("<div class='alert alert-success'><strong>Success.</strong> You will get response via from HMS Team shortly.");
					} else if (msg === '3') {
						$('#msg').html("<div class='alert alert-danger'><strong>Fields Error!</strong>");
					} else {
						$('#msg').html(msg);
					}
				}
			});
		})

		$('#mrForm').on('submit', function(e) {
			e.preventDefault();
			
			var name = $('#name').val();
			var email = $('#email').val();
			var mobile = $('#mobile').val();
			var brand = $('#bdName').val();

			$.ajax({
				type: 'POST',
				url: 'api/addChemist.php',
				data: {
					'submit': 'submit',
					'module': 'medr',
					'name': name,
					'email': email,
					'mobile': mobile,
					'brand': brand,
				},
				success: function(msg) {
					if (msg === '1') {
						$('#msg').html("<div class='alert alert-success'><strong>Success.</strong> You will get response via from HMS Team shortly.");
					} else if (msg === '3') {
						$('#msg').html("<div class='alert alert-danger'><strong>Fields Error!</strong>");
					} else {
						$('#msg').html(msg);
					}
				}
			});
		})
	</script>
</body>
</html>