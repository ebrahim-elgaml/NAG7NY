<?php
	include '../db-connections/db-connection.php';
	include 'users.php';
	include 'projects.php';
    header('Content-Type: application/json');
    session_start();  
    global $db;
    echo json_encode(login());
?>
