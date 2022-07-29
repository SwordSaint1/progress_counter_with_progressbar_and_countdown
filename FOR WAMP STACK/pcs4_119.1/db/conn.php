<?php 
	$servername = '172.25.112.171';
	$username = 'root';
	$pass = 'trspassword2022';
	try{
		$conn = new PDO ("mysql:host=$servername;dbname=pcs_db",$username,$pass);
	}catch(PDOException $e){
		echo $sql."Halla Sad walang connection!".$e->getMessage();
	}
?>