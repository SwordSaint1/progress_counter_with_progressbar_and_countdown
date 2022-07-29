<?php 
if(isset($_SESSION['username'])){
	$password = $_SESSION['username'];
	$qry = "SELECT name FROM pcs_admin_account WHERE password = '$password'";
	$stmt = $conn->prepare($qry);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		$name = $x['name'];
	}
}else{
	session_unset();
	session_destroy();
	header('location: ../index.php');
}
?>