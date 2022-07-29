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
<h5 class="header center">IRCS Line</h5>
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
					<a href="dashboard.php" class="collection-item active">Register IRCS Line</a>
					<a href="progress_counter_plan.php" class="collection-item">Progress Counter Plan</a>
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
						<div class="input-field col s8">
							<input type="text" name="" id="ircsLineTxt" onchange="loadIrcsLine()"><label>Search IRCS Line/Line Number</label>
						</div>
						<div class="input-field col s4">
							<button class="btn col s12 teal modal-trigger z-depth-5" data-target="modalRegisterIRCSLine" onclick="viewFormRegister()" style="border-radius:20px;" >New</button>
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
							<th>IP Address</th>
						</thead>
					</table>
				</div>
				<div class="row col s12" id="handler" style="height:60vh;overflow: auto;">
					<table class="highlight">
						<tbody id="dataIrcsLine"></tbody>
					</table>
				</div>
				<div class="" id="loading"></div>
		</div>
	</div>
</div>
<!-- MODALS -->
<?php 
include 'Modal/viewLineModal.php';
include 'Modal/logout.php';
include 'Modal/registerNewIRCSLine.php';
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
		loadIrcsLine();
	});
// FUNCTIONS -----------------------------------------------------------------------------------------------------------------
	const loadIrcsLine =()=>{
		txt = $('#ircsLineTxt').val();
		$('#loading').addClass('spinner');
		$.ajax({
			url: '../php/controller.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'loadIrcsLine',
				txt:txt
			},success:function(response){
				$('#dataIrcsLine').html(response);
				$('#loading').removeClass('spinner');
			}
		});
	}
// -----------------------------------------------------------------------------------------------------------------------------
	const viewLine =(param)=>{
		var lineString = param.split('*!*');
		var id = lineString[0];
		var line_name = lineString[1];
		var ircs_line = lineString[2];
		var ip = lineString[3];
		document.getElementById('contentID').value = id;
		document.getElementById('line_name_txt').value = line_name;
		document.getElementById('ircs_line_txt').value = ircs_line;
		document.getElementById('ip_txt').value = ip;
		document.getElementById('recent_ip_txt').value = ip;
		validateIP();
	}
// ------------------------------------------------------------------------------------------------------------------------------
	const updateIRCSLine =()=>{
		id = document.getElementById('contentID').value;
		ipNew = document.getElementById('ip_txt').value;
		new_line_name = document.getElementById('ircs_line_txt').value;
		$('#updateBtn').attr('disabled',true);
		$('#updateBtn').html('Updating...');
		$.ajax({
			url: '../php/controller.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'updateLine',
				id:id,
				ipNew:ipNew,
				new_line_name:new_line_name
			},success:function(response){
				swal('Nofitication',response,'info');
				loadIrcsLine();
				$('#updateBtn').attr('disabled',false);
				$('#updateBtn').html('update');
				$('.modal').modal('close','#viewIRCSLineModal');
			}
		});
	}
// ------------------------------------------------------------------------------------------------------------------------------
	const validateIP =()=>{
		recent_IP_txt = document.getElementById('recent_ip_txt').value;
		newIP = document.getElementById('ip_txt').value;
		if(newIP == recent_IP_txt){
			document.getElementById('updateBtn').disabled = true;
		}else{
			document.getElementById('updateBtn').disabled = false;
		}
	}
// -----------------------------------------------------------------------------------------------------------------------------
const validate_name =()=>{
		recent = document.getElementById('recent_line_name').value;
		new_line_name = document.getElementById('ircs_line_txt').value;
		if(new_line_name == recent){
			document.getElementById('updateBtn').disabled = true;
		}else{
			document.getElementById('updateBtn').disabled = false;
		}
	}
// ------------------------------------------------------------------------------------------------------------------------------
	const deleteIRCSLinename =()=>{
		var id = document.getElementById('contentID').value;
		var x = confirm('To confirm delete, please click OK');
		if(x==true){
			$.ajax({
				url: '../php/controller.php',
				type: 'POST',
				cache:false,
				data:{
					method: 'deleteIRCSLineName',
					id:id
				},success:function(response){
					swal('Nofitication',response,'info');
					$('.modal').modal('close','#viewIRCSLineModal');
					loadIrcsLine();
				}
			});
		}else{
			M.toast({html:'Canceled',classes:'green rounded'});
		}
	}
// -------------------------------------------------------------------------------------------------------------------------------
	const viewFormRegister =()=>{
		$('#registerIRCSLineForm').load('Form/registerNewIRCSLineForm.php');
	}
// -------------------------------------------------------------------------------------------------------------------------------
	const addIRCSLine =()=>{
		var line_number = document.getElementById('line_number_reg').value;
		var ircs_line_name = document.getElementById('ircs_line_reg').value;
		var ip_address = document.getElementById('ip_address_reg').value;
		if(line_number == ''){
			swal('Nofitication','Please input the Line Number!','info');
		}else if(ircs_line_name == ''){
			swal('Nofitication','Please input the IRCS Line Name!','info');
		}else if(ip_address == ''){
			swal('Nofitication','Please input the IP Address!','info');
		}else{
			$('#registerIRCSLineNameBtn').attr('disabled',true);
			$.ajax({
				url: '../php/controller.php',
				type: 'POST',
				cache: false,
				data: {
					method: 'addIRCSLineName',
					line_number:line_number,
					ircs_line_name:ircs_line_name,
					ip_address:ip_address
				},success:function(response){
					$('#registerIRCSLineNameBtn').attr('disabled',false);
					swal('Notification',response,'info');
					loadIrcsLine();
					$('.modal').modal('close','#modalRegisterIRCSLine');
				}
			});
		}
	}
// -------------------------------------------------------------------------------------------------------------------------------
</script>
</body>
</html>
<?php $conn = null;?>