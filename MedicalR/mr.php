<?php

session_start();

if (!isset($_SESSION['id'])) {
  header('Location: ../login.php');
  die(); 
}

include '../config.php';
$mysqli = $conn;

$tempId = $_SESSION['id'];
$stmt = "SELECT mr_name FROM medr WHERE mr_id=$tempId";
$result = $mysqli->query($stmt);

$row = $result->fetch_assoc();

$name = $row['mr_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Medical Representative</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-4.5.3-dist\css\bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap-4.5.3-dist\css\try2.css">
  <link rel="stylesheet" type="text/css" href="bootstrap-4.5.3-dist\css\themify-icons\themify-icons.css">
  <link rel="stylesheet" type="text/css" href="bootstrap-4.5.3-dist\css\font-awesome-4.7.0\css\font-awesome.min.css">
  <script src="bootstrap-4.5.3-dist\js\bootstrap.min.js"></script>
  <script src="bootstrap-4.5.3-dist\js\jquery-3.5.1.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2"></script>
</head>
<body id="mr">
  
  <div class="mrsidebar">
   
    <a href="#uname" align="center">
      <i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i>
      <br>
      <span><?php echo $name; ?></span>
    </a>
   
    <a href="../">
      <i class="fa fa-home fa-2x" aria-hidden="true"></i>
      <span>Home</span>
    </a>
   
    <a href="./mr.php">
      <i class="fa fa-tachometer fa-2x" aria-hidden="true"></i>
      <span>Dashboard</span>
    </a>
   
    <a href="./add_medicine.php">
      <i class="fa fa-plus-square fa-2x" aria-hidden="true"></i>
      <span>Suggest Medicine</span>
    </a>
   
    <a href="./logout.php">
      <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
      <span>Logout</span>
    </a>
</div>

<div class="mrcontainer" id="mrcontent">
  
  <h2>Dashboard</h2>
  
  <div class="row" id="dc">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12" id="single-card">
      <div class="card-body text-center bg-primary text-white" id="ta">
        <div class="cc"> 
          <h5>Total Suggested Medicine</h5>
          <?php
          $sql = "SELECT count(*) FROM medicine WHERE mr_id=$tempId";
          $result = $mysqli->query($sql);
          $rows=$result->fetch_assoc();
          ?>
          <h4><?php echo $rows['count(*)']; ?></h4>
        </div>
        <div class="text-right" id="cf">
          <a href="suggest_medicine.php" target="_blank" class="text-white">View all</a>
        </div>
      </div>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-12" id="single-card">
      <div class="card-body text-center bg-info text-white" id="tp">
        <div class="cc">
          <h5>Total Approved Medicine:</h5>
          <?php
          $sql = "SELECT count(*) FROM medicine WHERE m_status=1 AND mr_id=$tempId";
          $result = $mysqli->query($sql);
          $rows=$result->fetch_assoc();
          ?>
          <h4><?php echo $rows['count(*)']; ?></h4>  
        </div>
        <div class="text-right" id="cf">
          <a href="approved_medicine.php" class="text-white" id="totalp" target="_blank">View all</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12" id="single-card">
      <div class="card-body text-center bg-info text-white">
        <div class="cc">
          <h5>Total Disapproved Medicine
          <?php
          $sql = "SELECT count(*) FROM medicine WHERE m_status=2 AND mr_id=$tempId";
          $result = $mysqli->query($sql);
          $rows=$result->fetch_assoc();
          ?>
          <h4><?php echo $rows['count(*)']; ?></h4>  
        </div>
        <div class="text-right" id="cf">
          <a href="disapproved_medicine.php" class="text-white" target="_blank">View all</a>
        </div>
      </div>
    </div>

  </div>

</div>
</body>
</html>