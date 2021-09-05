<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/datatables.min.js"></script>
<script>
	
	$('#userTable').load('./Manage-Users/doctor-list.php');
	$('#showStaff').on('change', function() {
  		var userValue = this.value;

  		if (userValue == 1) {
  			$('#userTable').load('./Manage-Users/doctor-list.php');
  		}
  		if (userValue == 2) {
  			$('#userTable').load('./Manage-Users/receptionist-list.php');
  		}
  		if (userValue == 3) {
  			$('#userTable').load('./Manage-Users/admin-list.php');
  		}
  		if (userValue == 4) {
  			$('#userTable').load('./Manage-Users/chemist-list.php');
  		}
  		if (userValue == 5) {
  			$('#userTable').load('./Manage-Users/medr-list.php');
  		}
	});


</script>

<div class="manage-user-heading">
	<h3>Manage Users</h3>
</div>

<div class="manage-user-content mt-5">
	<div class="show-users mt-5">
		<div class="user-select-option mb-3">
			<select class="custom-select" id="showStaff" name="showStaff">
				<!-- <option value="0">Select User</option> -->
				<option value="1">Doctor</option>
				<option value="2">Reception</option>
				<option value="3">Administration</option>
				<option value="4">Chemists</option>
				<option value="5">Medical Representatives</option>
			</select>
		</div>
		<button type="button" class="btn btn-info" id="addStaff">Add Staff</button>
		<div class="modal fade" id="users">
		  	<div class="modal-dialog">
		    	<div class="modal-content">

			     	<div class="modal-header">
			        	<h4 class="modal-title">Add Staff</h4>
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			      	</div>

			      	<div class="modal-body">
			      		<div id="addUserData"></div>
			        	<form name="UserData">
			        		<div class="form-group">
			        			<select class="custom-select" id="selectStaff" name="staff">
									<option>Select Staff</option>
									<option value="doctor">Doctor</option>
									<option value="reception">Reception</option>
									<option value="admin">Administration</option>
								</select>

								<input class="form-control mt-3" autocomplete="off" id="name" type="text" name="name" placeholder="Full Name">

								<input class="form-control mt-3" autocomplete="off" id="email" type="text" name="email" placeholder="Email Address">

								<input class="form-control mt-3" autocomplete="off" id="mobile" type="text" name="mobile" placeholder="Mobile Number">

								<div id="doctor-desig"><input class="form-control mt-3" autocomplete="off" id="desig" type="text" name="designation" placeholder="Doctor Designation"></div>

								<button type="submit" id="submit" class="btn btn-warning mt-3 m-0" value="submit" name="submit">Add User</button>

								<p class="mt-3 staff-note">** Please note that Username and Password will be emailed. So please write email address perfectly.</p>
			        		</div>
			        	</form>
			      	</div>

			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			      	</div>
		    	</div>
			</div>
		</div>
	</div>
</div>

<div class="user-table" id="userTable">
	
</div>

<script>
	$(document).ready(function() {
		$('#doctor-desig').hide(3000)
		$('.manage-user-passw i').on('click', function() {
			if ($('#user-passw').attr('type') === 'password') {
				$('#user-passw').attr('type', 'text')
			} else {
				$('#user-passw').attr('type', 'password');
			}
		})

		$('#addStaff').on('click', function() {
			$('#users').modal();
		});

		$('#selectStaff').on('change', function() {
			if ( this.value == 'doctor' ) {
				$('#doctor-desig').fadeIn(1000)
			} else {
				$('#doctor-desig').fadeOut(1000);
			}
		})

		$('form').on('submit', function(e) {
			e.preventDefault();

			var moduleName = $('#selectStaff').val();
			var name = $('#name').val();
			var email = $('#email').val();
			var mobile = $('#mobile').val();
			var desig = $('#desig').val();
			var submit = $('#submit').val();

			$('#addUserData').load('./Manage-Users/Components/addUser.php', {
				module: moduleName,
				name: name,
				email: email,
				mobile: mobile,
				desig: desig,
				submit: submit
			});
		})
	})
</script>