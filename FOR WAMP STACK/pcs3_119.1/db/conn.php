<?php 
	$servername = 'localhost';
	$username = 'root';
	$pass = '#Sy$temGr0^p|112171';
	try{
		$conn = new PDO ("mysql:host=$servername;dbname=pcs_db",$username,$pass);
	}catch(PDOException $e){
		echo $sql."Halla Sad walang connection!".$e->getMessage();
	}
?>