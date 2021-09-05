<?php

if(isset($_POST['form_submit'])){
	
	$a_id= $_POST['apt_id'];
	$a_status= $_POST['apt_status'];

	include '../config.php';
	$mysqli = $conn;

	// SQL query to select data from database
	$sql = "UPDATE appointment SET apt_status='".$a_status."' WHERE apt_id='".$a_id."'";

	$result = $mysqli->query($sql);

	$mysqli->close();
}

?>