<?php 
require '../php/server.php';
require '../php/session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PCS Admin - <?=$name;?></title>
	<link rel="stylesheet" type="text/css" href="../node_modules/materialize-css/dist/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>
<h5 class="header center">Progress Counter Plan</h5>
<!-- SIDENAV -->
<ul id="slide-out" class="sidenav">
	<li><a href="dashboard.php" class="collection-item active">Register IRCS Line</a></li>
	<li><a href="progress_counter_plan.php" class="collection-item">Progress Counter Plan</a></li>
	<li><a href="fit_resolution_line.php" class="collection-item">Fit Resolution PCS</a></li>
	<li><a href="parts_management.php" class="collection-item">Manage Parts</a></li>
	<li><a href="#" class="collection-item modal-trigger" data-target="modalLogout">Logout</a></li>
</ul>
<div class="row">
	<a href="#" class="sidenav-trigger btn-small hide-on-med-and-up" data-target="slide-out">&plus;</a>
	<!-- SIDE -->
	<div class="col l3 m3">
		<div class="row hide-on-small-only">
				<div class="collection">
					<a href="dashboard.php" class="collection-item">Register IRCS Line</a>
					<a href="progress_counter_plan.php" class="collection-item active">Progress Counter Plan</a>
					<a href="fit_resolution_line.php" class="collection-item">Fit Resolution PCS</a>
					<a href="parts_management.php" class="collection-item">Manage Parts</a>
					<a href="#" class="collection-item modal-trigger" data-target="modalLogout">Logout</a>
				</div>
				<div class="divider"></div>
				<br>
				<center>
					<img src="../Img/icon.png" class="responsive-img" width="100">
				</center>
		</div>
	</div>
	<!-- CONTAINER -->
	<div class="col l9 m9">
		<div class="row">
				<div class="row">
					<div class="col s12">
						<div class="input-field col s12">
							<input type="text" name="" id="ircsPlanTxt" onchange="loadIRCSPlan()"><label>Search IRCS Line/Line Number</label>
						</div>
					</div>
				</div>
				<!-- TABLE------------------------------------------------------------------------------------------------- -->
				<div class="row col s12">
					<table>
						<thead>
							<th>ID</th>
							<th>Carmodel</th>
							<th>Line</th>
							<th>Target</th>
							<th>Status</th>
							<th>IRCS Line Name</th>
							<th>IP Address</th>
						</thead>
					</table>
				</div>
				<div class="row col s12" id="handler" style="height:60vh;overflow: auto;">
					<table class="highlight">
						<tbody id="dataIrcsPlan"></tbody>
					</table>
				</div>
				<div class="" id="loading"></div>
		</div>
	</div>
</div>
<?php 
require 'Modal/logout.php';
require 'Modal/viewIRCSPlan.php';
?>
<!-- JS -->
<script type="text/javascript" src="../node_modules/materialize-css/dist/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../node_modules/materialize-css/dist/js/materialize.min.js"></script>
<script type="text/javascript" src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.modal').modal({
			inDuration: 800,
			outDuration: 500
		});
		$('.sidenav').sidenav();
		loadIRCSPlan();
	});
// -------------------------------------------------------------------------------------------------------------------------------------
	const loadIRCSPlan =()=>{
		$('#loading').addClass('spinner');
		var keyword = document.getElementById('ircsPlanTxt').value;
		$.ajax({
			url: '../php/controller.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'loadIRCSPlan',
				keyword:keyword
			},success:function(response){
				$('#loading').removeClass('spinner');
				$('#dataIrcsPlan').html(response);
			}
		});
	}
// --------------------------------------------------------------------------------------------------------------------------------------
	const viewPlan =(param)=>{
		var string = param.split('~!~');
		var id = string[0];
		var recent_ip = string[1];
		document.getElementById('planID').value = id;
		document.getElementById('ip_address').value = recent_ip;
		document.getElementById('recent_ip').value = recent_ip;
		validateIP();
	}
// ----------------------------------------------------------------------------------------------------------------------------------------
	const validateIP =()=>{
		recent = document.getElementById('recent_ip').value;
		newIP = document.getElementById('ip_address').value;
		if(newIP == recent){
			document.getElementById('updateBtn').disabled = true;
		}else{
			document.getElementById('updateBtn').disabled = false;
		}
	}
// ----------------------------------------------------------------------------------------------------------------------------------------
	const updateIrcsIPPlan =()=>{
		var id = document.getElementById('planID').value;
		var ip = document.getElementById('ip_address').value;
		if(ip == ''){
			swal('Notification','Please input IP Address!','info');
		}else{
			document.getElementById('updateBtn').disabled = true;
			document.getElementById('updateBtn').innerHTML = 'Updating..';
			$.ajax({
				url: '../php/controller.php',
				type: 'POST',
				cache: false,
				data: {
					method: 'updateIrcsIPPlan',
					id:id,
					ip:ip
				},success:function(response){
					swal('Notification',response,'info');
					loadIRCSPlan();
					document.getElementById('updateBtn').innerHTML = 'Update';
					$('modal').modal('close','#modalviewIRCSPlan');
				}
			});
		}
	}
</script>
</body>
</html>