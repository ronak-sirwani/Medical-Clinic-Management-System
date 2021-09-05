<?php

include '../../config.php';
include '../../mailfunction.php';

function getUname($module, $uname, $passw) {

	$conn = new mysqli("localhost", "root", "shrey123", "id15191429_hms");

	if ($conn->connect_error) {
		die('Connection Error :-> '.$conn->connect_error);
	} 
	
	$stmt = "SELECT COUNT(*) FROM $module WHERE is_approved = 1";
	$result = $conn->query($stmt);
		
	$row = $result->fetch_assoc();
		
	$count = (int)$row['COUNT(*)'];
	$count += 1;
	
	$temp1 = $uname + $count; 
	$temp2 = $passw + $count;

	if ($module === 'chemist') {
		$resultUname = "hmsc".$temp1;
		$resultPassw = "ch".$temp2;
	}

	if ($module === 'medr') {
		$resultUname = "hmsmr".$temp1;
		$resultPassw = "mr".$temp2;
	}

	$data = array(
		"uname" => $resultUname,
		"passw" => $resultPassw,
		"hashPassw" => md5($resultPassw).'@123#',
	);	

	return $data;
}

$type = $_POST['type'];
$data = $_POST['data'];

$data = explode('.', $data);

$module = $data[0];
$id = (int)$data[1];

if ($type === 'accept') {
	if ($module === 'chemist') {
		$stmt = "SELECT * FROM nextchemist";
		$result = $conn->query($stmt);
		$row = $result->fetch_assoc();

		$uname = (int)$row['nch_uname'];
		$passw = (int)$row['nch_passw'];

		$getData = getUname($module, $uname, $passw);
		$uname = $getData['uname'];
		$passw = $getData['passw'];
		$hashPassw = $getData['hashPassw'];

		$stmt = "SELECT ch_email FROM chemist WHERE ch_id = $id";
		$result = $conn->query($stmt);
		$row = $result->fetch_assoc();
		$email = $row['ch_email'];

		$stmt = "UPDATE chemist SET is_approved = 1, ch_uname = '$uname', ch_passw = '$hashPassw' WHERE ch_id = $id;";

		mailer("degroup2020@gmail.com",$email,"Credentials","<h3>Request access granted</h3>"."<p>Please use this credential for login</p>"."<b>Username : ".$uname."<b><br>"."<b>Password : ".$passw."</b><br><br>Direct Login :- <a href='http://localhost/HMS/login.php'>here</a><br><br>Thanks,<br>From HMS Production Team.");
	}

	if ($module === 'medr') {
		$stmt = "SELECT * FROM nextmr";
		$result = $conn->query($stmt);
		$row = $result->fetch_assoc();

		$uname = (int)$row['nmr_uname'];
		$passw = (int)$row['nmr_passw'];

		$getData = getUname($module, $uname, $passw);
		$uname = $getData['uname'];
		$passw = $getData['passw'];
		$hashPassw = $getData['hashPassw'];

		$stmt = "SELECT mr_email FROM medr WHERE mr_id = $id";
		$result = $conn->query($stmt);
		$row = $result->fetch_assoc();
		$email = $row['mr_email'];

		$stmt = "UPDATE medr SET is_approved = 1, mr_uname = '$uname', mr_passw = '$hashPassw' WHERE mr_id = $id;";

		mailer("degroup2020@gmail.com",$email,"Credentials","<h3>Request access granted</h3>"."<p>Please use this credential for login</p>"."<b>Username : ".$uname."<b><br>"."<b>Password : ".$passw."</b><br><br>Direct Login :- <a href='http://localhost/HMS/login.php'>here</a><br><br>Thanks,<br>From HMS Production Team.");
	}
}

if ($type === 'reject') {
	if ($module === 'chemist') {
		$stmt = "UPDATE chemist SET is_approved = 2 WHERE ch_id = $id;";
	}

	if ($module === 'medr') {
		$stmt = "UPDATE medr SET is_approved = 2 WHERE mr_id = $id;";
	}
}

if ($conn->query($stmt) === TRUE) {
	echo "Process Completed!";
} else {
	echo $conn->error;
}

?>
