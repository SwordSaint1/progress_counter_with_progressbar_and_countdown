<?php 
require 'conn.php';
$method = $_POST['method'];
define('method',$method);
if(method == 'loadIrcsLine'){
	$txt = $_POST['txt'];
	$txt = trim($txt);
	if(empty($txt)){
		$qry = "SELECT *FROM pcs_ircs_line ORDER BY ID DESC";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		$res = $stmt->fetchAll();
			foreach($res as $x){
			echo '<tr onclick="viewLine(&quot;'.$x['ID'].'*!*'.$x['line_name'].'*!*'.$x['ircs_line'].'*!*'.$x['IP_address'].'&quot;)" class="modal-trigger" data-target="viewIRCSLineModal">';
			echo '<td>'.$x['ID'].'</td>';
			echo '<td>'.$x['line_name'].'</td>';
			echo '<td>'.$x['ircs_line'].'</td>';
			echo '<td>'.$x['IP_address'].'</td>';
			echo '</tr>';
			}
	}else{
		$qry = "SELECT *FROM pcs_ircs_line WHERE line_name LIKE '$txt%' OR ircs_line LIKE '$txt%' ORDER BY ID DESC";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		$res = $stmt->fetchAll();
			foreach($res as $x){
			echo '<tr onclick="viewLine(&quot;'.$x['ID'].'*!*'.$x['line_name'].'*!*'.$x['ircs_line'].'*!*'.$x['IP_address'].'&quot;)" class="modal-trigger" data-target="viewIRCSLineModal">';
			echo '<td>'.$x['ID'].'</td>';
			echo '<td>'.$x['line_name'].'</td>';
			echo '<td>'.$x['ircs_line'].'</td>';
			echo '<td>'.$x['IP_address'].'</td>';
			echo '</tr>';
			}
	}
}
// ---------------------------------------------------------------------------------------------------------------------------------------
elseif(method == 'updateLine'){
	$id = $_POST['id'];
	$ip = $_POST['ipNew'];
	$line_name = $_POST['new_line_name'];
	$update = "UPDATE pcs_ircs_line SET IP_address = '$ip', ircs_line = '$line_name' WHERE ID = '$id'";
	$stmt = $conn->prepare($update);
	if($stmt->execute()){
		echo 'Updated!';
	}else{
		echo 'Failed!';
	}
}
// ------------------------------------------------------------------------------------------------------------------------------------------
elseif(method == 'addIRCSLineName'){
	$id = 0;
	$line_number = $_POST['line_number'];
	$ircs_line_name = strtoupper($_POST['ircs_line_name']);
	$ip_address = $_POST['ip_address'];
	// CHECK LINE NAME
	// $check = "SELECT ID FROM pcs_ircs_line WHERE ircs_line = '$ircs_line_name'";
	// $stmt = $conn->prepare($check);
	// $stmt->execute();
	// $stmt->fetchALL();
	// if($stmt->rowCount() > 0){
	// 	echo 'IRCS Line Name was already registered!';
	// }else{
		$qry = "INSERT INTO pcs_ircs_line (`ID`,`line_name`,`ircs_line`,`IP_address`) VALUES ('$id','$line_number','$ircs_line_name','$ip_address')";
		$stmt = $conn->prepare($qry);
		if($stmt->execute()){
			echo 'Successfully registered!';
		}else{
			echo 'Failed!';
		}
	// }
}	
// -----------------------------------------------------------------------------------------------------------------------------------------
elseif(method == 'deleteIRCSLineName'){
	$id = $_POST['id'];
	$qry = "DELETE FROM pcs_ircs_line WHERE ID = '$id'";
	$stmt = $conn->prepare($qry);
	if($stmt->execute()){
		echo 'Deleted!';
	}else{
		echo 'Failed!';
	}
}
// ------------------------------------------------------------------------------------------------------------------------------------------
elseif(method == 'loadIRCSPlan'){
	$keyword = trim($_POST['keyword']);
	if(empty($keyword)){
		$qry = "SELECT ID,Carmodel,Line,Target,Status,IRCS_Line,IP_address FROM pcs_plan ORDER BY ID DESC";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		$result = $stmt->fetchALL();
		if($stmt->rowCount() > 0){
			foreach($result as $x){
				echo '<tr class="modal-trigger" data-target="modalviewIRCSPlan" onclick="viewPlan(&quot;'.$x['ID'].'~!~'.$x['IP_address'].'&quot;)">';
				echo '<td>'.$x['ID'].'</td>';
				echo '<td>'.$x['Carmodel'].'</td>';
				echo '<td>'.$x['Line'].'</td>';
				echo '<td>'.$x['Target'].'</td>';
				echo '<td>'.$x['Status'].'</td>';
				echo '<td>'.$x['IRCS_Line'].'</td>';
				echo '<td>'.$x['IP_address'].'</td>';
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td colspan="7">No Result</td>';
			echo '</tr>';
		}
	}else{
		$qry = "SELECT ID,Carmodel,Line,Target,Status,IRCS_Line,IP_address FROM pcs_plan WHERE Carmodel LIKE '$keyword%' OR Line like '$keyword%' OR IRCS_Line LIKE '$keyword%' ORDER BY ID DESC"; 
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo '<tr class="modal-trigger" data-target="modalviewIRCSPlan" onclick="viewPlan(&quot;'.$x['ID'].'~!~'.$x['IP_address'].'&quot;)">';
			echo '<td>'.$x['ID'].'</td>';
			echo '<td>'.$x['Carmodel'].'</td>';
			echo '<td>'.$x['Line'].'</td>';
			echo '<td>'.$x['Target'].'</td>';
			echo '<td>'.$x['Status'].'</td>';
			echo '<td>'.$x['IRCS_Line'].'</td>';
			echo '<td>'.$x['IP_address'].'</td>';
			echo '</tr>';
		}
	}
}
// ----------------------------------------------------------------------------------------------------------------------------------------
elseif(method == 'updateIrcsIPPlan'){
	$id = $_POST['id'];
	$ip = $_POST['ip'];
	$qry = "UPDATE pcs_plan SET IP_address = '$ip' WHERE ID = '$id'";
	$stmt = $conn->prepare($qry);
	if($stmt->execute()){
		echo 'IP Address successfully updated!';
	}else{
		echo 'Failed!';
		}
	}
