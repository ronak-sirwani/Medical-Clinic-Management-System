<!DOCTYPE html>
<html>
<head>
	<title>Home :: HMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale = 1">

	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">

	<script type="text/javascript" src="./js/bootstrap.min.js"></script>

	<!-- Custom CSS Here -->
	<link rel="stylesheet" type="text/css" href="./css/custom/homePage.css">

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

	<section class="w-100 wrapper-home">
		<div class="appoint-div">
			<a href="./bookAppointment.php"><button class="btn btn-danger btn-lg">Book Appointment</button></a>
		</div>
	</section>

	<section class="w-100 wrapper-unique container">
		<div class="wrapper row">
			<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 order-first order-2 order-md-1">
				<div class="unique-header">
					<h2>Unique Points</h2>
					<h3>What are Unique Points?</h3>
					<p>Unique Points are basically points which describes your product better than other ones.</p>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 order-first order-1">
				<img src="https://wallpaperaccess.com/full/2927307.jpg" class="img-fluid">
			</div>
		</div>

		<div class="our-unique">
			<div class="our-unique-header">
				<h2>Our Unique Points</h2>
			</div>
			<div class="unique-points container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="points-block">
							<i class="fas fa-database"></i>
							<h3>Data Managing</h3>
							<p>We are arranging all the data structure wise, which cannot be tempered</p>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="points-block">
							<i class="fas fa-lock"></i>
							<h3>Best Security</h3>
							<p>We build a functionality that cross verifies each and every data</p>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
						<div class="points-block">
							<i class="fas fa-eye" style="margin-top: 23px;"></i>
							<h3>Premium Look</h3>
							<p>We tried our best to give best and we specially focussed on our UI and on Mobile Responsive.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</body>
</html>