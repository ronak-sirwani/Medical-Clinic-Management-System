<?php

include '../config.php';
$stmt = "SELECT count(*) FROM chemist WHERE is_approved='0'";
$result = $conn->query($stmt);
$row = $result->fetch_assoc();
$chemistCount = $row['count(*)'];

$stmt = "SELECT count(*) FROM medr WHERE is_approved='0'";
$result = $conn->query($stmt);
$row = $result->fetch_assoc();
$medrCount = $row['count(*)'];

?>
<div class="cards">
	<div class="reqCards card-ch" id="chemistCard">
		<p><span><?php echo $chemistCount; ?></span> New Requests</p>
		<strong>Chemist</strong>
	</div>
	<div class="reqCards card-mr" id="mrCard">
		<p><span><?php echo $medrCount; ?></span> New Requests</p>
		<strong>Medical Rep.</strong>
	</div>
</div>

<div id="showRequests" class="mt-5"></div>

<script>
	$('#chemistCard').on('click', function() {
		$('#showRequests').load('Requests/chemistReq.php');
	})

	$('#mrCard').on('click', function() {
		$('#showRequests').load('Requests/mrReq.php');
	})

	function acceptData(data) {
		var obj = $(data).attr('data-select');
		var temp = obj.split('.');
		console.log('#'+temp[1])

		$('#'+temp[1]).html('<div class="spinner-border spinner-border-sm"></div> Accepting..')
		
		$.ajax({
			type: "POST",
			url: "api/approvalProcd.php",
			data: {
				'type': 'accept',
				'data': obj,
			},
			success: function(data) {
				if (data === 'Process Completed!') {
					if (temp[0] === 'chemist') {
						$('#showRequests').load('Requests/chemistReq.php');
					}

					if (temp[0] === 'medr') {
						$('#showRequests').load('Requests/mrReq.php');
					}
					alert('Accepted!');
				} else {
					alert(data);
				}
			}
		})
	}

	function rejectData(data) {
		var obj = $(data).attr('data-select');
		var temp = obj.split('.');
		
		$('#'+temp[1]).html('<div class="spinner-border spinner-border-sm"></div> Rejecting..')

		$.ajax({
			type: "POST",
			url: "api/approvalProcd.php",
			data: {
				'type': 'reject',
				'data': obj,
			},
			success: function(data) {
				if (data === 'Process Completed!') {
					
					if (temp[0] === 'chemist') {
						$('#showRequests').load('Requests/chemistReq.php');
					}

					if (temp[0] === 'medr') {
						$('#showRequests').load('Requests/mrReq.php');
					}
					alert('Rejected!');
				} else {
					alert(data);
				}
			}
		})
	}
</script>