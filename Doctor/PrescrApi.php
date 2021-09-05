<?php

include '../config.php';

if (isset($_POST['submit'])) {
	
	$str = $_POST['med'];
	$aptId = (int)$_POST['aptId'];
	$added = false;
	
	if (!empty($str) && !empty($aptId)) {
		$stmt = "SELECT apt_id FROM prescription WHERE apt_id = $aptId";
		$result = $conn->query($stmt);
		$row = $result->fetch_assoc();

		if ($result->num_rows >= 1) {
			$stmt = "UPDATE prescription SET med = '$str' WHERE apt_id = $aptId";
			if ($conn->query($stmt) === TRUE) {
				$added = true;
			} else {
				echo "Error :-> ".$conn->error;
				$added = false;
			}
		} else {
			$stmt = "INSERT INTO prescription(apt_id, med) VALUES('$aptId', '$str')";

			if ($conn->query($stmt) === TRUE) {
				$added = true;
			} else {
				echo "Error :-> ".$conn->error;
				$added = false;
			}
		}
		
	} 
}

?>
<div class="msg mt-3 mb-5">
	<?php
		if ($added === true) {
	?>
			<div class="alert alert-success">
			  	<strong>Prescription Added!</strong><a href="./doctorAllAppointments.php" class="alert-link"> Go to Appointments</a>
			</div>
	<?php
		} else {
	?>
			<div class="alert alert-danger">
			  	<strong>Something went wrong!</strong>
			</div>
	<?php
		}
	?>
</div>