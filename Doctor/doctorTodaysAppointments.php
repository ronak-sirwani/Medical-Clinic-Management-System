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
<style>
body {
  font-family: "Lato", sans-serif;
}
.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none !important;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

#main {
  transition: margin-left .5s;
  
}

@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
  }

.flex-container{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  background-color: black;
}
.openbtn{
  align-self: flex-start;
  margin-top: 10px;
}
#search{
  margin-top:15px;
}
#heading{
  margin-top: 15px;
  color: white;
  margin-bottom: 15px;
}
.container-fluid{
  background-color: black;

}
@media screen and (max-width:330px){
  #heading{
    font-size: 20px !important;
    margin-top: 20px !important;
  }
}
i{
  margin:10px;
}
#profile {
      margin-left: 18px !important;
      background-color: #111 !important;
      color: #818181 !important;
      font-size: 25px !important;
      font-family: "Lato", sans-serif;
      outline: none !important;
    }

    #profile:focus {
      box-shadow: none !important;
    }

    #profile:hover {
      color: white !important;

    }

    h6 {
      color: white !important;
    }

    img {
      margin-left: 45px !important;
    }

    h6 {
      margin-left: 15px !important;
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
</style>
</head>
<body>

<?php 
if(isset($_SESSION['module']))
{
  $module=$_SESSION['module'];
  $uname=$_SESSION['uname'];
 // $passw=$_SESSION['passw'];
}
$sql = "SELECT * FROM doctor WHERE d_uname = '$uname' ";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
  while($row = mysqli_fetch_assoc($result))
  {
    $d_name = $row["d_name"];
    $d_mobile = $row["d_mobile"];
    $d_email = $row["d_email"];
    $d_desig = $row["d_desig"];
  }
}
?>

<div id="main">
<div class="container-fluid">
<div class="flex-container">
  <button class="openbtn" onclick="openNav()">☰</button>
  <center><h2 id="heading">Doctor Dashboard</h2></center>
  <i></i>
 </div>
</div>
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <div class="media">
  <i class="fas fa-user-circle fa-lg px-2" style="color: white; font-size: 35px !important; margin-left:30px;"></i>
     <!--   <img src="profile.jpg" width="40" height="40" class=" rounded-circle"> -->
        <div class="media-body">
          <h6><?php echo $d_name; ?></h6>
          <p id="demo"></p>
        </div>
    </div>
  <button type="button" class="btn" data-toggle="modal" data-target="#myModal" id="profile"><i class="far fa-user-circle"></i>Profile</button>
  <a href="bookAppointment.php"><i class="fas fa-calendar-check"></i>Book Appointment</a>
  <a href="doctorAllAppointments.php"><i class="far fa-calendar-check"></i>View Appointments</a>
  <a href="doctorHistory.php"><i class="fa fa-history"></i>View History</a>
  <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
</div>

<script>
  if (navigator.onLine) 
  {
    var styles = {
      "height": "10px",
      "width": "10px",
      "background-color": "green",
      "border-radius": "50%",
      "display": "inline-block",
      "margin-left": "15px"
    };
    var obj = document.getElementById("demo");
    Object.assign(obj.style, styles);
  }
  else 
  {
    var styles = {
      "height": "10px",
      "width": "10px",
      "background-color": "red",
      "border-radius": "50%",
      "display": "inline-block",
      "margin-left": "15px"
    };
    var obj = document.getElementById("demo");
    Object.assign(obj.style, styles);
  }
</script>

<div class="container" >
<br>
    <center><h2>My Appointments</h2></center>
    <div class="form-group">
    <input  class="form-control " id="myinput" type="text" placeholder="Search..">  
    </div>
<div class="table-responsive">          
  <table class="table table-bordered table-hover text-center">
    <thead class="thead-dark">
      <tr>
        <th>Appointment Id</th>
        <th>Patient Id</th>
        <th>Full Name</th>
        <th>Mobile No</th>
        <th>Email Id</th>
        <th>Date</th>
        <th>Time Slot</th> 
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="search">

<?php 
  $sql = "SELECT d_id FROM  doctor WHERE d_uname='$uname'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $d_id = $row['d_id'];
    }
  }
  $sqlq = "SELECT * FROM appointment WHERE d_id = '$d_id' AND DATE(apt_date)=CURDATE()";
  $resultq = mysqli_query($conn,$sqlq);
  $nums = mysqli_num_rows($resultq);
  while($rowq = mysqli_fetch_array($resultq))
  {
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
      <td><?php echo $rowq['apt_id']; ?></td>
      <td><?php echo $rowq['p_id']; ?></td>
      <td><?php echo $rowq['apt_name']; ?></td>
      <td><?php echo $rowq['apt_mobile']; ?></td>
      <td><?php echo $rowq['apt_email']; ?></td>
      <td><?php echo $rowq['apt_date']; ?></td>
      <td><?php echo $rowq['apt_slot']; ?></td>
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

<div class="modal" id="myModal">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content">

          <div class="modal-header">
            <h2 class="modal-title">Welcome <?php echo $d_name; ?></h2>
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
                    <input type="text" id="fullname" name="fullname" value="<?php echo $d_name; ?>" class="inputs"
                      disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="lname">Mobile No</label>
                  </div>
                  <div class="col-75">
                    <input type="tel" id="mobileno" name="mobileno" value="<?php echo $d_mobile; ?>" pattern="[0-9]{10}" disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="email">Email id</label>
                  </div>
                  <div class="col-75">
                    <input type="email" id="email" name="mobileno" value="<?php echo $d_email; ?>" disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="specialization">Specialization</label>
                  </div>
                  <div class="col-75">
                  <input type="text" id="specialization" name="specialization" value="<?php echo $d_desig; ?>" class="inputs"
                      disabled>
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
$(document).ready(function(){
  $("#myinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#search tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script>
function openNav() 
{
  if (window.matchMedia("(max-width: 450px)").matches) 
  {
    document.getElementById("mySidebar").style.width = "100%";
    document.getElementById("main").style.marginLeft = "100%";
  }
  else
  {
  document.getElementById("mySidebar").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  }
}
function closeNav() 
{
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</body>
</html> 
