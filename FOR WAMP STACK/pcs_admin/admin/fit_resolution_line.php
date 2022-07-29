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
<h5 class="header center">Fit Resolution Registry</h5>
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
					<a href="progress_counter_plan.php" class="collection-item">Progress Counter Plan</a>
					<a href="fit_resolution_line.php" class="collection-item active">Fit Resolution PCS</a>
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
						<div class="input-field col s8">
							<input type="text" name="" id="ircsLineTxt" onchange="loadIrcsResolution()"><label>Search IRCS Line/Line Number</label>
						</div>
						<div class="input-field col s4">
							<button class="btn col s12 teal modal-trigger z-depth-5" data-target="modalresolution" onclick="loadresolutionForm()" style="border-radius:20px;">Add</button>
						</div>
					</div>
				</div>
				<!-- TABLE------------------------------------------------------------------------------------------------- -->
				<div class="row col s12">
					<table>
						<thead>
							<th>ID</th>
							<th>Line Number</th>
							<th>IRCS Line Name</th>
						</thead>
					</table>
				</div>
				<div class="row col s12" id="handler" style="height:60vh;overflow: auto;">
					<table class="highlight">
						<tbody id="dataIrcsResolution"></tbody>
					</table>
				</div>
				<div class="" id="loading"></div>
		</div>
	</div>
</div>
<?php 
require 'Modal/logout.php';
require 'Modal/modalResolutiontv.php';
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
		loadIrcsResolution();
	});
// --------------------------------------------------------------------------------------------------------------------------------------
	const loadIrcsResolution =()=>{
		var txt = document.getElementById('ircsLineTxt').value;
		$.ajax({
			url: '../php/controller.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'loadResolution',
				txt:txt
			},success:function(response){
				document.getElementById('dataIrcsResolution').innerHTML = response;
			}
		});
	}
// --------------------------------------------------------------------------------------------------------------------------------------
	const loadresolutionForm =()=>{
		$('#spinner').addClass('spinner');
		$('#ResolutionForm').load('Form/registerResolution.php');
		$('#spinner').removeClass('spinner');
	}
// --------------------------------------------------------------------------------------------------------------------------------------
	const autocompleteLineNo =()=>{
		line_name_val = document.getElementById('ircs_line_name_txt').value;
		document.getElementById('registerBtn').disabled = false;
		$.ajax({
			url: '../php/controller.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'fetchLineNumber',
				line_name_val:line_name_val
			},success:function(response){
				document.getElementById('line_number_txt').value = response;
			}
		});
	}
// ----------------------------------------------------------------------------------------------------------------------------------------
	const registerTV =()=>{
		var ircs_name_new = document.getElementById('ircs_line_name_txt').value;
		var line_number_val_new = document.getElementById('line_number_txt').value;
		$.ajax({
			url: '../php/controller.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'registertoResolution',
				ircs_name_new:ircs_name_new,
				line_number_val_new:line_number_val_new
			},success:function(response){
				loadIrcsResolution();
				swal('Notification',response,'info');
				$('.modal').modal('close','#modalresolution');
			}
		});
	}
// -----------------------------------------------------------------------------------------------------------------------------------------
	const deleteFit =(id)=>{
		var x = confirm('To confirm delete, please click OK.');
		if(x == true){
			$.ajax({
				url: '../php/controller.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'deleteResolution',
					id:id
				},success:function(response){
					swal('Notification',response,'info');
					loadIrcsResolution();
				}
			});
		}else{
			M.toast({html:'Cancelled!',classes:'green rounded'});
		}
	}
</script>
</body>
</html>