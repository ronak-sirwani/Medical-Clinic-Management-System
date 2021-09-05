<?php

include '../config.php';

// function getUname($module, $uname, $passw) {

// 	$conn = new mysqli("localhost", "root", "shrey123", "id15191429_hms");

// 	if ($conn->connect_error) {
// 		die('Connection Error :-> '.$conn->connect_error);
// 	} 
	
// 	$stmt = "SELECT COUNT(*) FROM $module";
// 	$result = $conn->query($stmt);
		
// 	$row = $result->fetch_assoc();
		
// 	$count = (int)$row['COUNT(*)'];
// 	$count += 1;
	
// 	$temp1 = $uname + $count; 
// 	$temp2 = $passw + $count;

// 	if ($module === 'chemist') {
// 		$resultUname = "hmsc".$temp1;
// 		$resultPassw = "ch".$temp2;
// 	}

// 	if ($module === 'medr') {
// 		$resultUname = "hmsmr".$temp1;
// 		$resultPassw = "mr".$temp2;
// 	}

// 	$data = array(
// 		"uname" => $resultUname,
// 		"passw" => $resultPassw,
// 		"hashPassw" => md5($resultPassw).'@123#',
// 	);	

// 	return $data;
// }

if (isset($_POST['submit'])) {
	$module = $_POST['module'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	if ($_POST['sname']) {
		$sname = $_POST['sname'];
		$addr = $_POST['addr'];
	}

	if ($_POST['brand']) {
		$brand = $_POST['brand'];
	}
	
	$emptyError = false;
	$error = false;

	if (empty($module) || empty($name) || empty($email) || empty($mobile)) {
		$emptyError = true;
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = true;
	}

	if (strlen($mobile) != 10) {
		$error = true;
	}

	if ($emptyError === false && $error === false) {
		if ($module === 'chemist') {
			$stmt = "INSERT INTO chemist (ch_name,ch_email,ch_mobile,ch_shopName,ch_shopAddr) VALUES ('$name', '$email', '$mobile', '$sname', '$addr')";
		}
	 	
	 	if ($module === 'medr') {
	 		$stmt = "INSERT INTO medr (mr_name,mr_email,mr_mobile,mr_brand) 
	 		VALUES ('$name', '$email', '$mobile', '$brand')";
	 	}

	 	if ($conn->query($stmt)) {
	 		echo 1;
	 	} else {
	 		echo $conn->error;
	 	}	
	} else {
		echo 3;
	}

}

?>
