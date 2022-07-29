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
<h5 class="header center">Manage Parts</h5>
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
					<a href="fit_resolution_line.php" class="collection-item">Fit Resolution PCS</a>
					<a href="parts_management.php" class="collection-item active">Manage Parts</a>
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
						<div class="input-field col s10">
							<input type="text" name="" id="searchKey" onchange="load_parts()"><label>Search IRCS Line Name</label>
						</div>
						<div class="input-field col s2"><button class="btn blue col s12 modal-trigger z-depth-3" data-target="create-modal" onclick="load_parts_form()">new &plus;</button></div>
					</div>
				</div>
				<!-- TABLE------------------------------------------------------------------------------------------------- -->
				<div class="row col s12">
					<table>
						<thead>
							<th>ID</th>
							<th>Parts/Parts No.</th>
							<th>Line Name</th>
						</thead>
					</table>
				</div>
				<div class="row col s12" id="handler" style="height:60vh;overflow: auto;">
					<table class="highlight">
						<tbody id="data_parts"></tbody>
					</table>
				</div>
				<div class="" id="loading"></div>
		</div>
	</div>
</div>
<?php 
require 'Modal/logout.php';
require 'Modal/viewIRCSPlan.php';
require 'Modal/viewPart.php';
require 'Modal/create-modal.php';
?>
<script type="text/javascript" src="../node_modules/materialize-css/dist/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../node_modules/materialize-css/dist/js/materialize.min.js"></script>
<script type="text/javascript" src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.modal').modal();
		$('.sidenav').sidenav();
		load_parts();
	});	
// LOAD PARTS
	const load_parts =()=>{
		$('#loading').addClass('spinner');
		var keyword = document.getElementById('searchKey').value;
		$.ajax({
			url: '../php/controller.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'load_parts',
				keyword:keyword
			},success:function(response){
				$('#loading').removeClass('spinner');
				$('#data_parts').html(response);
			}
		});
	}
// GET VALUE
	const get_id =(param)=>{
		var character = param.split('~!~');
		var id = character[0];
		var parts = character[1];
		var line_name = character[2];
		document.getElementById('ref_id').value = id;
		document.getElementById('part_number').value = parts;
		document.getElementById('line_name').value = line_name;
	}
// LOAD FORM FOR CREATING PARTS
	const load_parts_form =()=>{
		$('#render-create-part').load('Form/reg-parts.php');
	}
// REGISTER PARTS
	const register_parts =()=>{
		var part = document.querySelector('#parts_number_reg').value;
		var line_name = document.querySelector('#line_name_reg').value;
		if(part == ''){
			swal('Notification','Please enter parts number!','info');
		}
		else if(line_name == ''){
			swal('Notification','Please select the line name!','info');
		}
		else{
			$.ajax({
				url: '../php/controller.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'create-part',
					part:part,
					line_name:line_name
				},success:function(response){
					if(response == 'success'){
						$('.modal').modal('close','#create-modal');
						M.toast({html: 'Successfully registed!',classes:'rounded blue'});
						load_parts();
					}else{
						swal('Notification','Error','error');
					}
				}
			});
		}

	}
// DELETE PARTS
 	const del_part =()=>{
 		var id = document.querySelector('#ref_id').value;
 		var x = confirm('Confirmation. Click OK to proceed!');
 		if(x == true){
 			$.ajax({
 				url:'../php/controller.php',
 				type: 'POST',
 				cache: false,
 				data:{
 					method: 'delete_part',
 					id:id
 				},success:function(response){
 					if(response == 'done'){
 						$('.modal').modal('close','#viewPart');
 						load_parts();
 						M.toast({html: 'Deleted!',classes:'rounded blue'});
 					}else{
 						swal('Error!');
 					}
 				}
 			});
 		}else{
 			// DO NOTHING
 		}
 	}
 // UPDATE PART
 	const update_part =()=>{
 		var id = document.querySelector('#ref_id').value;
 		var parts = document.querySelector('#part_number').value;
 		var line = document.querySelector('#line_name').value;
 		if(parts == ''){
 			swal('Notification','Please enter parts number!','info');
 		}else if(line == ''){
 			swal('Notification','Please enter the IRCS line name!','info');
 		}else{
 			$.ajax({
 				url: '../php/controller.php',
 				type: 'POST',
 				cache: false,
 				data:{
 					method: 'update_part',
 					id:id,
 					parts:parts,
 					line:line
 				},success:function(response){
 					if(response == 'done'){
 						$('.modal').modal('close','#viewPart');
 						load_parts();
 						M.toast({html: 'Updated!',classes:'rounded blue'});
 					}else{
 						swal('Notification','Error!','info');
 					}
 				}
 			});
 		}
 	}
</script>
</div>
</body>
</html>