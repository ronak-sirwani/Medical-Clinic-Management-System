<?php
include '../config.php';

$timeslots = array(
	"s1" => "10:00am - 11:00am",
	"s2" => "11:00am - 12:00pm",
	"s3" => "12:00pm - 1:00pm",
	"s4" => "1:00pm - 2:00pm",
	"s5" => "2:00pm - 3:00pm",
	"s6" => "3:00pm - 4:00pm",
	"s7" => "4:00pm - 5:00pm",
);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin :: Appointments</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.css"/>
 
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.js"></script>

	<!-- Adding custom CSS file here -->
	<link rel="stylesheet" type="text/css" href="./css/admin-dash-style.css">
	<link rel="stylesheet" type="text/css" href="./css/manage-user-style.css">

	<!-- Adding Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/8e69dd82ea.js" crossorigin="anonymous"></script>

	<style>
		.admin-table {
			margin-top: 0;
			padding: 20px;
		}

		.table-responsive table {
			padding-left: 50px;
			padding-right: 50px;
			padding-bottom: 50px;
		}

		.manage-user-heading {
			margin-bottom: 45px!important;
		}
	</style>
</head>
<body>

	<div class="admin-table">
		<div class="manage-user-heading">
			<h3>All Appointments</h3>
		</div>
					
		<div class="table-responsive mt-4">
			<table class="table table-hover table-dark" id="test">
				<thead>
					<tr>
						<th>ID</th>
						<th>Booked By</th>
						<th>Patient Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Doctor Name</th>
						<th>Date</th>
						<th>Timeslot</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$stmt = "SELECT * FROM appointment";
						$result = $conn->query($stmt);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$doctorId = $row['d_id'];
								$stmt = "SELECT d_name from doctor WHERE d_id='$doctorId'";
								$check = $conn->query($stmt);
								$doctorName = $check->fetch_assoc();

								$checkID = (int)$row['p_id'];

								if ($checkID <= 10) {

									$tempPId = $row['p_id'];
									$query = "SELECT ad_name FROM admin WHERE ad_id=$tempPId";
									$result2 = $conn->query($query);
									$row2 = $result2->fetch_assoc();
									$bookedBy = $row2['ad_name'];
								
								} elseif ($checkID >= 11 && $checkID <= 20) {
									
									$tempPId = $row['p_id'];
									$query = "SELECT d_name FROM doctor WHERE d_id=$tempPId";
									$result2 = $conn->query($query);
									$row2 = $result2->fetch_assoc();
									$bookedBy = $row2['d_name'];
								
								} elseif ($checkID >= 21 && $checkID <= 40) {
								
									$tempPId = $row['p_id'];
									$query = "SELECT r_name FROM reception WHERE r_id=$tempPId";
									$result2 = $conn->query($query);
									$row2 = $result2->fetch_assoc();
									$bookedBy = $row2['r_name'];
								
								} elseif ($checkID >= 41) {

									$tempPId = $row['p_id'];
									$query = "SELECT p_name FROM patient WHERE p_id=$tempPId";
									$result2 = $conn->query($query);
									$row2 = $result2->fetch_assoc();
									$bookedBy = $row2['p_name'];
								
								} else {
									echo "Something Went Wrong!";
								}
								// var_dump($row);
					?>
								<tr>
									<td><?php echo $row['apt_id']; ?></td>
									<td><?php echo $bookedBy; ?></td>
									<td><?php echo $row['apt_name']; ?></td>
									<td><?php echo $row['apt_email']; ?></td>
									<td><?php echo $row['apt_mobile']; ?></td>
									<td><?php echo $doctorName['d_name']; ?></td>
									<td><?php echo $row['apt_date']; ?></td>
									<td><?php echo $timeslots[$row['apt_slot']]; ?></td>
									<td>
					<?php
									if ($row['apt_status'] === 'pending') {
										echo "<div class='pill pill-pending bg-secondary'><span>Pending</span></div>";
									} elseif ($row['apt_status'] === 'declined') {
										echo "<div class='pill pill-danger bg-danger'><span>Rejected</span></div>";
									} else {
										echo "<div class='pill pill-success bg-success'><span>Success</span></div>";
									}
					?>
									</td>
								</tr>
					<?php
							}
						}
									
					?>
				</tbody>
			</table>
		</div>
	</div>
	<script>
		$('#test').DataTable({ "pagingType": "simple_numbers" });
  		$('.dataTables_length').addClass('bs-select');
	</script>
</body>
</html>