<?php

	$db= mysqli_connect('localhost','root', '', 'E-Shop');
	if ($db->connect_error){ 
		die("Connection failed: " . $db->connect_error);	
	} 
?>