<?php
    include '../db-connections/db-connection.php'; 
    include 'projects.php';
	header('Content-Type: application/json');
	echo json_encode(buy_project($_POST['id'],$_POST['number'] ));
?>
