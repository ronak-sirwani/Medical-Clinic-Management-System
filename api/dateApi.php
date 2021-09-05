<?php

include '../config.php';

function giveSlots($today) {

	$basics = array(
		"s1" => "10:00am - 11:00am",
		"s2" => "11:00am - 12:00pm",
		"s3" => "12:00pm - 1:00pm",
		"s4" => "1:00pm - 2:00pm",
		"s5" => "2:00pm - 3:00pm",
		"s6" => "3:00pm - 4:00pm",
		"s7" => "4:00pm - 5:00pm",
	);

	$conn = new mysqli("localhost", "root", "shrey123", "id15191429_hms");

	if ($conn->connect_error) {
		die('Connection Error :-> '.$conn->connect_error);
	} 

	$slots = array();

	for ($i=1; $i <= 7; $i++) { 

		$temp = "s".$i;
		
		$stmt = "SELECT COUNT(*) FROM appointment WHERE apt_slot='$temp' AND apt_date='$today'";
		$result = $conn->query($stmt);
		
		$data = $result->fetch_assoc();

		if ((int)$data['COUNT(*)'] < 10) {
			array_push($slots, $temp);
		} 
	}

	return $slots;
}

$date = $_POST['date'];
$doctor = $_POST['doctor'];
$doctor = explode(' ', $doctor);
$doctor = $doctor[0].' '.$doctor[1];

$basics = array(
	"s1" => "10:00am - 11:00am",
	"s2" => "11:00am - 12:00pm",
	"s3" => "12:00pm - 1:00pm",
	"s4" => "1:00pm - 2:00pm",
	"s5" => "2:00pm - 3:00pm",
	"s6" => "3:00pm - 4:00pm",
	"s7" => "4:00pm - 5:00pm",
);


$stmt = "SELECT d_id FROM doctor WHERE d_name='$doctor'";
$result = $conn->query($stmt);
$dId = $result->fetch_assoc();
$dId = $dId['d_id'];

$stmt = "SELECT * FROM slots WHERE d_id='$dId'";
$getSlot = $conn->query($stmt);
$states = $getSlot->fetch_all(MYSQLI_ASSOC);
$states = $states[0];

$chekedSlots = giveSlots($date);

$temp = 1;
$letter = 's';

$finalSlots = [];

$count = count($states);

echo "<select class='custom-select mt-3' autocomplete='off' id='timeslot' name='timeslot'>";
echo "<option>Select Slot</option>";
foreach ($chekedSlots as $key => $value) {
	if ($states[$value] === '1') {
		echo '<option>'.$basics[$value].'</option>';
	}
}
echo "</select>";
?>

<script>
	$(document).ready(function() {
		$('#tempSlot').remove();
	})
</script>
