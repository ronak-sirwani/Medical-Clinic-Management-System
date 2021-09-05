<?php
session_start();
error_reporting(0);
include 'connection.php';

if(!isset($_SESSION['module']))
{
  header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Chemist</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/416a260aa9.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <script src="bootstrap-4.6.0-dist/jquery/jquery-3.6.0.js"></script>
    <script src="bootstrap-4.6.0-dist/popper/popper.min.js"></script>
    <script src="bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="pdesign.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style>
#profile {
  margin-left: 16px !important;
  margin-bottom: 10px !important;
  background-color: transparent !important;
  color: grey !important;
  font-size: 15px !important;
  font-family: "Lato", sans-serif;
  outline: none !important;
}

#profile:focus {
  box-shadow: none !important;
}
#profile:hover{
  color: rgba(153, 161, 168) !important;
}
#picon{
  padding-right: 4px !important;
}
/* Modal styles */
.modal-body {
      background-color: #f2f2f2 !important;
    }

    .nw {
      padding: 15px !important;

    }

    .nw label {
      padding: 12px 12px 12px 0 !important;
      display: inline-block;
    }

    input[type=text],
    input[type=tel],
    input[type="email"],
    select,
    textarea {
      width: 100%;
      padding: 12px !important;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
      margin-bottom: 40px;
    }

    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-align: center !important;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }

    .col-25 {
      float: left;
      width: 25%;
      margin-top: 6px;
    }

    .col-75 {
      float: left;
      width: 75%;
      margin-top: 6px;
    }

    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    .centered{
     text-align: center !important;
    }
    .container1{
      margin-left: 240px;
      margin-top: 100px;
      margin-right: 30px;
    }
</style>
</head>
<body>

<?php
$uname = $_SESSION['uname'];
$sql = "SELECT * FROM chemist WHERE ch_uname = '$uname' ";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $ch_name = $row["ch_name"];
    $ch_email = $row["ch_email"];
    $ch_mobile = $row["ch_mobile"];
  
  }
}
?>

<div>

     <div>

      <div class="sidenav" id="SSIDE-NAV">

        <a href="#" class="logo"><h2><b>HMS</b></h2></a>
        <button type="button" class="btn" data-toggle="modal" data-target="#myModal" id="profile"><i class="fas fa-user-circle" id="picon"></i>My Profile</button>
        <a href="allPrescriptions.php"><i class="far fa-calendar-check"></i><span> </span><span></span>All Prescriptions</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> </span><span>Log Out</span></a>

      </div>

    </div>

    <div>
      <header>
      <div class="Hnav">
              <nav class="navbar navbar-expand-md bg-dark navbar-dark" style="left: 17%; right: 0; position: fixed;">
              <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarid">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarid">
                      <ul class="navbar-nav text-center ml-auto">
                          <div class="content px-5" style="padding-bottom: 18px; padding-top: 10px;">
                 
<a href="#" style="text-decoration: none !important; color: white; font-size: 20px;"><i class="fas fa-user-circle fa-lg px-2" style="color: white;"></i><span> </span><?php echo $ch_name; ?></a>


                            <div class="Adnav" id="SSIDE-NAV">
                            <a href="#"><i class="fas fa-tachometer-alt"></i><span> </span><span>Dashboard</span></a>
                            <a href="#"><i class="fas fa-user-circle"></i><span> </span><span>My Profile</span></a>
                            <a href="#"><i class='fas fa-file-signature'></i><span> </span><span>Medical Reprot</span></a>
                            <a href="#"><i class="fa fa-history" aria-hidden="true"></i><span> </span><span>History</span></a>
                            </div>

                          </div>
                      </ul>

              </div>
          </nav>

      </div>
    </header>

