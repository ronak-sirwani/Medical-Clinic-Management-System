<?php

$pages = $_POST['page'];

$conn = new mysqli("localhost", "root", "shrey123", "id15191429_hms");

$stmt = "SELECT * FROM patient LIMIT $pages";
$result = $conn->query($stmt);

while ($row = $result->fetch_assoc()) {
?>
	<tr>
		<td><?php echo $row['p_id']; ?></td>
		<td><?php echo $row['p_name']; ?></td>
		<td><?php echo $row['p_email']; ?></td>
		<td><?php echo $row['p_mobile']; ?></td>
		<td style="text-align: center;">
			<div class="admin-delete">
				<i class="bg-danger fas fa-trash-alt"></i>
			</div>
		</td>
	</tr>
<?php
}
?>

