<?php 
include '../db/conn.php';

$method = $_POST['method'];
$ircs_line = $_POST['ircs_line'];
$line = $_POST['line'];
if ($method == 'fetch_remaining') {
	$query = "SELECT (Remaining_Target * takt_secs_DB * -1) as total_minutes FROM pcs_plan WHERE Carmodel = '$ircs_line' AND Line = '$line' AND Status = 'Pending'";

	$stmt = $conn->prepare($query);
	if ($stmt->execute()) {
		foreach($stmt->fetchALL() as $j){
		 $total = $j['total_minutes'];
	 	$totals = gmdate('i:s', $total / 60);
		$r = 'Remaining Time:';
		 $remaining = $r.' '.$totals; 

	    $seconds = intval($total%60);
	    $total_minutes = intval($total/60);
	    $minutes = $total_minutes%60;
	    $hours = intval($total_minutes/60);
	  echo $a = "$r $hours:$minutes:$seconds";
	}
	}
}
$conn = NULL;
?>