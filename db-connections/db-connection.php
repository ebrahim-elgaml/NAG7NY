<?php

	$db= mysqli_connect('localhost','root', 'Ee01221838455', 'E-Shop');
	if ($db->connect_error){ 
		die("Connection failed: " . $db->connect_error);	
	} 
?>