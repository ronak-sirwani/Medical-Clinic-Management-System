<?php

include '../config.php';

session_start();

if (isset($_SESSION['id'])) {
	$aptId = $_GET['apt_id'];

	$stmt = "SELECT COUNT(*) FROM appointment WHERE apt_id=$aptId";
	$result = $conn->query($stmt);
	$row = $result->fetch_assoc();

	if ($row['COUNT(*)'] === '1') {	

		$stmt = "SELECT * FROM medicine";
		$result = $conn->query($stmt);
		$meds = $result->fetch_all(MYSQLI_ASSOC);

	} else {
		die("<h1>No Appointment Found!");
	}
} else {
	header('Location: ../login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Prescription</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.min.js"></script>

	<style>
		#formTable, .table th, .table td {
			border: none;
		}

		input[type="checkbox"] {
			margin-left: 10px;
		}

		.preData {
			width: 70%;
			max-width: 70%;
			margin-left: 15%;
			margin-right: 15%;
		}

		.preData, .preData td {
			border: 1px solid black;
			border-collapse: collapse;
		}

		.preData th {
			border: 1px solid black;
		}

		.preData th {
			background-color: dodgerblue;
			color: white;
		}
	</style>

</head>
<body>
	<div class="container">
		<div id="message"></div>
		<table class="table" id="formTable">
			<tr>
				<td style="width: 15%;">Medicine Name</td>
				<td>:</td>
				<td>
					<input type="text" name="medName" list="list" id="medName">
					<datalist id="list">
						<?php
							foreach ($meds as $key => $value) {
								echo "<option value=".$value['m_name'].">";
							}
						?>
					</datalist>
				</td>
			</tr>
			<tr>
				<td style="width: 15%;">Medicine Dose</td>
				<td>:</td>
				<td>
					<input type="number" name="medDose" id="medDose">
					<span>*Tablets(mg) and Syrup(ml)</span>
				</td>
			</tr>
			<tr>
				<td style="width: 15%;">Medicine Timing</td>
				<td>:</td>
				<td>
					<input type="checkbox" id="morn" name="morn" value="morning">
					<label for="morn">Morning</label>
					
					<input type="checkbox" id="noon" name="noon" value="noon">
					<label for="noon">Afternoon</label>
					
					<input type="checkbox" id="eve" name="eve" value="evening">
					<label for="eve">Evening</label>

					<input type="checkbox" id="night" name="night" value="night">
					<label for="night">Night</label>

					<input type="checkbox" id="any" name="any" value="any">
					<label for="any">Any Time</label>
				</td>
			</tr>
			<tr>
				<td style="width: 15%;">Any Note</td>
				<td>:</td>
				<td>
					<textarea rows="5" cols="30" style="resize: none;" id="note" name="note"></textarea>
				</td>
			</tr>
			<tr>
				<td><button class="btn btn-warning" id="submit">Add More</button></td>
				<td><button id="finalBill" class="btn btn-success">Finalize Prescription</button></td>
			</tr>
		</table>
		<div class="addedRecords">
			<table id="confirmData" class="preData">
				<thead>
					<tr>
						<th>Medicine Name</th>
						<th>Medicine Dose</th>
						<th>Medicine Time</th>
						<th>Note</th>
					</tr>
				</thead>
			</table>
		</div>
		
	</div>
	<script>
		$(document).ready(function() {
			var medicines = [];
			var table = false;
			$('#submit').on('click', function() {

				var medName = $('#medName').val();
				var medDose = $('#medDose').val();
				var note = $('#note').val();

				var timing = [];
				var str = '';
				var temp = 0;
				var phases = ["Morning","Afternoon","Evening","Night","Any Time"];
				let time = '';

				var morn = document.getElementById('morn').checked;
				timing.push(morn);

				var noon = document.getElementById('noon').checked;
				timing.push(noon);

				var eve = document.getElementById('eve').checked;
				timing.push(eve);

				var night = document.getElementById('night').checked;
				timing.push(night);

				var any = document.getElementById('any').checked;
				timing.push(any);

				if (medName == '' || medDose == '' || (morn == false && noon == false && eve == false && night == false && any == false)) {
					alert('Empty Fields!');
				} else {
					str += '<tr>';
					str += '<td>'+medName+'</td>';
					str += '<td>'+medDose+'</td>';
						

					for(let data of timing) {
						if (data === true) {
							time += phases[temp]+', ';
						}
						temp += 1;
					}
					str += '<td>'+time+'</td>';
					str += '<td>'+note+'</td>'
					str += '</tr>';
					

					$('#confirmData').append(str);
					str = '';

					var record = [
						{
							medName : medName,
							medDose: medDose,
							timing: time,
							note: note,
						},
					];
					
					medicines.push(record);

					$('#medName').val('');
					$('#medDose').val('');
					$('#note').val('');
					$('#morn').prop('checked', false);
					$('#noon').prop('checked', false);
					$('#eve').prop('checked', false);
					$('#night').prop('checked', false);
					$('#any').prop('checked', false);
				}
			})

			$('#finalBill').on('click', function() {
				let str = '';
				for(let data of medicines) {
					for(let record of data) {
						str += record.medName + '.';
						str += record.medDose + '.';
						str += record.timing + '.';
						str += record.note;
						str += '/';
					}
				}
				var aptId = "<?php echo $aptId; ?>"
				$('#message').load('PrescrApi.php', {
					submit: 'submit',
					aptId: aptId,
					med: str,
				});
				str = '';
			})
		})
	</script>
</body>
</html>