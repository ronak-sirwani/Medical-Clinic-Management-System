<?php
session_start();

if (!isset($_SESSION['id'])) {
	header('Location: ../login.php');
	die(); 
}

$id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="bootstrap-4.5.3-dist\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./bootstrap-4.5.3-dist/css/try2.css">
	<title>Add Medicines</title>
<script>
/*
This script is identical to the above JavaScript function.
*/
var ct = 1;
function new_link()
{
	ct++;
	var div1 = document.createElement('div');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<div style="text-align:center;"><a href="javascript:delIt('+ ct +')">Delete !</a></div>';
	div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
	document.getElementById('newlink').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('newlink');
	parentEle.removeChild(ele);
}
</script>
</head>
<body id="body">
	<h2 id="hdg">Add Medicine</h2>
		<form method="post" action="">
		<div id="newlink">
		<div class="medname">
			<label for="medicine[]">Medicine name: &nbsp;</label> 
			<input type="text" name="medicine[]"><br><br>
		</div>
		</div>
		<br>
		<input type="submit" name="submit1">
		<input type="reset" name="reset1">
		
		<p id="addnew">
			<a href="javascript:new_link()">Add New </a>
		</p>
		
		</form>
		
		<!-- Template -->
		<div id="newlinktpl" style="display:none">
		<div class="medname">
			<br><br>
			<label for="medicine[]">Medicine name: &nbsp;</label>
			<input type="text" name="medicine[]"><br><br>
		</div>
		</div>

		<?php
			$a=array();
			if(count($_POST))
			{
				
				
				$len = count($_POST['medicine']);
				for ($i=0; $i < $len; $i++)
				{
					array_push($a,$_POST['medicine'][$i]);
				}
			}

			include '../config.php';
			$mysqli = $conn;

			// SQL query to select data from database
			for ($i=0; $i<count($a); $i++) { 
				$sql = "INSERT INTO medicine (m_name, mr_id) VALUES ('$a[$i]', $id)";
				$result = $mysqli->query($sql);
			}
			
			$mysqli->close();
		?>
</body>
</html>
