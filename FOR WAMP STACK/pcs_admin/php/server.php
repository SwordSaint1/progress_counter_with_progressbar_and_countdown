<?php
session_start();
require 'conn.php';
if(isset($_POST['loginBtn'])){
	$password = $_POST['password'];
	$qry = "SELECT * FROM pcs_admin_account WHERE password = '$password'";
	$stmt = $conn->prepare($qry);
	$stmt->execute();
	$stmt->fetchALL();
	if($stmt->rowCount() > 0){
		$_SESSION['username'] = $password;
		header('location:admin/dashboard.php');
	}
}

if(isset($_POST['logoutBtn'])){
	session_unset();
	session_destroy();
	header('location: ../index.php');
}
?>