<?php
    include '../db-connections/db-connection.php'; 
    include 'projects.php';
	header('Content-Type: application/json');
	echo json_encode(remove_from_cart($_POST['id']));
?>
