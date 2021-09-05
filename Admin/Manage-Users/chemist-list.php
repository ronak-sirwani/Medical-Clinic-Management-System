<div class="admin-table table-responsive mt-4">
	<table class="table table-hover" id="chemist">
		<thead>
			<tr>
				<th>ID</th>
				<th>Chemist Name</th>
				<th>Chemist Email</th>
				<th>Chemist Mobile</th>
				<th>Chemist Shop Name</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody id="patients">
			<?php

				include '../../config.php';

				$stmt = "SELECT * FROM chemist";
				$result = $conn->query($stmt);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
				?>
						<tr>
							<td><?php echo $row['ch_id']; ?></td>
							<td><?php echo $row['ch_name']; ?></td>
							<td><?php echo $row['ch_email']; ?></td>
							<td><?php echo $row['ch_mobile']; ?></td>
							<td><?php echo $row['ch_shopName']; ?></td>
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
	$('#chemist').DataTable({ "pagingType": "simple_numbers" });
	$('.dataTables_length').addClass('bs-select');
</script>
