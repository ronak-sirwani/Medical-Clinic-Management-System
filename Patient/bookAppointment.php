<?php

include "./api/bookAppointmentApi.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Book Appointment</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">

	<link href="./css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>

	<!-- Loading custom stylesheet -->
	<link href="./css/custom/appointment.css" rel="stylesheet">
</head>
<body>

	<script>
		
		function rollDice(e) {
			if ( e.value == "Select Doctor" ) {
				$('#timeslot').attr("disabled", true);
			} else {
				$('#timeslot').attr("disabled", false);
			}
		}

	</script>

	<div class="container">
		<div class="wrapper">
			<div class="wrapper-header text-center">
				<h3 style="font-weight: 700;">Book Appointment</h3>
				<hr>
			</div>
			<?php
				if (isset($_POST['submit'])) {
					$object = new bookAppointmentApi($_POST["fname"], $_POST["lname"], $_POST['email'] , $_POST["mobile"], $_POST["date"], $_POST["doctor"], $_POST["timeslot"]);
					$result = $object->queryDatabase();
					print_r($result);
				}
			?>
			<div class="alert alert-danger">
				<strong>Invalid Text Fields</strong>
			</div>

			<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				
				<div class="form-group">
					<div class="row mt-3">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<input class="form-control" autocomplete="off" id="fname" type="text" name="fname" placeholder="First Name">
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 lname">
							<input class="form-control" autocomplete="off" id="lname" type="text" name="lname" placeholder="Last Name">
						</div>
					</div>

					<input class="form-control mt-3" autocomplete="off" id="email" type="text" name="email" placeholder="Email Address">
					
					<input class="form-control mt-3" autocomplete="off" id="mobile" type="text" name="mobile" placeholder="Mobile Number">

					<input class="form-control mt-3" autocomplete="off" id="date" type="date" name="date">

					<?php

					?>

					<select class="custom-select mt-3" autocomplete="off" id="table" name="doctor" onchange="rollDice(this);">
						<option>Select Doctor</option>
						<option>Doctor 1</option>
						<option>Doctor 2</option>
						<option>Doctor 3</option>
					</select>

					<select class="custom-select mt-3" autocomplete="off" id="timeslot" name="timeslot" disabled="true">
						<option>Select Timeslot</option>
						<option>Timeslot 1</option>
						<option>Timeslot 2</option>
						<option>Timeslot 3</option>
					</select>

					<button type="submit" name="submit" class="btn btn-primary mt-5" value="submit">Book Appointment</button>
					
				</div>
			</form>
			<hr>
		</div>
	</div>
</body>
</html>