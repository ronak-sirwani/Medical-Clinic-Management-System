<!DOCTYPE html>
<html>
<head>
	<title>Appointments</title>
	<link rel="stylesheet" href="bootstrap-4.5.3-dist\css\bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap-4.5.3-dist\DataTables-1.10.24\css\jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="./bootstrap-4.5.3-dist/css/try2.css">

	<script src="bootstrap-4.5.3-dist\js\jquery-3.5.1.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="bootstrap-4.5.3-dist\js\bootstrap.min.js"></script>
	<script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\jquery.dataTables.min.js"></script>
	<script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\aptpages.js"></script>
	<script>
		function doSomething(data) {
			var submit= 'submit';
			var id= $(data).attr('id');
			var status= $(data).val();

			$('#update_status').load('update.php', {
				form_submit: submit,
				apt_id: id,
				apt_status: status
			});
		}
	</script>
</head>
<body>
	<?php
	
	include '../config.php';
	$mysqli = $conn;

	// SQL query to select data from database
	$sql = "SELECT appointment.apt_id,doctor.d_name,appointment.apt_name,appointment.apt_email, appointment.apt_mobile,appointment.apt_date, appointment.apt_slot,appointment.apt_status FROM appointment INNER JOIN doctor ON appointment.d_id=doctor.d_id";

	$result = $mysqli->query($sql);
	$mysqli->close();

	 $allSlots = array("s1"=>"10:00AM - 11:00AM","s2"=>"11:00AM - 12:00PM","s3"=>"12:00PM - 01:00PM","s4"=>"01:00PM - 02:00PM","s5"=>"02:00PM - 03:00PM","s6"=>"03:00PM - 04:00PM","s7"=>"04:00PM - 05:00PM");
	
	?>

	<div class="parentDiv">
		<h2 class="text-center mb-4">Appointment Details</h2>
		<table id="aptable" class="table table-striped table-bordered table-sm" width="95%">
			<thead>
				<tr>
					<th class="th-sm">Id</th>
	      			<th class="th-sm">Doctor Name</th>
	      			<th class="th-sm">Appointment Name</th>
	      			<th class="th-sm">Appointment Email</th>
	      			<th class="th-sm">Appointment Mobile</th>
	      			<th class="th-sm">Date</th>
	      			<th class="th-sm">Slot</th>
	      			<th class="th-sm">Status</th>
	    		</tr>
	  		</thead>
		 	<tbody>
	  	 		<?php // Loop till end of data
	  	 		while($rows=$result->fetch_assoc()){
				?>
				<tr>
					<td><?php echo $rows['apt_id'];?></td>
					<td><?php echo $rows['d_name'];?></td>
					<td><?php echo $rows['apt_name'];?></td>
					<td><?php echo $rows['apt_email'];?></td>
					<td><?php echo $rows['apt_mobile'];?></td>
					<td><?php echo $rows['apt_date'];?></td>
					<td><?php echo $allSlots[$rows['apt_slot']];?></td>
					<td>
							<select id="<?php echo $rows['apt_id'];?>" onchange="doSomething(this)">
								<option value="pending" <?php if($rows['apt_status']==='pending'){echo "selected" ;} ?> >Pending</option>
								<option value="accepted" <?php if($rows['apt_status']==='accepted'){echo "selected" ;} ?> >Accepted</option>
								<option value="declined" <?php if($rows['apt_status']==='declined'){echo "selected" ;} ?> >Declined</option>
						</select>
					</td>
				</tr>
				<?php
	                }
	             ?>
	        </tbody>
	        <tfoot>
	        	<tr>
	        		<th class="th-sm">Id</th>
	     			<th class="th-sm">Doctor Name</th>
	      			<th class="th-sm">Appointment Name</th>
	      			<th class="th-sm">Appointment Email</th>
	      			<th class="th-sm">Appointment Mobile</th>
	      			<th class="th-sm">Date</th>
	      			<th class="th-sm">Slot</th>
	      			<th class="th-sm">Status</th>
	    		</tr>
	  		</tfoot>
		</table>
		
		<div id="update_status">
			
		</div>
	</div>

</body>
</html>
