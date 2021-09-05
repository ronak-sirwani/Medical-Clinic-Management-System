				<?php
					$conn = new mysqli("localhost", "root", "shrey123", "id15191429_hms");
					if ($conn->connect_error) {
						die("Error -> ".$conn->connect_error);
					} else {
						
						$stmt = "SELECT COUNT(*) FROM patient";

						$result = $conn->query($stmt);
						$row = $result->fetch_assoc();
						
						$patientCount = $row["COUNT(*)"];

						$stmt = "SELECT COUNT(*) FROM appointment;";
						$result = $conn->query($stmt);
						$row = $result->fetch_assoc();
						
						$aptCount = $row["COUNT(*)"];

						$revenue = (int)$aptCount * 500;
					}
				?>

				<div class="admin-cards">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
							<div class="admin-pat-card admin-card">
								<div class="admin-card-content">
									<h1><?php echo $patientCount; ?></h1>
									<h5>Patients</h5>
								</div>
								<a href="#patients" id="patientList">Edit <span><i class="fas fa-long-arrow-alt-right"></i></span></a>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
							<div class="admin-appoint-card admin-card">
								<div class="admin-card-content">
									<h1><?php echo $aptCount; ?></h1>
									<h5>Appointments</h5>
								</div>
								<a href="./appointments.php">Edit <span><i class="fas fa-long-arrow-alt-right"></i></span></a>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<div class="admin-revenue-card admin-card">
								<div class="admin-card-content">
									<h1><?php echo $revenue; ?> Rs</h1>
									<h5>Revenue</h5>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="admin-table">
					<div class="appoint-table">
						<h3>Latest - Appoitments</h3>
					</div>
					
					<div class="table-responsive mt-4">
						<table class="table table-hover" id="test">
							<thead>
								<tr>
									<th style="width: 10%;">ID</th>
									<th style="width: 30%;">Patient Name</th>
									<th style="width: 30%;">Doctor Name</th>
									<th style="width: 20%;">Date</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$stmt = "SELECT * FROM appointment WHERE apt_id > ((SELECT COUNT(*) FROM appointment) - 5 )";
									$result = $conn->query($stmt);

									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											$doctorId = $row['d_id'];
											$stmt = "SELECT d_name from doctor WHERE d_id='$doctorId'";
											$check = $conn->query($stmt);
											$doctorName = $check->fetch_assoc();
										?>
											<tr>
												<td><?php echo $row['apt_id']; ?></td>
												<td><?php echo $row['apt_name']; ?></td>
												<td><?php echo $doctorName['d_name']; ?></td>
												<td><?php echo $row['apt_date']; ?></td>
												<td>
													<?php
														if ($row['apt_status'] === 'pending') {
															echo "<div class='pill pill-pending bg-secondary'><span>Pending</span></div>";
														} elseif ($row['apt_status'] === 'declined') {
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
					$('#patientList').on('click', function() {
						$('.admin-functions ul li').removeClass('active-tab');
						$('#patients').addClass('active-tab');
						$('.admin-display-content').load('Manage-Users/patientList.php');
					})
				</script>
