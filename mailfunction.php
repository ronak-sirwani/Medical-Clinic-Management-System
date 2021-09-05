<?php
error_reporting();
require 'phpmailer/PHPMailerAutoload.php';
function mailer($from,$to,$subject,$body) {

	$mail = new PHPMailer; 

	$mail->SMTPDebug = 0;                            
	
	$mail->isSMTP();                                   
	
	$mail->Host = 'smtp.gmail.com';                        
	$mail->SMTPAuth = true;                              
	$mail->Username = 'degroup2020@gmail.com';     
	$mail->Password = 'DEG@2021';                          
	
	$mail->SMTPSecure = 'tls';                          
	$mail->Port = 587;
	
	$mail->isHTML(true); 
	
	$mail->setFrom($from);
	$mail->addAddress($to);
	
	$mail->Subject = "$subject";
	$mail->Body = "$body";
	
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {

	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	
	} 
	
}

?>