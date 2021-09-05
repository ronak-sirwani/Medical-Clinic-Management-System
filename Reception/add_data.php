<!DOCTYPE html>
<html>
<head>
	<title>adddd</title>
</head>
<body>
	<?php
include '../config.php';
$mysqli = $conn;

$sql1= "SELECT COUNT(*) FROM patient;";
$result= $mysqli->query($sql1);
$rows=$result->fetch_assoc();
?>
<h4><?php echo $rows['count(*)']; ?></h4>

</body>
</html>