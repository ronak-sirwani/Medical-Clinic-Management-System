<?php

class forgotPasswordApi {

	private $email;

	private $emailError = false;

	public function __construct($email) {
		$this->email = $email;
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

	public function validator() {
		 $emailError = false;

		if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) 
		{
			$emailError = true;
		}
        if ($emailError === true) 
		{
			$response = array(
				"code" => 500,
				"status" => "Invalid Data",
				"message" => "Invalid Text Fields"
			);

			return json_encode($response, JSON_PRETTY_PRINT);
        }
       else 
	   {/*
            $response = array(
                "code" => 600,
                "status" => "Valid Data",
                "message" => "Valid Text Fields"
			);

            return json_encode($response, JSON_PRETTY_PRINT);
		*/
			header('Location: mail.php');
    	}
	}
}
if (isset($_POST["submit"])) {
	
	$object = new forgotPasswordApi($_POST["email"]);

	$result = $object->validator();

	$result1 = json_encode($result, JSON_PRETTY_PRINT);

	$code = $message->{'code'};

	echo "<pre>".$result."</pre>";

} else {

	$result = array(
		"code" => 300,
		"status" => "Access Error",
		"message" => "Bad Request",
	);

	$result = json_encode($result, JSON_PRETTY_PRINT);

	echo "<pre>".$result."</pre>";

}

?>