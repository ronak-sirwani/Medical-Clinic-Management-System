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
<div>

     <div>

      <div class="sidenav" id="SSIDE-NAV">

        <a href="#" class="logo"><h2><b>HMS</b></h2></a>
        <button type="button" class="btn" data-toggle="modal" data-target="#myModal" id="profile"><i class="fas fa-user-circle" id="picon"></i>My Profile</button>
        <a href="bookAppointment.php"><i class="far fa-calendar-check"></i><span> </span><span>Book Appointment</span></a>
        <a href="patientAllHistory.php"><i class="fa fa-history" aria-hidden="true"></i><span> </span><span>History</span></a>
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
                          <?php
          $uname = $_SESSION["uname"];
          $sql = "SELECT p_name FROM patient WHERE p_uname = '$uname' ";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result))
          {
            $pname = $row['p_name'];
          }
          ?>
<a href="#" style="text-decoration: none !important; color: white; font-size: 20px;"><i class="fas fa-user-circle fa-lg px-2" style="color: white;"></i><span> </span><?php echo $pname; ?></a>


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
    <center><h2>View Appointments History</h2></center>
    <div class="form-group">
    <input  class="form-control " id="myinput" type="text" placeholder="Search..">
    </div>
<div class="table-responsive">
  <table class="table">
    <thead class="thead-light">
      <tr>
        <!--<th>Appointment Id</th>-->
        <th class="text-white bg-dark">Patient Id</th>
        <th>Appointment Id</th>
        <th>Full Name</th>
        <th>Email Id</th>
        <th>Mobile No</th>
        <th>Doctor Name</th>
        <th>Date</th>
        <th>Time Slot</th>
        <th>Prescription</th>
        <th class="text-white bg-dark">Status</th>
      </tr>
    </thead>
    <tbody id="search">
    <?php
    if(isset($_SESSION['module']))
    {
      $module=$_SESSION['module'];
      $uname=$_SESSION['uname'];
      //$passw=$_SESSION['passw'];
    }
    $sql = "SELECT p_email FROM patient WHERE p_uname='$uname'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
      while($row = mysqli_fetch_assoc($result))
      {
        $p_email = $row['p_email'];
      }
    }
    $sqlq = "SELECT * FROM appointment WHERE apt_email = '$p_email' ";
    $resultq = mysqli_query($conn,$sqlq);
    $nums = mysqli_num_rows($resultq);
    while($rowq = mysqli_fetch_array($resultq))
    {
      $did=$rowq['d_id'];
      $name = "SELECT d_name FROM doctor WHERE d_id = '$did' ";
      $dname = mysqli_query($conn,$name);
      $doctorname=mysqli_fetch_array($dname);
      //$_SESSION['nname']=$doctorname['d_name'];
      $dname = $doctorname['d_name'];
      if($rowq['apt_slot']==="s1")
      {
        $rowq['apt_slot']="10:00 AM TO 11:00 AM";
      }
      elseif($rowq['apt_slot']==="s2")
      {
        $rowq['apt_slot']="11:00 AM TO 12:00 PM";
      }
      elseif($rowq['apt_slot']==="s3")
      {
        $rowq['apt_slot']="12:00 PM TO 1:00 PM";
      }
      elseif($rowq['apt_slot']==="s4")
      {
        $rowq['apt_slot']="1:00 PM TO 2:00 PM";
      }
      elseif($rowq['apt_slot']==="s5")
      {
        $rowq['apt_slot']="2:00 PM TO 3:00 PM";
      }
      elseif($rowq['apt_slot']==="s6")
      {
        $rowq['apt_slot']="3:00 PM TO 4:00 PM";
      }
      elseif($rowq['apt_slot']==="s7")
      {
        $rowq['apt_slot']="4:00 PM TO 5:00 PM";
      }
  ?>
    <tr>
      <td><?php echo $rowq['p_id']; ?></td>
      <td><?php echo $rowq['apt_id']; ?></td>
      <td><?php echo $rowq['apt_name']; ?></td>
      <td><?php echo $rowq['apt_email']; ?></td>
      <td><?php echo $rowq['apt_mobile']; ?></td>
      <td><?php echo $dname; ?></td>
      <td><?php echo $rowq['apt_date']; ?></td>
      <td><?php echo $rowq['apt_slot']; ?></td>
      <td><a href = "prescriptionHistory.php?apt_id=<?php echo $rowq['apt_id']; ?>">View</a></td>
      <?php
      if($rowq["apt_status"]==="pending")
      {
        echo '<td><span class=" badge-md badge-pill badge-warning" id="pills" style="padding: 5px !important;">'.$rowq["apt_status"]."</span></td>";
      }

      if($rowq["apt_status"]==="declined")
      {
        echo '<td><span class=" badge-md badge-pill badge-danger" id="pills" style="padding: 5px !important;">'. $rowq['apt_status']."</span></td>";
      }
      if($rowq["apt_status"]==="accepted")
      {
        echo '<td><span class=" badge-md badge-pill badge-success" id="pills" style="padding: 5px !important;">'.$rowq["apt_status"]."</span></td>";
      }
      ?>
    </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
  </div>
</div>
</div>

<?php
$uname = $_SESSION["uname"];
$sql = "SELECT * FROM patient WHERE p_uname = '$uname' ";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $pname = $row["p_name"];
    $pmobile = $row["p_mobile"];
    $pemail = $row["p_email"];
  }
}
?>

<!-- Modal -->
<div class="modal" id="myModal">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content">

          <div class="modal-header">
            <h2 class="modal-title">Welcome <?php echo $pname; ?></h2>
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
                    <input type="text" id="fullname" name="fullname" value="<?php echo $pname; ?>" class="inputs"
                      disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="lname">Mobile No</label>
                  </div>
                  <div class="col-75">
                    <input type="tel" id="mobileno" name="mobileno" value="<?php echo $pmobile; ?>" pattern="[0-9]{10}" disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="email">Email id</label>
                  </div>
                  <div class="col-75">
                    <input type="email" id="email" name="mobileno" value="<?php echo $pemail; ?>" disabled>
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
    $("#search tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>
</html>