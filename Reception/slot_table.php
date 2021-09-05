<!DOCTYPE html>
<html>
<head>
   <title>Appointments</title>
   <link rel="stylesheet" href="bootstrap-4.5.3-dist\css\bootstrap.min.css">
   <link rel="stylesheet" href="bootstrap-4.5.3-dist\DataTables-1.10.24\css\jquery.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="./bootstrap-4.5.3-dist/css/try2.css">

   <script src="bootstrap-4.5.3-dist\js\jquery-3.5.1.min.js"></script>
   <script src="bootstrap-4.5.3-dist\js\bootstrap.min.js"></script>
   <script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\jquery.dataTables.min.js"></script>
   <script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\slot.js"></script>
  </head>
<body>
   <?php
   
   include '../config.php';
   $mysqli = $conn;

   // SQL query to select data from database
   $sql = "SELECT doctor.d_name,doctor.d_uname,slots.s1,slots.s2, slots.s3,slots.s4,slots.s5,slots.s6,slots.s7 FROM doctor,slots WHERE doctor.d_id= slots.d_id";

   $result = $mysqli->query($sql);
   $mysqli->close();

   $allSlots = array("s1"=>"10:00AM - 11:00AM","s2"=>"11:00AM - 12:00PM","s3"=>"12:00PM - 01:00PM","s4"=>"01:00PM - 02:00PM","s5"=>"02:00PM - 03:00PM","s6"=>"03:00PM - 04:00PM","s7"=>"04:00PM - 05:00PM");
   
   $availabe=  array('0' =>'Not Available' ,'1' => 'Available');

   ?>

   <div class="parentDiv">
      <h2 class="text-center mb-4">Slots Details</h2>
      <table id="stable" class="table table-striped table-bordered table-sm" width="95%">
         <thead>
            <tr>
                  <th class="th-sm">Doctor Name</th>
                  <th class="th-sm">Doctor Username</th>
                  <th class="th-sm"><?php echo $allSlots['s1'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s2'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s3'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s4'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s5'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s6'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s7'] ?></th>
            </tr>
         </thead>
         <tbody>
            <?php // Loop till end of data
            while($rows=$result->fetch_assoc()){
            ?>
            <tr>
               <td><?php echo $rows['d_name'];?></td>
               <td><?php echo $rows['d_uname'];?></td>
               <td><?php echo $availabe[$rows['s1']];?></td>
               <td><?php echo $availabe[$rows['s2']];?></td>
               <td><?php echo $availabe[$rows['s3']];?></td>
               <td><?php echo $availabe[$rows['s4']];?></td>
               <td><?php echo $availabe[$rows['s5']];?></td>
               <td><?php echo $availabe[$rows['s6']];?></td>
               <td><?php echo $availabe[$rows['s7']];?></td>
            </tr>
            <?php
                   }
                ?>
           </tbody>
           <tfoot>
            <tr>
                  <th class="th-sm">Doctor Name</th>
                  <th class="th-sm">Doctor Username</th>
                  <th class="th-sm"><?php echo $allSlots['s1'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s2'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s3'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s4'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s5'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s6'] ?></th>
                  <th class="th-sm"><?php echo $allSlots['s7'] ?></th>
            </tr>
         </tfoot>
      </table>
      
      <div id="update_status">
         
      </div>
   </div>

   <p>
      To Modify or Manage Doctor's Time Slot
      <a href="modify_slot.php" target="_blank">Click Here..</a>
   </p>

</body>
</html>
