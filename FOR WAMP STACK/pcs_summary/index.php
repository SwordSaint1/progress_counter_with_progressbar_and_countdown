<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="assets/icons/outline_track_changes_white_24dp.png" type="image/png" sizes="16x16">
	<meta charset="utf-8">
	<title>PROGRESS COUNTER SUMMARY</title>
	<link rel="stylesheet" type="text/css" href="node_modules/materialize-css/dist/css/materialize.min.css">
</head>
<body>
	<?php require 'function/conn.php';?>
	<div class="row">
		<span class="left"><img src="assets/" alt=""></span>
		<h5 class="center">PRODUCTION PROGRESS SUMMARY</h5>
		<div class="col s12">
			<div class="col s4">
				<select name="" id="carmodel_select" class="browser-default z-depth-2" onchange="load_progress()">
					<option value="">--SELECT CARMODEL--</option>
					<?php
					$getCarModel = "SELECT DISTINCT SUBSTRING_INDEX(ircs_line,'_',1) as carmodel FROM pcs_ircs_line ORDER BY ircs_line ASC";
					$stmt = $conn->prepare($getCarModel);
					$stmt->execute();
					foreach($stmt->fetchALL() as $x){
						echo '<option value="'.$x['carmodel'].'">'.$x['carmodel'].'</option>';
					}
					?>
				</select>
			</div>
			
			<!-- SHIFT -->
			<div class="col s4">
				<select name="" id="shift" class="browser-default z-depth-2" onchange="load_progress()">
				<?php
					if($server_time > '08:00:00' && $server_time < '29:59:59'){
						echo '<option value="DS">DS</option>';
						echo '<option value="NS">NS</option>';
					}else{
						echo '<option value="NS">NS</option>';
						echo '<option value="DS">DS</option>';
					}
				?>
				</select>
			</div>


		</div>


		<div class="col s12 collection">
			<table class="centered">
				<thead>
					<th>#</th>
					<th>CARMODEL</th>
					<th>LINE</th>
					<th>IRCS NAME</th>
					<th>PLAN</th>
					<th>ACTUAL</th>
					<th>DIFFERENCE</th>
				</thead>
				<tbody id="progress_data"></tbody>
			</table>
		</div>
	</div>




	<script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="node_modules/materialize-css/dist/js/materialize.min.js"></script>
	<script>
	$(document).ready(function(){
		$('.datepicker').datepicker({
			autoClose: true,
			format: 'yyyy-mm-dd'
		});

		setTimeout(load_progress,2000);
	});
	
	const load_progress =()=>{
		var carmodel = $('#carmodel_select').val();
		var date_plan = $('#date_plan').val();
		var shift = $('#shift').val();

		$.ajax({
			url: 'function/controller.php',
			cache: false,
			type: 'POST',
			data:{
				carmodel:carmodel,
				date_plan:date_plan,
				shift:shift,
				method: 'fetch_progress_live'
			},success:function(data){
				console.log(data);
				$('#progress_data').html(data);
				setTimeout(load_progress,20000);
			}
			
		});

	}

	</script>
</body>
</html>