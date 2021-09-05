<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<link href="./css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<link href="./Doctor/appointment.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="wrapper">
			<div class="wrapper-header text-center">
				<h3 style="font-weight: 700;">Forgot Password</h3>
				<hr>
			</div>
            <?php
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$conn = mysqli_connect("localhost","root","shrey123","id15191429_hms");
    if(isset($_POST['submit'])) {

        $email = $_POST['email'];

        if( !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $stmt = "SELECT p_id,p_uname FROM patient WHERE p_email='$email' ";
        $result = mysqli_query($conn,$stmt);
        if(mysqli_num_rows($result)>0) {
            while($row = mysqli_fetch_assoc($result)){
                $x = $row['p_id'];
                $z = $row['p_uname'];
                $x = $x -41 + 1;
                $x = $x + 222222;
                $y = $x; 
            }
        }
        

        $stmt = "SELECT r_id,r_uname FROM reception WHERE r_email='$email' ";
        $result = mysqli_query($conn,$stmt);
        if(mysqli_num_rows($result)>0) {
            while($row = mysqli_fetch_assoc($result)){
                $x = $row['r_id'];
                $z = $row['r_uname'];
                $x = $x -21 + 1;
                $x = $x + 888888;
                $y = $x;
            }
        }

        $stmt = "SELECT d_id,d_uname FROM doctor WHERE d_email='$email' ";
        $result = mysqli_query($conn,$stmt);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                $x = $row['d_id'];
                $z = $row['d_uname'];
                $x = $x -11 + 1;
                $x = $x + 444444;
                $y = $x; 
            }
        }

        $stmt = "SELECT ad_id,ad_uname FROM admin WHERE ad_email='$email' ";
        $result = mysqli_query($conn,$stmt);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                $x = $row['ad_id'];
                $z = $row['ad_uname'];
                $x = $x -1 + 1;
                $x = $x + 666666;
                $y = $x; 
            }
        }

if(!empty($y) && !empty($z)) {

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
    } else {
        //echo 'Message has been sent';
    }
}
mailer("degroup2020@gmail.com",$_POST['email'],"Reset Password","<h3 style='color: #1e365c;'>Password Reset</h3>"."<p style='color: #1e365c;'>This is your username and password</p>"."<b style='color: #1e365c;'>Username : ".$z."</b><br>"."<b style='color: #1e365c;'>Password : ".$y."</b>");
        }
    }
}
?>
            <?php
            if(isset($_POST['submit'])){
                if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($y))
                {     
			    echo "<div class='alert alert-danger'><strong>Invalid Email Address</strong></div>";
                }
                else{
                    echo "<div class='alert alert-success'><strong>Message Send Successfully</strong></div>";
                }
            }
            ?>
            
			<form method="post">
				<div class="form-group">
					<input class="form-control mt-3" autocomplete="off" id="email" type="text" name="email" placeholder="Email Address">
                    <button type="submit" name="submit" class="btn btn-primary mt-5" value="submit">Forgot Password</button><br><br>
                    <center><p>Remembered Password ?<a href ="./login.php"> Login</a></p></center>	
                </div>	
			</form>
            <hr>
		</div>
	</div>
</body>
</html>
