<?php 
include '../db/conn.php';

$method = $_POST['method'];

// if ($method == 'fetch_progress') {
// 	$ircs_line = $_POST['ircs_line'];
// 	$line = $_POST['line'];

// 	$query = "SELECT Target, Actual_Target FROM pcs_plan WHERE IRCS_Line = '$ircs_line' AND Line = '$line' AND Status = 'Pending'";
// 	$stmt = $conn->prepare($query);
// 	if ($stmt->execute()) {
// 		foreach($stmt->fetchALL() as $x){
// 			 $x['Actual_Target'];
// 			 echo $try = 200;
			
// 		}
// 	}
// }

// if ($method == 'fetch_max') {
// 	$ircs_line = $_POST['ircs_line'];
// 	$line = $_POST['line'];

// 	$query = "SELECT Target, Actual_Target FROM pcs_plan WHERE IRCS_Line = '$ircs_line' AND Line = '$line' AND Status = 'Pending'";
// 	$stmt = $conn->prepare($query);
// 	if ($stmt->execute()) {
// 		foreach($stmt->fetchALL() as $x){
// 			echo $x['Target'];
		
			
// 		}
// 	}
// }

// if ($method == 'fetch_percentage') {
// 	$ircs_line = $_POST['ircs_line'];
// 	$line = $_POST['line'];

// 	$query = "SELECT ((200 / Target  ) * 100) as total FROM pcs_plan WHERE IRCS_Line = '$ircs_line' AND Line = '$line' AND Status = 'Pending'";
// 	$stmt = $conn->prepare($query);
// 	if ($stmt->execute()) {
// 		foreach($stmt->fetchALL() as $x){
// 			$p = '%';
// 			$total = $x['total'];
// 			$total2 = round($total, 0);
// 			echo $totals = $total2."".$p;
			
// 		}
// 	}
// }

if ($method == 'fetch_progress_max') {
	$ircs_line = $_POST['ircs_line'];
	$line = $_POST['line'];

	$check = "SELECT IP_address FROM pcs_plan WHERE IRCS_Line LIKE '$ircs_line%' AND line LIKE '$line%' AND Status = 'Pending'";
	$stmt2 = $conn->prepare($check);
	if ($stmt2->execute()) {
		foreach($stmt2->fetchALL() as $j){
			$ip_address = $j['IP_address'];
		}
		$query = "SELECT takt_secs_DB FROM pcs_plan WHERE IRCS_Line LIKE '$ircs_line%' AND Line LIKE '$line%' AND Status = 'Pending' AND IP_address LIKE '$ip_address%'";
	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		foreach($stmt->fetchALL() as $x){
			echo $x['takt_secs_DB'];		
		}
	}
	}

	
}
$conn = NULL;
?>