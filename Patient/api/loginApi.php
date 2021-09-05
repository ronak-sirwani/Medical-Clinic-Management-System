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
		$this->unameError = false;
		$this->passwError = false;
		$this->moduleError = false;

	}

	public function connect() {

		//$conn = new mysqli("localhost", "id14155642_root", "Shrey12345678$!", "id14155642_hms");
		$conn = new mysqli("localhost:3307","root","","hms6");
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

		return json_encode($response,JSON_PRETTY_PRINT);
	}

	public function validator() {

		if (empty($this->uname)) {
			$this->unameError = true;
		} 

		if (empty($this->passw)) {
			$this->passwError = true;
		}

		if ($this->module == "Select Module") {
			$this->moduleError = true;
		}

		if ($this->unameError === true || $this->passwError === true || $this->moduleError === true) {
			$response = array(
				"code" => 500,
				"status" => "invalid",
				"message" => "Invalid Credentials",
			);

			return json_encode($response,JSON_PRETTY_PRINT);
		} 
		
		if ($this->unameError === false && $this->passwError === false && $this->moduleError === false) {
			return $this->connector();
		} 
	}
}


?>
