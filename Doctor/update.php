<?php

if(isset($_POST['form_submit'])){
	
	$a_id= $_POST['m_name'];
	$a_status= $_POST['m_status'];
    /*
    if($a_status==="pending"){
        $a_status = 0;
    }
    elseif($a_status==="accepted"){
        $a_status = 1;
    }
    else{
        $a_status = 2;
    }
    */
    

	include 'connection.php';
	$mysqli = $conn;

	// SQL query to select data from database
	$sql = "UPDATE medicine SET m_status='".$a_status."' WHERE m_name='".$a_id."'";

	$result = $mysqli->query($sql);

	$mysqli->close();
}

?>