// -------------------------------------------------------------------------------------------------------------------------------------/*
elseif(method == 'loadResolution'){
	$keyword = trim($_POST['txt']);
	if(empty($keyword)){
		$qry = "SELECT *FROM pcs_resolution_tv ORDER BY id DESC";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo '<tr onclick="deleteFit('.$x['id'].')">';
			echo '<td>'.$x['id'].'</td>';
			echo '<td>'.$x['line_number'].'</td>';
			echo '<td>'.$x['ircs_line_name'].'</td>';
			echo '</tr>';
		}
	}else{
		$qry = "SELECT *FROM pcs_resolution_tv WHERE ircs_line_name LIKE '$keyword%' OR line_number LIKE '$keyword%'";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			foreach($stmt->fetchALL() as $x){
				echo '<tr onclick="deleteFit('.$x['id'].')">';
				echo '<td>'.$x['id'].'</td>';
				echo '<td>'.$x['line_number'].'</td>';
				echo '<td>'.$x['ircs_line_name'].'</td>';
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td colspan="3">No Results</td>';
			echo '</tr>';
		}
	}
}
// ---------------------------------------------------------------------------------------------------------------------------------------
elseif(method == 'fetchLineNumber'){
	$line_name = $_POST['line_name_val'];
	$qry = "SELECT line_name FROM pcs_ircs_line WHERE ircs_line = '$line_name'";
	$stmt = $conn->prepare($qry);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		echo $x['line_name'];
	}
}	
// ---------------------------------------------------------------------------------------------------------------------------------------
elseif(method == 'registertoResolution'){
	$line_number = $_POST['line_number_val_new'];
	$ircs_line_name = $_POST['ircs_name_new'];
	$check  = "SELECT id FROM pcs_resolution_tv WHERE ircs_line_name = '$ircs_line_name'";
	$stmt = $conn->prepare($check);
	$stmt->execute();
	$stmt->fetchALL();
	if($stmt->rowCount() > 0){
		echo 'This IRCS Line Name was already registered!';
	}else{
		$qry = "INSERT INTO pcs_resolution_tv (`id`,`line_number`,`ircs_line_name`) VALUES('','$line_number','$ircs_line_name')";
		$stmt = $conn->prepare($qry);
		if($stmt->execute()){
			echo 'Successfully registered!';
		}else{
			echo 'Failed!';
		}
	}
}
// --------------------------------------------------------------------------------------------------------------------------------------
elseif(method == 'deleteResolution'){
	$id = $_POST['id'];
	$qry = "DELETE FROM pcs_resolution_tv WHERE id = '$id'";
	$stmt = $conn->prepare($qry);
	if($stmt->execute()){
		echo 'Deleted successfully!';
	}else{
		echo 'Failed!';
	}
}
// ---------------------------------------------------------------------------------------------------------------------------------------

