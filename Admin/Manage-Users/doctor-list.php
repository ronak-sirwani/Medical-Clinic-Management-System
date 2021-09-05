<div class="admin-table table-responsive mt-4">
	<table class="table table-hover" id="doctor">
		<thead>
			<tr>
				<th>ID</th>
				<th>Doctor Name</th>
				<th>Doctor Email</th>
				<th>Doctor Mobile</th>
				<th>Doctor Designation</th>
			</tr>
		</thead>
		<tbody id="patients">
			<?php

				$conn = new mysqli('localhost', 'root', 'shrey123', 'id15191429_hms');

				if($conn->connect_error) {
					die('Error :-> '.$conn->connect_error);
				} 

				$stmt = "SELECT * FROM doctor WHERE is_deleted=0";
				$result = $conn->query($stmt);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
				?>
						<tr>
							<td><?php echo $row['d_id']; ?></td>
							<td><?php echo $row['d_name']; ?></td>
							<td><?php echo $row['d_email']; ?></td>
							<td><?php echo $row['d_mobile']; ?></td>
							<td><?php echo $row['d_desig']; ?></td>
						</tr>
					<?php
					}	
				}

				?>

			</tbody>
		</table>
	</div>
</div>
<script>
	$('#doctor').DataTable({ "pagingType": "simple_numbers" });
	$('.dataTables_length').addClass('bs-select');
</script>