<!DOCTYPE html>
<html>
<head>
	<title>Patients</title>
	<link rel="stylesheet" href="bootstrap-4.5.3-dist\css\bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap-4.5.3-dist\DataTables-1.10.24\css\jquery.dataTables.min.css">
	<script src="bootstrap-4.5.3-dist\js\jquery-3.5.1.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="bootstrap-4.5.3-dist\js\bootstrap.min.js"></script>
	<script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\jquery.dataTables.min.js"></script>
	<script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\ppages.js"></script>
</head>
<body>

	<?php
	include '../config.php';
	$mysqli = $conn;

	// SQL query to select data from database
	$sql = "SELECT p_uname,p_name,p_email,p_mobile FROM patient";
	$result = $mysqli->query($sql);
	$mysqli->close();
	?>

	<h2 class="text-center mb-4">Patients Details</h2>
	<table id="ptable" class="table table-striped table-bordered table-sm" width="100%" margin-left="210px">
		<thead>
			<tr>
				<th class="th-sm">Patient username</th>
      			<th class="th-sm">Patient Name</th>
      			<th class="th-sm">Patient Email</th>
      			<th class="th-sm">Patient Mobile</th>
    		</tr>
  		</thead>
	 	<tbody>
  	 		<?php // Loop till end of data
  	 		while($rows=$result->fetch_assoc()){
			?>
			<tr>
				<td><?php echo $rows['p_uname'];?></td>
				<td><?php echo $rows['p_name'];?></td>
				<td><?php echo $rows['p_email'];?></td>
				<td><?php echo $rows['p_mobile'];?></td>
			</tr>
			<?php
                }
             ?>
        </tbody>
        <tfoot>
        	<tr>
      			<th class="th-sm">Patient username</th>
     			<th class="th-sm">Patient Name</th>
    	  		<th class="th-sm">Patient Email</th>
      			<th class="th-sm">Patient Mobile</th>
    		</tr>
  		</tfoot>
	</table>

</body>
</html>