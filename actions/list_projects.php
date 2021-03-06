<?php
    include '../db-connections/db-connection.php'; 
    include 'projects.php';
	header('Content-Type: application/json');
    $array = array();
    $university_name = $_GET['university_name'];
    $course_name = $_GET['course_name'];
    $result = index_available_projects(get_university_id_from_name($university_name),get_course_id_from_name($course_name));
    $numRows = $result->num_rows;
    if ($numRows > 0) {
        while ($project = $result->fetch_assoc()) {
            array_push($array, $project);
        }
    }else{
        array_push($array, 0);
    }
    $array_not = array();
    $result = get_sold_out(get_university_id_from_name($university_name),get_course_id_from_name($course_name));
    $numRows = $result->num_rows;
    if ($numRows > 0) {
        while ($project = $result->fetch_assoc()) {
            array_push($array_not, $project);
        }
    }else{
        array_push($array_not, 0);
    }
	echo json_encode(array($array,$array_not));
?>
