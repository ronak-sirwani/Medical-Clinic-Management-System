<?php

include '../mailfunction.php';

class bookAppointmentApi {

	private $fname;
	private $lname;
	private $email;
	private $email2;
	private $mobile;
	private $date;
	private $doctor;
	private $timeslot;

	private $nameError = false;
	private $emailError = false;
	private $mobileError = false;
	private $dateError = false;
	private $doctorError = false;
	private $timeslotError = false;

	public function __construct($fname, $lname, $email, $email2, $mobile, $date, $doctor, $timeslot) {

		$this->fname = $fname;
		$this->lname = $lname;
		$this->email2 = $email2;
		$this->email = $email;
		$this->mobile = $mobile;
		$this->date = $date;
		$this->doctor = $doctor;
		$this->timeslot = $timeslot;

	}

	public function connect() {

		$conn = new mysqli("localhost", "root", "shrey123", "id15191429_hms");

		if ($conn->connect_error) {
			die('Connection Error :-> '.$conn->connect_error);
		} else {
			return $conn;
		}
	
	}

	public function getUname($module, $uname, $passw) {
	
		$stmt = "SELECT COUNT(*) FROM $module";
		$result = $this->connect()->query($stmt);
		
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


	public function queryDatabase() {

		$name = '';
		$name = $this->fname.' '.$this->lname;

		$timeslots = array(
			"s1" => "10:00am - 11:00am",
			"s2" => "11:00am - 12:00pm",
			"s3" => "12:00pm - 1:00pm",
			"s4" => "1:00pm - 2:00pm",
			"s5" => "2:00pm - 3:00pm",
			"s6" => "3:00pm - 4:00pm",
			"s7" => "4:00pm - 5:00pm",
		);

		$this->timeslot = array_search($this->timeslot, $timeslots);

		$conn = $this->connect();

		$stmt = "SELECT p_id FROM patient WHERE p_email='$this->email'";
		$result = $this->connect()->query($stmt);

		if ($result->num_rows <= 0) {
			$stmt = "SELECT d_id FROM doctor WHERE d_email='$this->email'";
			$result = $this->connect()->query($stmt);

			if ($result->num_rows <= 0) {
				$stmt = "SELECT r_id FROM reception WHERE r_email='$this->email'";
				$result = $this->connect()->query($stmt);

				if ($result->num_rows <= 0) {
					$stmt = "SELECT ad_id FROM admin WHERE ad_email='$this->email'";
					$result = $this->connect()->query($stmt);

					if ($result->num_rows <= 0) {
						
						$stmt = "SELECT * FROM `nextpatient`";
						$result = $this->connect()->query($stmt);
						$row = $result->fetch_assoc();

						$addUser = $this->getUname("patient", (int)$row['np_uname'], (int)$row['np_passw']);
						$newUname = $addUser['uname'];
						$newPassw = $addUser['hashPassw'];

						$stmt = "INSERT INTO patient(p_uname,p_name,p_email,p_mobile,p_passw)
								 VALUES ('$newUname','$name','$this->email','$this->mobile','$newPassw')";

						if ($conn->query($stmt) === TRUE) {
							$stmt = "SELECT p_id FROM patient WHERE p_email ='$this->email'";
							$result = $conn->query($stmt);

							$row = $result->fetch_assoc();

							$patientId = $row['p_id'];

							$stmt = "INSERT INTO appointment (p_id,apt_name,apt_email,apt_mobile,apt_date,apt_slot,d_id)
				 					 SELECT '$patientId','$name','$this->email','$this->mobile','$this->date','$this->timeslot',d_id 
               	 					 FROM doctor 
                 					 WHERE d_name='$this->doctor'";

							if ($conn->query($stmt) === TRUE) {
								
								$response = array(
									"code" => 200,
									"status" => "Appoitment Booked",
									"message" => "Appointment Booked",
								);
								mailer("degroup2020@gmail.com",$this->email,"Credentials","<h3>Credentials For Login</h3>"."<p>Please use this credential for login</p>"."<b>Username : ".$addUser['uname']."<b><br>"."<b>Password : ".$addUser['passw']."</b><br><br>Thanks,<br>From HMS Production Team.");

								return $response;

							} else {

								$response = array(
									"code" => 400,
									"status" => "Database Error",
									"message" => $conn->error,
								);

								return $response;
							}
							
						} else {
							$response = array(
								"code" => 500,
								"status" => "Record Not Added",
								"message" => "Error :- ".$conn->error,
							);
						}
						return $response;
					} else {

						$stmt = "SELECT ad_id FROM admin WHERE ad_email ='$this->email'";
						$result = $conn->query($stmt);

						$row = $result->fetch_assoc();

						$patientId = $row['ad_id'];

						$stmt = "INSERT INTO appointment (p_id,apt_name,apt_email,apt_mobile,apt_date,apt_slot,d_id)
				 				 SELECT '$patientId','$name','$this->email','$this->mobile','$this->date','$this->timeslot',d_id 
               	 				 FROM doctor 
                 				 WHERE d_name='$this->doctor'";

						if ($conn->query($stmt) === TRUE) {
								
							$response = array(
								"code" => 200,
								"status" => "Appoitment Booked",
								"message" => "Appointment Booked",
							);

						} else {

							$response = array(
								"code" => 400,
								"status" => "Database Error",
								"message" => $conn->error,
							);
						}
						return $response;
					}
				} else {

					$stmt = "SELECT r_id FROM reception WHERE r_email ='$this->email'";
					$result = $conn->query($stmt);

					$row = $result->fetch_assoc();

					$patientId = $row['r_id'];

					$stmt = "INSERT INTO appointment (p_id,apt_name,apt_email,apt_mobile,apt_date,apt_slot,d_id)
				 			 SELECT '$patientId','$name','$this->email','$this->mobile','$this->date','$this->timeslot',d_id 
               	 			 FROM doctor 
                 			 WHERE d_name='$this->doctor'";

					if ($conn->query($stmt) === TRUE) {
								
						$response = array(
							"code" => 200,
							"status" => "Appoitment Booked",
							"message" => "Appointment Booked",
						);

					} else {

						$response = array(
							"code" => 400,
							"status" => "Database Error",
							"message" => $conn->error,
						);
					}
					return $response;
				}
			} else {
				
				$stmt = "SELECT d_id FROM doctor WHERE d_email ='$this->email'";
				$result = $conn->query($stmt);

				$row = $result->fetch_assoc();

				$patientId = $row['d_id'];

				$stmt = "INSERT INTO appointment (p_id,apt_name,apt_email,apt_mobile,apt_date,apt_slot,d_id)
						 SELECT '$patientId','$name','$this->email','$this->mobile','$this->date','$this->timeslot',d_id 
               			 FROM doctor 
                		 WHERE d_name='$this->doctor'";

				if ($conn->query($stmt) === TRUE) {
								
					$response = array(
						"code" => 200,
						"status" => "Appoitment Booked",
						"message" => "Appointment Booked",
					);

				} else {

					$response = array(
						"code" => 400,
						"status" => "Database Error",
						"message" => $conn->error,
					);
				}
				return $response;

			}
		} else {
			$stmt = "SELECT p_id FROM patient WHERE p_email ='$this->email'";
			$result = $conn->query($stmt);

			$row = $result->fetch_assoc();

			$patientId = $row['p_id'];

			$stmt = "INSERT INTO appointment (p_id,apt_name,apt_email,apt_mobile,apt_date,apt_slot,d_id)
					 SELECT '$patientId','$name','$this->email','$this->mobile','$this->date','$this->timeslot',d_id 
            		 FROM doctor 
               		 WHERE d_name='$this->doctor'";

			if ($conn->query($stmt) === TRUE) {
								
				$response = array(
					"code" => 200,
					"status" => "Appoitment Booked",
					"message" => "Appointment Booked",
				);

			} else {

				$response = array(
					"code" => 400,
					"status" => "Database Error",
					"message" => $conn->error,
				);
			}
			return $response;
		}

	}

	public function validator() {

		if (empty($this->email2)) {
			if (empty($this->fname || empty($this->lname))) {
				$nameError = true;
			}

			if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
				$emailError = true;
			}

			if (empty($this->mobile) || !is_numeric($this->mobile) || strlen($this->mobile) < 10 || strlen($this->mobile) > 10) {
				$mobileError = true;
			}

			if (empty($this->date) || $this->date < $todayDate) {
				$dateError = true;
			} else {
				$tempDate = explode('-', $this->date);
				$currentDate = date('y-m-d');
				$currentDate = explode('-', $currentDate);
				
				if ((int)$tempDate[0] >= (int)$currentDate[0]) {
					if ((int)$tempDate[1] >= (int)$currentDate[1] ) {
						if ((int)$tempDate[2] >= (int)$currentDate[2]) {
							$dateError = false;
						} else {
							$dateError = true;
						}
					} else {
						$dateError = true;
					}
				} else {
					$dateError = true;
				}
			}

			if ($this->doctor === 'Select Doctor') {
				$doctorError = true;
			}
			$doctorTemp = explode(" ", $this->doctor); 
			$this->doctor = $doctorTemp[0]." ".$doctorTemp[1];

			if ($this->timeslot === 0) {
				$timeslotError = true;
			}

			if ($nameError === true || $emailError === true || $mobileError === true || $dateError === true || $doctorError === true || $timeslotError === true) {
				
				$response = array(
					"code" => 500,
					"status" => "Invalid Data",
					"message" => "Invalid Text Fields",
					'Name' => $nameError,
					'Email' => $emailError,
					'Mobile' => $mobileError,
					'Date' => $dateError,
					'Doctor' => $doctorError,
					'Slot' => $timeslotError,
				);

				return $response;
			} else {
				return $this->queryDatabase();
			}
		} else {
			$response = array(
				"code" => 500,
				"status" => "Invalid Data",
				"message" => "Invalid Text Fields",
				"spam" => TRUE,
			);
			return $response;
		}
	}
}

// if (isset($_POST["submit"])) {
	
// 	$object = new bookAppointmentApi($_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["mobile"], $_POST["date"], $_POST["doctor"], $_POST["timeslot"]);

// 	$result = $object->validator();

// 	$result = json_decode($result);

// 	var_dump($result);

// } else {

// 	$result = array(
// 		"code" => 300,
// 		"status" => "Access Error",
// 		"message" => "Bad Request",
// 	);

// 	$result = json_encode($result, JSON_PRETTY_PRINT);

// 	echo "<pre>".$result."</pre>";

// }

?>