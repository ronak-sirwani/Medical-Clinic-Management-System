<!DOCTYPE html>
<html>
<head>
	<title>Modify Doctor's Slots</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-4.5.3-dist/css/modify_form.css">
	<script type="text/javascript">
	  function checkTheBox() {
	  	console.log("fsa")
	    var flag = 0;
	    for (var i = 0; i< 5; i++) {
	      if(document.myform["slot[]"][i].checked){
	        flag ++;
	      }
	    }
	    if (flag < 1) {
	      alert ("You must tick atleast one slot!");
	      return false;
	    }
	    return true;
	  }
	</script>
</head>
<body>
	<h2 id="hdg">Modify Doctor's Time Slot</h2>
	<div id="modifys">	
		<form name="modify" action="" method="post">
		
		<label for="dname">Enter Doctor's Name: </label>
		<input type="text" required name="dname" placeholder="Doctors's Name">
		<br><br>
		<label for="dmail">Enter Doctor's Email: </label>
		<input type="text" required name="dmail" placeholder="Doctors's Email">
		<br><br>

		<label for="slot[]">Modify Slots: </label>
		<br>
		<input type="checkbox" name="slot[]" value="s2">10:00-11:00 AM
		<br>
		<input type="checkbox" name="slot[]" value="s3">11:00-12:00 PM
		<br>
		<input type="checkbox" name="slot[]" value="s4">12:00-01:00 PM
		<br>
		<input type="checkbox" name="slot[]" value="s4">01:00-02:00 PM
		<br>
		<input type="checkbox" name="slot[]" value="s5">02:00-03:00 PM
		<br>
		<input type="checkbox" name="slot[]" value="s6">03:00-04:00 PM
		<br>
		<input type="checkbox" name="slot[]" value="s7">04:00-05:00 PM

		<br><br>

		<input type="submit" name="change1" value="Available">
		<input type="submit" name="change2" value="Not Available">		
	</form>
	</div>
	

	<?php 
		include '../config.php';

		if (isset($_POST['change2'])){

			$dname= $_POST['dname'];
			$dmail= $_POST['dmail'];
			$slot= $_POST['slot'] ;
			
			
			$mysqli = $conn;

		    // SQL query to select data from database
		    for ($i=0; $i <count($slot) ; $i++) { 
				$sql = "UPDATE slots SET $slot[$i]=0 WHERE d_id= (SELECT d_id FROM doctor WHERE d_email='".$dmail."');";
				$result = $mysqli->query($sql);
			}
			$mysqli->close();
		}

		if (isset($_POST['change1'])){

			$dname= $_POST['dname'];
			$dmail= $_POST['dmail'];
			$slot= $_POST['slot'] ;
			
			include 'config.php';
			$mysqli = $conn;

		    // SQL query to select data from database
		    for ($i=0; $i <count($slot) ; $i++) { 
				$sql = "UPDATE slots SET $slot[$i]=1 WHERE d_id= (SELECT d_id FROM doctor WHERE d_email='".$dmail."');";
				$result = $mysqli->query($sql);
			}

			$mysqli->close();
		}	

		
		
	?>

</body>
</html>