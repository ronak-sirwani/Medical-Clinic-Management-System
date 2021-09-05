<?php
	include '../../config.php';

	$stmt = 'SELECT mr_id, mr_name,mr_email,mr_brand FROM medr WHERE is_approved=0';
	$result = $conn->query($stmt);

	if ($result->num_rows >= 1) {
		while($row = $result->fetch_assoc()) {
	?>
			<div class="request mt-2">
				<div class="requestHead">
					<p>Owner :- <?php echo $row['mr_name']; ?></p>
					<div class="approval">
						<button class="btn btn-success" id="<?php echo $row['mr_id']; ?>" data-select="<?php echo 'medr.'.$row['mr_id']; ?>" onclick="acceptData(this)">Accept</button>
						<button class="btn btn-danger" id="<?php echo $row['mr_id']; ?>" data-select="<?php echo 'medr.'.$row['mr_id']; ?>" onclick="rejectData(this)">Reject</button>
					</div>
				</div>
				<div class="requestContent mt-2">
					<p>Shop Name :-  <strong><?php echo $row['mr_brand']; ?></strong></p>
					<p>Email Address :-  <strong><?php echo $row['mr_email']; ?></strong></p>
				</div>
			</div>
	<?php
		}
	}

?>
