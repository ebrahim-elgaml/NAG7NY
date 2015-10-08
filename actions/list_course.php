<?php
	include '../db-connections/db-connection.php'; 
    header('Content-Type: application/json');
	  $name = $_GET['name'];
    $query = "SELECT * FROM `university` WHERE name = '{$name}';";
    $result =  $db->query($query);
    $numRows = $result->num_rows;
    $array = array();
    if ($numRows > 0) {
        while ($university = $result->fetch_assoc()) {
            $university_id = $university['id'];
    	}
    	$query = "SELECT * FROM `course` WHERE university_id = '{$university_id}';";
	    $result = $db->query($query);
	    $numRows = $result->num_rows;
	    if ($numRows > 0) {
        	while ($course = $result->fetch_assoc()) {
         		array_push($array, $course);
         	}
      	}
	}
	echo json_encode($array);	
?>
