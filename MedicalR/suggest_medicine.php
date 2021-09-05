<?php
session_start();

if (!isset($_SESSION['id'])) {
	header('Location: ../login.php');
	die(); 
}

$tempId = $_SESSION['id'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Suggested Medicine</title>
	<link rel="stylesheet" href="bootstrap-4.5.3-dist\css\bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap-4.5.3-dist\DataTables-1.10.24\css\jquery.dataTables.min.css">
	<script src="bootstrap-4.5.3-dist\js\jquery-3.5.1.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="bootstrap-4.5.3-dist\js\bootstrap.min.js"></script>
	<script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\jquery.dataTables.min.js"></script>
	<script src="bootstrap-4.5.3-dist\DataTables-1.10.24\js\sm.js"></script>
</head>
<body>
	<?php
	include '../config.php';

	$mstatus = array("0"=>"Pending","1"=>"Approved","2"=>"Disapproved");

	$mysqli = $conn;

	// SQL query to select data from database
	$sql = "SELECT m_name,m_status FROM medicine WHERE mr_id=$tempId";
	$result = $mysqli->query($sql);
	$mysqli->close();
	?>

	<h2 class="text-center mb-4">Total Suggested Medicines</h2>
	<table id="smtable" class="table table-striped table-bordered table-sm" width="95%">
		<thead>
			<tr>
      			<th class="th-sm">Sr No.</th>
      			<th class="th-sm">Medicine Name</th>
      			<th class="th-sm">Medicine Status</th>
    		</tr>
  		</thead>
	 	<tbody>
  	 		<?php // Loop till end of data
  	 		$count=1;
  	 		while($rows=$result->fetch_assoc()){
			?>
			<tr>
				<td><?php echo $count;?></td>
				<td><?php echo $rows['m_name'];?></td>
				<td><?php echo $mstatus[$rows['m_status']];?></td>
			</tr>
			<?php
                $count+=1;
                }
             ?>
        </tbody>
        <tfoot>
        	<tr>
      			<th class="th-sm">Sr No.</th>
      			<th class="th-sm">Medicine Name</th>
      			<th class="th-sm">Medicine Status</th>
    		</tr>
  		</tfoot>
	</table>

</body>
</html>
