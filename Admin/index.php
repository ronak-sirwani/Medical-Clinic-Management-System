<?php
session_start();

include '../config.php';

if (!isset($_SESSION['id'])) {
	header('Location: ../index.php');
	die(); 
}

$adminId = $_SESSION['id'];
$stmt = "SELECT ad_name FROM admin WHERE ad_id='$adminId'";
$result = $conn->query($stmt);
$adId = $result->fetch_assoc();

$stmt = "SELECT ad_name, ad_email, ad_mobile FROM admin WHERE ad_id=$adminId";
$result = $conn->query($stmt);
$row = $result->fetch_assoc();
$AdminName = $row['ad_name'];
$AdminEmail = $row['ad_email'];
$AdminMobile = $row['ad_mobile'];

?>

<!DOCTYPE html>
<html>
<head>
	
	<title>ADMIN :: HMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.js"></script>

	<!-- Adding custom CSS file here -->
	<link rel="stylesheet" type="text/css" href="./css/admin-dash-style.css">
	<link rel="stylesheet" type="text/css" href="./css/manage-user-style.css">

	<!-- Adding Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/8e69dd82ea.js" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {

			$('#dashboard').on('click', function() {

				document.title = 'ADMIN :: HMS';

				$('.admin-functions ul li').removeClass('active-tab');
				$('#dashboard').addClass('active-tab');
				
			});

			$('#manage-users').on('click', function() {

				document.title = 'MANAGE USERS :: HMS'
				
				$('.admin-functions ul li').removeClass('active-tab');
				$('#manage-users').addClass('active-tab');
			})
		})

		function logout() {
			window.location.href = './logout.php';
		}

		$('select').on('change', function() {
  			alert( this.value );
		});
	</script>
</head>
<body>

	<div class="admin-dashboard">
		<div class="admin-sidebar">
			<div class="admin-profile">
				<img src="http://placehold.it/1600x900?text=Admin" class="admin-profile-pic">
				<div class="admin-name">
					<h6><?php echo $adId['ad_name']; ?></h6>
					<div class="admin-activity">
						<div></div>
						<p>Admin</p>
					</div>
				</div>
			</div>
			<hr style="margin-left: 15px;margin-right: 15px;">
			<div class="admin-functions">
				<ul>
					<li id="dashboard" class="admin-list active-tab">
						<i class="fas fa-tachometer-alt"></i>
						<span>Dashboard</span>
					</li>
					<li id="appointments" class="admin-list">
						<i class="fas fa-calendar-check"></i>
						<span>Appointments</span>
					</li>
					<li id="patients" class="admin-list">
						<i class="fas fa-hospital-user"></i>
						<span>Patients</span>
					</li>
					<a href="#manageUsers" id="manageUsers">
						<li id="manage-users" class="admin-list">
							<i class="fas fa-users-cog"></i>
							<span>Manage Staff</span>
						</li>
					</a>
					<li id="requests" class="admin-list">
						<i class="fas fa-hospital-user"></i>
						<span>Requests</span>
					</li>
					<li id="profile" class="admin-list">
						<i class="fas fa-user-tie"></i>
						<span>My Profile</span>
					</li>
				</ul>
			</div>
		</div>
		<div class="admin-dash-content">
			<div class="admin-navbar">
				<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
	  				<ul class="navbar-nav">
					    <li class="logout-icon" onclick="logout();">
					    	<i class="fas fa-sign-out-alt"></i>
					    </li>
					</ul>
				</nav>
			</div>
			
			<div class="container mt-3 admin-display-content">
				
			</div>
			<div class="modal fade" id="myModal">
      			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        			<div class="modal-content">
		          		<div class="modal-header">
		            		<h2 class="modal-title">Welcome <?php echo $d_name; ?></h2>
		            		<button type="button" class="close" data-dismiss="modal">×</button>
		          		</div>

          				<div class="modal-body">
            				<div class="nw">
              					<form action="#" method="">
                					<div class="row">
                  						<div class="col-25">
                    						<label for="fname">Full Name</label>
                  						</div>
                  						<div class="col-75">
                    						<input type="text" id="fullname" name="fullname" value="<?php echo $AdminName; ?>" class="inputs" disabled>
                  						</div>
                					</div>
                					<div class="row">
					                  	<div class="col-25">
					                    	<label for="lname">Mobile No</label>
					                  	</div>
					                  	<div class="col-75">
					                    	<input type="tel" id="mobileno" name="mobileno" value="<?php echo $AdminMobile; ?>" pattern="[0-9]{10}" disabled>
					                  	</div>
                					</div>

					                <div class="row">
					                  	<div class="col-25">
					                    	<label for="email">Email id</label>
					                  	</div>
					                  	<div class="col-75">
					                    	<input type="email" id="email" name="mobileno" value="<?php echo $AdminEmail; ?>" disabled>
					                  	</div>
					                </div>
            					</form>

					          	<div class="modal-footer">
					            	<button type="button" class="btn btn-md btn-danger" data-dismiss="modal" id="close">Close</button>
					          	</div>
        					</div>
      					</div>
    				</div>
  				</div>
			</div>
		</div>
	</div>

	<script>
		
		$(document).ready(function() {

			$('.admin-display-content').load('dashboard.php');

			var pathname = window.location.href;
			var path = pathname.split('/');

			if (path[path.length-1] === '#manageUsers') {
				document.title = 'MANAGE USERS :: HMS'
				
				$('.admin-functions ul li').removeClass('active-tab');
				$('#manage-users').addClass('active-tab');

				$('.admin-display-content').load('manage-user.php');

			} 

			$('#dashboard').on('click', function() {
				$('.admin-display-content').load('dashboard.php');
			});

			$('#manage-users').on('click', function() {
				$('.admin-display-content').load('manage-user.php');
			});

			$('#patients').on('click', function() {
				$('.admin-functions ul li').removeClass('active-tab');
				$('#patients').addClass('active-tab');
				$('.admin-display-content').load('Manage-Users/patientList.php');

			})

			$('#appointments').on('click', function() {
				window.location.href = "./appointments.php";
			})

			$('#requests').on('click', function() {
				$('.admin-display-content').load('requests.php');
				$('.admin-functions ul li').removeClass('active-tab');
				$('#requests').addClass('active-tab');
			});

			$('#profile').on('click', function() {
				$('#myModal').modal();
			})
		})

	</script>

</body>
</html>