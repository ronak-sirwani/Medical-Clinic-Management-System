<?php

session_start();

include '../config.php';
$mysqli = $conn;
$tempId = $_SESSION['id'];
$stmt = "SELECT r_name FROM reception WHERE r_id=$tempId";
$result = $mysqli->query($stmt);
$row = $result->fetch_assoc();
$name = $row['r_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reception</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-4.5.3-dist\css\bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap-4.5.3-dist\css\try2.css">
 
  <script src="bootstrap-4.5.3-dist\js\bootstrap.min.js"></script>
  <script src="bootstrap-4.5.3-dist\js\jquery-3.5.1.min.js"></script>
  <script src="https://kit.fontawesome.com/8e69dd82ea.js" crossorigin="anonymous"></script>
</head>
<body>
  
  <div class="sidebar">
   
    <a href="#uname" align="center">
      <i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i>
      <br>
      <span><?php echo $name; ?></span>
    </a>
   
    <a href="../">
      <i class="fa fa-home fa-2x" aria-hidden="true"></i>
      <br>
      <span>Home</span>
    </a>
   
    <a href="./recep2.php">
      <i class="fa fa-tachometer fa-2x" aria-hidden="true"></i>
      <br>
      <span>Dashboard</span>
    </a>
   
    <a href="../bookAppointment.php">
      <i class="fa fa-book fa-2x" aria-hidden="true"></i>
      <br>
      <span>Book Appointment</span>
    </a>
   
    <a href="./logout.php">
      <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
      <br>
      <span>Logout</span>
    </a>
</div>

<div class="container" id="content">
  
  <h2>Welcome, Receptionist</h2>
  
  <div class="row" id="dc">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12" id="single-card">
      <div class="card-body text-center bg-primary text-white" id="ta">
        <div class="cc"> 
          <h5>Today's Appointments:</h5>
          <?php
          $sql = "SELECT count(*) FROM appointment WHERE DATE(apt_date)=CURDATE()";
          $result = $mysqli->query($sql);
          $rows=$result->fetch_assoc();
          ?>
        
          <h4><?php echo $rows['count(*)']; ?></h4>
        </div>
        <div class="text-right" id="cf">
          <a href="today_appointment_table.php" target="_blank" class="text-white">View all</a>
        </div>
      </div>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-12" id="single-card">
      <div class="card-body text-center bg-info text-white" id="tp">
        <div class="cc">
          <h5>Total Patients:</h5>
          <?php
          $sql = "SELECT count(*) FROM patient";
          $result = $mysqli->query($sql);
          $rows=$result->fetch_assoc();
          ?>
          <h4><?php echo $rows['count(*)']; ?></h4>  
        </div>
        <div class="text-right" id="cf">
          <a href="patient_table.php" class="text-white" id="totalp" target="_blank">View all</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12" id="single-card">
      <div class="card-body text-center bg-info text-white">
        <div class="cc">
          <h5>Total Doctors:</h5>
          <?php
          $sql = "SELECT count(*) FROM doctor";
          $result = $mysqli->query($sql);
          $rows=$result->fetch_assoc();
          ?>
          <h4><?php echo $rows['count(*)']; ?></h4>  
        </div>
        <div class="text-right" id="cf">
          <a href="doctor_table.php" class="text-white" target="_blank">View all</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12" id="single-card">
      <div class="card-body text-center bg-secondary text-white">
        <div class="cc">
          <h5>Manage Doctors:</h5>
          <?php
          $sql = "SELECT count(*) FROM doctor";
          $result = $mysqli->query($sql);
          $rows=$result->fetch_assoc();
          ?>
          <h4><?php echo $rows['count(*)']; ?></h4>  
        </div>
        <div class="text-right" id="cf">
          <a href="./slot_table.php" class="text-white">View all</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12" id="single-card">
      <div class="card-body text-center bg-primary text-white">
        <div class="cc">
          <h5>All Appointments:</h5>
          <?php
          $sql = "SELECT count(*) FROM appointment";
          $result = $mysqli->query($sql);
          $rows=$result->fetch_assoc();
          $mysqli->close();
          ?>
          <h4><?php echo $rows['count(*)']; ?></h4>  
        </div>
        <div class="text-right" id="cf">
          <a href="appointment_table.php" class="text-white" target="_blank">View all</a>
        </div>
      </div>
    </div>
  </div>

</div>
</body>
</html>