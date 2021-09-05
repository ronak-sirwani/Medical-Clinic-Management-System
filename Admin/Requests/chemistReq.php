<?php
	include '../../config.php';

	$stmt = 'SELECT ch_id,ch_name,ch_email,ch_shopName,ch_shopAddr FROM chemist WHERE is_approved=0';
	$result = $conn->query($stmt);

	if ($result->num_rows >= 1) {
		while($row = $result->fetch_assoc()) {
	?>
			<div class="request mt-2">
				<div class="requestHead">
					<p>Owner :- <?php echo $row['ch_name']; ?></p>
					<div class="approval">
						<button class="btn btn-success" id="<?php echo $row['ch_id']; ?>" data-select="<?php echo 'chemist.'.$row['ch_id']; ?>" onclick="acceptData(this)">Accept</button>
						<button class="btn btn-danger" id="<?php echo $row['ch_id']; ?>" data-select="<?php echo 'chemist.'.$row['ch_id']; ?>" onclick="rejectData(this)">Reject</button>
					</div>
				</div>
				<div class="requestContent mt-2">
					<p>Shop Name :-  <strong><?php echo $row['ch_shopName']; ?></strong></p>
					<p>Email Address :-  <strong><?php echo $row['ch_email']; ?></strong></p>
				</div>
			</div>
	<?php
		}
	}

?>