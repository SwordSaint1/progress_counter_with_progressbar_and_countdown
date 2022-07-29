<?php
	date_default_timezone_set('Asia/Manila');
	$server = 'localhost';
	$username = 'root';
	$pass = '#Sy$temGr0^p|112171';
	try{
		$conn = new PDO("mysql:host=$server;dbname=pcs_db",$username,$pass);
	}catch(PDOException $e){
		echo $sql.'NO CONNECTION'.$e->getMessage();
	}
?>