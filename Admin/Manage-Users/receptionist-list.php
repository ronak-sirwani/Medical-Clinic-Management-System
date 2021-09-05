<div class="admin-table table-responsive mt-4">
	<table class="table table-hover" id="recept">
		<thead>
			<tr>
				<th>ID</th>
				<th>Reception Name</th>
				<th>Reception Email</th>
				<th>Reception Mobile</th>
			</tr>
		</thead>
		<tbody id="patients">
			<?php

				$conn = new mysqli('localhost', 'root', 'shrey123', 'id15191429_hms');

				if($conn->connect_error) {
					die('Error :-> '.$conn->connect_error);
				} 

				$stmt = "SELECT * FROM reception WHERE is_deleted=0";
				$result = $conn->query($stmt);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
				?>
						<tr>
							<td><?php echo $row['r_id']; ?></td>
							<td><?php echo $row['r_name']; ?></td>
							<td><?php echo $row['r_email']; ?></td>
							<td><?php echo $row['r_mobile']; ?></td>
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
	$('#recept').DataTable({ "pagingType": "simple_numbers" });
	$('.dataTables_length').addClass('bs-select');
</script>