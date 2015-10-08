<?php
	include '../db-connections/db-connection.php';
	include 'projects.php';
    header('Content-Type: application/json');
    session_start();  
    global $db;
    $project_id = $_POST['project_id'];
    $user_id = $_SESSION['user'];
    if(isset($user_id)){
    	$query = "SELECT * FROM cart WHERE user_id ='{$user_id}' AND project_id ='{$project_id}'";
	    $result = $db->query($query);
	    $numRows = $result->num_rows;
	    if($numRows > 0){
	        echo json_encode(array("failure"));	
	    }else{
	    	$query = "SELECT COUNT( id ) AS count, id  FROM project_links WHERE user_id ='{$user_id}' AND project_id ='{$project_id}';";
		    $result = $db->query($query);
		    if(($result->fetch_assoc()['count']) == 0){
		    	$query = "INSERT INTO  `cart` ( `user_id` ,  `project_id` ) VALUES ('{$user_id}',  '{$project_id}');";
			    $result = $db->query($query);
			    if($result){
			    	$query = "SELECT name  FROM project WHERE id ='{$project_id}'";
			    	$project_name = $db->query($query);
			    	$project_name = $project_name->fetch_assoc()['name'];
			    	$query = "SELECT id  FROM cart WHERE project_id ='{$project_id}' AND user_id='{$user_id}';";
			    	$cart_id = $db->query($query);
			    	$cart_id = $cart_id->fetch_assoc()['id'];
			    	$query = "INSERT INTO  `project` ( `user_id` ,  `project_id` ) VALUES ('{$user_id}',  '{$project_id}');";
			    	$result = $db->query($query);
			    	echo json_encode(array("success",get_cart_number(),$cart_id, $project_name));	
			    }else{
					echo json_encode(array("failure"));
			    }	
		    }else{
		    	echo json_encode(array("failure"));
		    }     
	    }
    }else{
    	echo json_encode(array("authentication"));

    }
    
    
?>
