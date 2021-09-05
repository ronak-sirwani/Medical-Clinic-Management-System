<?php

include "./api/bookAppointmentApi.php";
include "./config.php";
include "./mailfunction.php";

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
	<div class="container">
		<div class="wrapper">
			<div class="wrapper-header text-center">
				<h3 style="font-weight: 700;">Book Appointment</h3>
				<hr>
			</div>
			<?php
				if (isset($_POST['submit'])) {
					$object = new bookAppointmentApi($_POST["fname"], $_POST["lname"], $_POST['email'] ,$_POST['email2'], $_POST["mobile"], $_POST["date"], $_POST["doctor"], $_POST["timeslot"]);
					$result = $object->validator();

					if ($result['code'] != 200) {
			?>
						<div class="alert alert-danger">
							<strong>Invalid Text Fields</strong>
						</div>
			<?php
					} else {
			?>
						<div class="alert alert-success">
							<span><strong>Appointment Booked!</strong> Heading to login page in 3 seconds.</span>
						</div>
						<script>
							var redirect = setTimeout(function() {window.location.href = "./login.php"}, 3000);
						</script>
			<?php

					}
				}
			
			?>

			<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				
				<div class="form-group">
					<div class="row mt-3">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<input class="form-control" autocomplete="off" id="fname" type="text" name="fname" placeholder="First Name" value="<?php echo $_POST['fname']; ?>">
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 lname">
							<input class="form-control" autocomplete="off" id="lname" type="text" name="lname" placeholder="Last Name" value="<?php echo $_POST['lname']; ?>">
						</div>
					</div>

					<input class="form-control mt-3" autocomplete="off" id="email" type="text" name="email" placeholder="Email Address" value="<?php echo $_POST['email']; ?>">

					<input class="form-control mt-3" autocomplete="off" id="email2" type="hidden" name="email2" placeholder="Email Address" value="<?php echo $_POST['email']; ?>">
					
					<input class="form-control mt-3" autocomplete="off" id="mobile" type="text" name="mobile" placeholder="Mobile Number" value="<?php echo $_POST['mobile']; ?>">

					<input class="form-control mt-3" autocomplete="off" id="date" type="date" name="date" min="<?php echo date('d/m/y'); ?>" onchange="getDate(this)">

					<select class="custom-select mt-3" autocomplete="off" id="table" name="doctor" onchange="getDoctor(this)">
						<option>Select Doctor</option>
						<?php
							$stmt = "SELECT d_name, d_desig FROM doctor";
							$result = $conn->query($stmt);

							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									echo "<option>".$row["d_name"]." (".$row['d_desig'].")</option>";
								}
							} else {
								die('Something went wrong!');
							}
						?>
					</select>

					<select class="custom-select mt-3" autocomplete="off" id="tempSlot" name="timeslot" disabled="true">
						<option>Select Timeslot</option>
						
					</select>
					<div id="slot"></div>
					<button type="submit" name="submit" class="btn btn-primary mt-5" value="submit">Book Appointment</button>
					
				</div>
			</form>
			<hr>
		</div>
	</div>
	<script>
		let date = '';
		let doctor = '';

		function getSlots() {
			if (date != '' && doctor != '') {
				$('#slot').load('api/dateApi.php', {
					date: date,
					doctor: doctor,
				})
			}
			
		}
 
		function getDate(data) {
			date = data.value;
			getSlots();
		}

		function getDoctor(data) {
			doctor = data.value;

			getSlots();
		}
	</script>
</body>
</html>