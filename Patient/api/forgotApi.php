<?php

class forgotPasswordApi {

	private $email;

	private $password;

	private $emailError = false;

	private $passwordError = false;

	public function __construct($email,$password) {
		$this->email = $email;
		$this->password = $password;
	}
	

	public function validator() {
		 $emailError = false;
		$passwordError = false;

		if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) 
		{
			$emailError = true;
		}
		if(!isset($this->password)){
			$passwordError = true;
		}
        if (($emailError === true) || ($passwordError === true)) 
		{
			$response = array(
				"code" => 500,
				"status" => "Invalid Data",
				"message" => "Invalid Text Fields"
			);

			return json_encode($response, JSON_PRETTY_PRINT);
        }
       else 
	   {
            $response = array(
                "code" => 600,
                "status" => "Valid Data",
                "message" => "Valid Text Fields"
			);
			header('Location: mail.php');
            return json_encode($response, JSON_PRETTY_PRINT);
    	}
	}
}
if (isset($_POST["submit"])) {
	
	$object = new forgotPasswordApi($_POST["email"],$_POST["password"]);

	$result = $object->validator();

	$result1 = json_encode($result, JSON_PRETTY_PRINT);

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