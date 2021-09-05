<!DOCTYPE html>
<html>
<head>
	<title>Doctors</title>
	<link rel="stylesheet" href="bootstrap-4.5.3-dist\css\bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap-4.5.3-dist\DataTables-1.10.24\css\jquery.dataTables.min.css">
	<script src="bootstrap-4.5.3-dist\js\jquery-3.5.1.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="bootstrap-4.5.3-dist\js\bootstrap.min.js"></script>
	<script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\jquery.dataTables.min.js"></script>
	<script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\dpages.js"></script>
</head>
<body>
	<?php
	include '../config.php';
	$mysqli = $conn;

	// SQL query to select data from database
	$sql = "SELECT d_name,d_desig,d_email,d_mobile FROM doctor";
	$result = $mysqli->query($sql);
	$mysqli->close();
	?>

	<h2 class="text-center mb-4">Doctor Details</h2>
	<table id="dtable" class="table table-striped table-bordered table-sm" width="95%">
		<thead>
			<tr>
      			<th class="th-sm">Doctor Name</th>
      			<th class="th-sm">Doctor Designation</th>
      			<th class="th-sm">Doctor Email</th>
      			<th class="th-sm">Doctor Mobile</th>
    		</tr>
  		</thead>
	 	<tbody>
  	 		<?php // Loop till end of data
  	 		while($rows=$result->fetch_assoc()){
			?>
			<tr>
				<td><?php echo $rows['d_name'];?></td>
				<td><?php echo $rows['d_desig'];?></td>
				<td><?php echo $rows['d_email'];?></td>
				<td><?php echo $rows['d_mobile'];?></td>
			</tr>
			<?php
                }
             ?>
        </tbody>
        <tfoot>
        	<tr>
     			<th class="th-sm">Doctor Name</th>
     			<th class="th-sm">Doctor Designation</th>
    	  		<th class="th-sm">Doctor Email</th>
      			<th class="th-sm">Doctor Mobile</th>
    		</tr>
  		</tfoot>
	</table>

</body>
</html>