<div class="container1" >
    <center><h2>View All Prescriptions History</h2></center>
   <!-- <div class="form-group">
    <input  class="form-control " id="myinput" type="text" placeholder="Search..">
    </div>-->
    <?php 
     
     $sql1 = "SELECT prescription.*,appointment.apt_name,appointment.apt_email,appointment.p_id,doctor.d_name,appointment.apt_date FROM prescription,appointment,doctor WHERE prescription.apt_id=appointment.apt_id AND appointment.d_id=doctor.d_id";

      $result1 = mysqli_query($conn,$sql1);
     // if(mysqli_num_rows($result1)>0){
      while($rows1 = mysqli_fetch_assoc($result1)){
        $id = $rows1['p_id'];
        //$id = 17;
        if(1 <= $id && $id <= 10){
          $module = "admin";
          $sql3 = "SELECT ad_name FROM $module WHERE ad_id = $id";
          $result3 = mysqli_query($conn,$sql3);
          while($row3 = mysqli_fetch_assoc($result3)){
            $bookedby = $row3['ad_name'];
          }
          //echo $module;
        }
        elseif(11<=$id && $id<=20){
          $module = "doctor";
          $sql3 = "SELECT d_name FROM $module WHERE d_id = $id";
          $result3 = mysqli_query($conn,$sql3);
          while($row3 = mysqli_fetch_assoc($result3)){
            $bookedby = $row3['d_name'];
          }
          //echo $module;
        }
        elseif(20<= $id && $id<=40)
        {
          $module = "reception";
          $sql3 = "SELECT r_name FROM $module WHERE r_id = $id";
          $result3 = mysqli_query($conn,$sql3);
          while($row3 = mysqli_fetch_assoc($result3)){
            $bookedby = $row3['r_name'];
          }
        }
        else{
          $module = "patient";
          $sql3 = "SELECT p_name FROM $module WHERE p_id = $id";
          $result3 = mysqli_query($conn,$sql3);
          while($row3 = mysqli_fetch_assoc($result3)){
            $bookedby = $row3['p_name'];
          }
        }
        echo "<b>Booked For : </b>".$rows1['apt_name']."</br>";
        //echo "<b>Booked By : </b>".$rows1['apt_email']."</br>";
        echo "<b>Booked By : </b>".$bookedby."</br>";
        echo "<b>Doctor Name : </b>".$rows1['d_name']."</br>";
        echo "<b>Date : </b>".$rows1['apt_date']."</br>";
        echo "<b>Medicines : </b></br>";
        //$x = $rows1['med'];
        $a = $rows1['apt_id'];
        $sql2 = "SELECT med FROM prescription WHERE apt_id = $a ";
        $result2 = mysqli_query($conn,$sql2);
        while($rows2 = mysqli_fetch_assoc($result2)){

        $x = $rows2['med'];
        $y = preg_split('#/#',$x);
        for($i=0;$i<count($y)-1;$i++)
        {
          $z = explode(".",$y[$i]);  
          $j = $i+1;
          echo $j.") ".$z[0].", ".$z[1]."mg";
          echo "</br>";
        }
        echo  "<br>";
      }
    }
    //}
    ?>
    <!--<tbody id="search">-->
</div>



<!-- Modal -->
<div class="modal" id="myModal">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content">

          <div class="modal-header">
            <h2 class="modal-title">Welcome <?php echo $ch_name; ?></h2>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <div class="modal-body">
            <div class="nw">
              <form action="#" method="">

                <div class="row">
                  <div class="col-25">
                    <label for="fname">Full Name</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="fullname" name="fullname" value="<?php echo $ch_name; ?>" class="inputs"
                      disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="lname">Mobile No</label>
                  </div>
                  <div class="col-75">
                    <input type="tel" id="mobileno" name="mobileno" value="<?php echo $ch_mobile; ?>" pattern="[0-9]{10}" disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="email">Email id</label>
                  </div>
                  <div class="col-75">
                    <input type="email" id="email" name="mobileno" value="<?php echo $ch_email; ?>" disabled>
                  </div>
                </div>
            </form>

          <div class="modal-footer">
            <button type="button" class="btn btn-md btn-danger" data-dismiss="modal" id="close">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function()
{
  $("#myinput").on("keyup", function()
  {
    var value = $(this).val().toLowerCase();
    $("#search div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>
</html>