elseif(method == 'load_parts'){
	$keyword = trim($_POST['keyword']);
	if(empty($keyword)){
		$qry = "SELECT *FROM partsname_master ORDER BY id ASC";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		foreach($stmt->fetchALL() as $x){
			echo '<tr onclick="get_id(&quot;'.$x['id'].'~!~'.$x['parts'].'~!~'.$x['ircs_line_name'].'&quot;)" class="modal-trigger" data-target="viewPart">';
			echo '<td>'.$x['id'].'</td>';
			echo '<td>'.$x['parts'].'</td>';
			echo '<td>'.$x['ircs_line_name'].'</td>';
			echo '</tr>';
		}
	}else{
		$qry = "SELECT *FROM partsname_master WHERE ircs_line_name LIKE '$keyword%'";
		$stmt = $conn->prepare($qry);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			foreach($stmt->fetchALL() as $x){
				echo '<tr onclick="get_id(&quot;'.$x['id'].'~!~'.$x['parts'].'~!~'.$x['ircs_line_name'].'&quot;)" class="modal-trigger" data-target="viewPart">';
				echo '<td>'.$x['id'].'</td>';
				echo '<td>'.$x['parts'].'</td>';
				echo '<td>'.$x['ircs_line_name'].'</td>';
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td colspan="3">No Results</td>';
			echo '</tr>';
		}
	}
}

elseif(method == 'create-part'){
	$part = $_POST['part'];
	$line_name = $_POST['line_name'];
	$sql = "INSERT INTO partsname_master (`id`,`parts`,`ircs_line_name`) VALUES ('0','$part','$line_name')";
	$stmt = $conn->prepare($sql);
	if($stmt->execute()){
		echo 'success';
	}else{
		echo 'fail';
	}
}

elseif(method == 'delete_part'){
	$id = $_POST['id'];
	$sql = "DELETE FROM partsname_master WHERE id = '$id'";
	$stmt = $conn->prepare($sql);
	if($stmt->execute()){
		echo 'done';
	}else{
		echo 'fail';
	}
}

elseif(method == 'update_part'){
	$id = $_POST['id'];
	$parts = $_POST['parts'];
	$line = $_POST['line'];
	$query = "UPDATE partsname_master SET parts = '$parts', ircs_line_name = '$line' WHERE id = '$id'";
	$stmt = $conn->prepare($query);
	if($stmt->execute()){
			echo 'done';
		}else{
			echo 'fail';
		}
}
// DIE CONNECTION
$conn = null;
?>