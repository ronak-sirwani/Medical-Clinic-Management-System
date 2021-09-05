<?php

include '../../../config.php';
include '../../../mailfunction.php';

function getUname($module, $uname, $passw) {
	
	$connect = new mysqli("localhost", "root", "shrey123", "id15191429_hms");

	if ($connect->connect_error) {
		die('Connection Error :-> '.$connect->connect_error);
	} 

	$stmt = "SELECT COUNT(*) FROM $module";
	$result = $connect->query($stmt);
		
	$row = $result->fetch_assoc();
	
	$count = (int)$row['COUNT(*)'];
	$count += 1;

	$temp1 = $uname + $count; 
	$temp2 = $passw + $count;

	$resultUname = "hms".$temp1;
	$resultPassw = $temp2;

	$data = array(
		"uname" => $resultUname,
		"passw" => $resultPassw,
		"hashPassw" => md5($resultPassw).'@123#',
	);	

	return $data;
}

if (isset($_POST['submit'])) {

	$module = $_POST['module'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$desig = $_POST['desig'];

	$emptyError = false;
	$emailError = false;
	$mobileError = false;
	$desigError = false;

	if (empty($name) || empty($email) || empty($mobile) || $module === 'Select Staff') {
		$emptyError = true;
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emptyError = true;
	}

	if (strlen($mobile) != 10) {
		$mobileError = true;
	}

	if ($module === 'doctor') {
		if (empty($desig)) {
			$desigError = true;
		}
	}

	if ($emailError === true || $mobileError === true || $desigError === true) {
		echo "<div class='alert alert-danger'><strong>Invalid Data!</strong></div>";
	}

	if ($emailError === false && $mobileError === false && $desigError === false && $emptyError === false) {

		$tempModule = 'next'.$module;

		$stmt = "SELECT * FROM $tempModule";
		$result = $conn->query($stmt);

		$row = $result->fetch_assoc();

		if ($module === 'doctor') {
			$nextUname = $row['nd_uname'];
			$nextPassw = $row['nd_passw'];
		}

		if ($module === 'reception') {
			$nextUname = $row['nr_uname'];
			$nextPassw = $row['nr_passw'];
		}

		if ($module === 'admin') {
			$nextUname = $row['nad_uname'];
			$nextPassw = $row['nad_passw'];
		}

		$nextUname = (int)$nextUname;
		$nextPassw = (int)$nextPassw;

		$addUser = getUname($module, $nextUname, $nextPassw);
		
		$nextUname = $addUser['uname'];
		$nextPassw = $addUser['passw'];
		$nextHashPassw = $addUser['hashPassw'];

		$perfection = false;

		if ($module === 'doctor') {
			$stmt = "INSERT INTO doctor (d_name, d_uname, d_desig, d_email, d_mobile, d_passw)
					 VALUES ('$name', '$nextUname', '$desig', '$email','$mobile', '$nextHashPassw')";
			if ($conn->query($stmt) === TRUE) {
				$stmt = "INSERT INTO slots (d_id) SELECT doctor.d_id FROM doctor WHERE doctor.d_uname='$nextUname'";
				if ($conn->query($stmt) === TRUE) {
					$perfection = true;
				} else {
					echo "Error :-> ".$conn->error;
				}
			} 
		}

		if ($module === 'reception') {
			$stmt = "INSERT INTO reception (r_name, r_uname, r_email, r_mobile, r_passw)
					 VALUES ('$name', '$nextUname','$email','$mobile', '$nextHashPassw')";
			if ($conn->query($stmt) === TRUE) {
				$perfection = true;
			} 
		}

		if ($module === 'admin') {

			$stmt = "INSERT INTO admin (ad_name, ad_uname, ad_email, ad_mobile, ad_passw)
					 VALUES ('$name', '$nextUname','$email','$mobile', '$nextHashPassw')";
			
			if ($conn->query($stmt) === TRUE) {
				$perfection = true;
			} 
		}

		if ($perfection === true) {
			echo "<div class='alert alert-success'><strong>Record Added!</strong></div>"; 
			mailer("degroup2020@gmail.com",$email,"Credentials","<h3>Credentials For Login</h3>"."<p>Please use this credential for login</p>"."<b>Username : ".$nextUname."<b><br>"."<b>Password : ".$nextPassw."</b><br><br>Thanks,<br>From HMS Production Team.");
		} else {
			echo "<div class='alert alert-danger'><strong>Database Connection Error!</strong></div>";
		}
	}

}

?>
