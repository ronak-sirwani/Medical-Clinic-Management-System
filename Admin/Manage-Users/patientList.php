<script>
	function loadPatient(data) {
		$('#patients').load("Manage-Users/Components/getPatients.php", {
			page: data,	
		})
	}
</script>

<div class="manage-patient-heading">
	<h3>Manage Patients</h3>
</div>

<?php
	$conn = new mysqli('localhost', 'root', 'shrey123', 'id15191429_hms');

	$stmt = "SELECT COUNT(*) FROM patient";
	$result = $conn->query($stmt);
	$row = $result->fetch_assoc();

	$totalPatient = (int)$row['COUNT(*)'];
	$pages = array();

	$temp = 0;
	$i = 0;

	while ($temp <= $totalPatient) {
		$temp = $temp + 2;
		$pages[$i] = $temp;
		$i +=1;
	}
?>

<div class="admin-table table-responsive mt-4">
	<table class="table table-hover" id="patTable">
		<thead>
			<tr>
				<th>ID</th>
				<th>Patient Name</th>
				<th>Patient Email</th>
				<th>Patient Mobile</th>
			</tr>
		</thead>
		<tbody id="patients">
			<?php

				$limit = 5;

				$conn = new mysqli('localhost', 'root', 'shrey123', 'id15191429_hms'); 
				
				$stmt = "SELECT * FROM patient";
				$result = $conn->query($stmt);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
				?>
						<tr>
							<td><?php echo $row['p_id']; ?></td>
							<td><?php echo $row['p_name']; ?></td>
							<td><?php echo $row['p_email']; ?></td>
							<td><?php echo $row['p_mobile']; ?></td>
							<!-- <td style="text-align: center;">
								<div class="admin-delete">
									<i class="bg-danger fas fa-trash-alt"></i>
								</div>
							</td> -->
						</tr>
				<?php
					}
				}
									
				?>
			</tbody>
		</table>
	</div>
</div>

<!-- <div class="modal fade" id="myModal">
  	<div class="modal-dialog">
    	<div class="modal-content">

      		<div class="modal-header">
		        <h4 class="modal-title">Patient Detail</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		    </div>
      		<div class="modal-body">
        		<form>
        			<div class="form-group">
        				<div class="input-group mb-3">
					  		<div class="input-group-prepend">
					    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
					  		</div>
					  		<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" readonly="true">
						</div>
						<div class="input-group mb-3">
					  		<div class="input-group-prepend">
					    		<span class="input-group-text" id="basic-addon2"><i class="fas fa-unlock"></i></span>
					  		</div>
					  		<input type="text" class="form-control" placeholder="Email Address" aria-label="Email Address" aria-describedby="basic-addon2" readonly="true">
						</div>
						<div class="input-group mb-3">
					  		<div class="input-group-prepend">
					    		<span class="input-group-text" id="basic-addon3"><i class="fas fa-user"></i></span>
					  		</div>
					  		<input type="text" class="form-control" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="basic-addon3" readonly="true">
						</div>
        			</div>
        		</form>
      		</div>

 -->      <!-- Modal footer -->
<!-- 	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      	</div>
    	</div>
  	</div>
</div> -->

<script>
	$('#patTable').DataTable({ "pagingType": "simple_numbers" });
  	$('.dataTables_length').addClass('bs-select');
</script>