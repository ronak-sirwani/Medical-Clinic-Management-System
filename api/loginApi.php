<?php

class loginApi {

	private $uname;
	private $passw;
	private $module;

	private $unameError = false;
	private $passwError = false;
	private $moduleError = false;

	public function __construct($uname, $passw, $module) {

		$this->uname = $uname;
		$this->passw = $passw;
		$this->module = $module;

	}

	public function connect() {

		$conn = new mysqli("localhost", "root", "shrey123", "id15191429_hms");

		if ($conn->connect_error) {
			die("Connection Error :-> ".$conn->connect_error);
		} else {
			return $conn;
		}

	}

	public function connector() {

		/*
		* Add no of rows
		*according to the modules
		*/

		$hashPassw = md5($this->passw).'@123#';


		if ($this->module === 'patient') {
			$sql = "SELECT * FROM $this->module WHERE (p_uname='$this->uname'OR p_email='$this->uname') AND p_passw='$hashPassw'";
		}

		if ($this->module === 'doctor') {
			$sql = "SELECT * FROM $this->module WHERE (d_uname='$this->uname'OR d_email='$this->uname') AND d_passw='$hashPassw'";
		}

		if ($this->module === 'reception') {
			$sql = "SELECT * FROM $this->module WHERE (r_uname='$this->uname'OR r_email='$this->uname') AND r_passw='$hashPassw'";
		}

		if ($this->module === 'chemist') {
			$sql = "SELECT * FROM $this->module WHERE (ch_uname='$this->uname'OR ch_email='$this->uname') AND ch_passw='$hashPassw'";
		}

		if ($this->module === 'medr') {
			$sql = "SELECT * FROM $this->module WHERE (mr_uname='$this->uname'OR mr_email='$this->uname') AND mr_passw='$hashPassw'";
		}

		if ($this->module === 'admin') {
			$sql = "SELECT * FROM $this->module WHERE (ad_uname='$this->uname'OR ad_email='$this->uname') AND ad_passw='$hashPassw'";
		}



		$result = $this->connect()->query($sql);
		$checkResult = mysqli_num_rows($result);

		if ($checkResult < 1) {
			$response = array(
				"code" => 501,
				"status" => "Internal Error",
				"message" => "Invalid Credentials"
			);

			return json_encode($response, JSON_PRETTY_PRINT);
		} else {

			if ($row = mysqli_fetch_assoc($result)) {
				if ($this->module === 'patient') {
					$response = array(
						"code" => 200,
						"status" => "Valid Credentials",
						"message" => "Valid Credentials",
						"id" => $row["p_id"]
					);
				}

				if ($this->module === 'doctor') {
					$response = array(
						"code" => 200,
						"status" => "Valid Credentials",
						"message" => "Valid Credentials",
						"id" => $row["d_id"]
					);
				}

				if ($this->module === 'reception') {
					$response = array(
						"code" => 200,
						"status" => "Valid Credentials",
						"message" => "Valid Credentials",
						"id" => $row["r_id"]
					);
				}

				if ($this->module === 'medr') {
					$response = array(
						"code" => 200,
						"status" => "Valid Credentials",
						"message" => "Valid Credentials",
						"id" => $row["mr_id"],
					);
				}

				if ($this->module === 'chemist') {
					$response = array(
						"code" => 200,
						"status" => "Valid Credentials",
						"message" => "Valid Credentials",
						"id" => $row["ch_id"],
					);
				}

				if ($this->module === 'admin') {
					$response = array(
						"code" => 200,
						"status" => "Valid Credentials",
						"message" => "Valid Credentials",
						"id" => $row["ad_id"]
					);
				}
			}
		}

		return $response;
	}

	public function validator() {

		if (empty($this->uname)) {
			$unameError = true;
		} 

		if (empty($this->passw)) {
			$passwError = true;
		}

		if ($this->module == "Select Module") {
			$moduleError = true;
		}

		if ($unameError === true || $passwError === true || $moduleError === true) {
			$response = array(
				"code" => 500,
				"status" => "invalid",
				"message" => "Invalid Credentials",
			);

			return json_encode($response,JSON_PRETTY_PRINT);
		} else {
			return $this->connector();
		}
		
	}
}


?>
