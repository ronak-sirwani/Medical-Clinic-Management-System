<div class="admin-table table-responsive mt-4">
	<table class="table table-hover" id="medr">
		<thead>
			<tr>
				<th>ID</th>
				<th>MedR Name</th>
				<th>MedR Email</th>
				<th>MedR Mobile</th>
				<th>MedR Brand</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody id="patients">
			<?php

				include '../../config.php';

				$stmt = "SELECT * FROM medr";
				$result = $conn->query($stmt);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
				?>
						<tr>
							<td><?php echo $row['mr_id']; ?></td>
							<td><?php echo $row['mr_name']; ?></td>
							<td><?php echo $row['mr_email']; ?></td>
							<td><?php echo $row['mr_mobile']; ?></td>
							<td><?php echo $row['mr_brand']; ?></td>
							<td>
				<?php
								if ($row['is_approved'] === '0') {
										echo "<div class='pill pill-pending bg-secondary'><span>Pending</span></div>";
									} elseif ($row['is_approved'] === '2') {
										echo "<div class='pill pill-danger bg-danger'><span>Rejected</span></div>";
									} else {
										echo "<div class='pill pill-success bg-success'><span>Success</span></div>";
									}
				?>
							</td>
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
	$('#medr').DataTable({ "pagingType": "simple_numbers" });
	$('.dataTables_length').addClass('bs-select');
</script>
