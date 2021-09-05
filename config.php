<?php

$conn = new mysqli("localhost", "root", "shrey123", "id15191429_hms");

if ($conn->connect_error) {
	die('Connection Error :-> '.$conn->connect_error);
} 

?>