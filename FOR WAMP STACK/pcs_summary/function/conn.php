<?php
    // SET DEFAULT TIMEZONE
    date_default_timezone_set('Asia/Manila');
    $server_date = date('Y-m-d');
    $server_time = date('H:i:s');
    $servername = 'localhost';
    $username = 'root';
    $password = '#Sy$temGr0^p|112171';
    try{
        $conn = new PDO("mysql:host=$servername;dbname=pcs_db",$username,$password);
    }catch(PDOException $e){
        echo 'No Connection!'.$e->getMessage();
    }

    

    
?>