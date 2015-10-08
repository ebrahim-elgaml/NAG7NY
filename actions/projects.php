<?php
    include '../../db-connections/db-connection.php';
    if(!isset($_SESSION['user'])){
        session_start();
    } 
    function buy_project($cart_id, $number){
        global $db;
        $user_id = $_SESSION['user'];
        $query = "SELECT * FROM cart WHERE id = '{$cart_id}';";
        $result = $db->query($query);
        $project_id = $result->fetch_assoc()['project_id']; 
        $query = "DELETE FROM `cart` WHERE id = '{$cart_id}'";
        $result = $db->query($query);
        while($number > 0 ){
            $query = "SELECT id FROM project_links WHERE project_id = '{$project_id}' AND user_id = 0  LIMIT 1";
            $project_link_id = $db->query($query);
            $project_link_id = $project_link_id->fetch_assoc()['id'];
            $query = "UPDATE  `project_links` set user_id = '{$user_id}', sold = 1 Where id= '{$project_link_id}';";
            $result = $db->query($query);
            $number--;
        }
        return array("success",get_cart_number(),get_project_count($project_id), $project_id);   
        
    }
    function remove_from_cart($cart_id){
        global $db;
        $query = "DELETE FROM `cart` WHERE id = '{$cart_id}'";
        $result = $db->query($query);
        if($result){
            return array("success",get_cart_number());   
        }else{
            return array("failure");
        }
    }
    function get_cart_number(){
        global $db;
        $user_id = $_SESSION['user'];
        $query = "SELECT COUNT( id ) AS count FROM `cart` WHERE user_id = '{$user_id}';";
        $result = $db->query($query);
        return $result->fetch_assoc()['count'];
    }
    function get_elements_in_cart(){
        global $db;
        $user_id =$_SESSION['user'];
        if(isset($user_id)){
            $query = "SELECT DISTINCT project.id, project.name, project.price, cart.id AS  'cart_id'
                        FROM project
                        INNER JOIN cart ON project.id = cart.project_id
                        WHERE cart.user_id = '{$user_id}';";
            $result = $db->query($query);
        }else{
            $result = null;
        }
        return $result;
    }
	function index_universities() {
        global $db; 
    	$query = "SELECT * FROM `university`;";
        $result = $db->query($query);
        return $result;
	}
    function get_project_count($project_id){
        global $db; 
        $query = "SELECT DISTINCT COUNT( project_links.sold ) AS count
                        FROM project
                        INNER JOIN project_links ON project.id = project_links.project_id
                        WHERE project.id ='{$project_id}'
                        AND project_links.sold =0;";
        $result = $db->query($query);
        return $result->fetch_assoc()['count'];
    }
	function index_available_projects($university_id, $course_id) {
    	global $db; 
        if(isset($university_id) && isset($course_id)){
        	$query = "SELECT DISTINCT project.id, project.name, project.price, project.description, project.image_link, project_links.link, COUNT( project_links.sold ) AS count
						FROM project
						INNER JOIN project_links ON project.id = project_links.project_id
						WHERE project.course_id ='{$course_id}'
						AND project_links.sold =0;";
        }elseif (isset($university_id)) {
        	$query = "SELECT DISTINCT project.id, project.name, project.price, project.description, project.image_link, project_links.link, COUNT( project_links.sold ) AS count
                        FROM project
                        INNER JOIN project_links ON project.id = project_links.project_id
                        WHERE project_links.sold =0
                        AND project.course_id IN ( select id from course where university_id = '{$university_id}' )
                        GROUP BY project.id;";
        }else{
        	$query = "SELECT DISTINCT project.id, project.name, project.price, project.description, project.image_link, project_links.link, COUNT( project_links.sold ) AS count
						FROM project
						INNER JOIN project_links ON project.id = project_links.project_id
						WHERE project_links.sold =0
						GROUP BY project.id;";
        }
        $result = $db->query($query);
        return $result;
	}
    function get_sold_out($university_id, $course_id){
        global $db; 
        if(isset($university_id) && isset($course_id)){
            $query = "SELECT project.id, project.name, project.price, project.description, project.image_link
                        FROM project
                        WHERE project.course_id ='{$course_id}' AND project.id NOT IN(SELECT DISTINCT project.id
                                    FROM project
                                    INNER JOIN project_links ON project.id = project_links.project_id
                                    WHERE project.course_id ='{$course_id}'
                                    AND project_links.sold =0);";
        }elseif (isset($university_id)) {
            $query = "SELECT project.id, project.name, project.price, project.description, project.image_link
                        FROM project
                        WHERE project.course_id IN ( select id from course where university_id = '{$university_id}' )
                        AND project.id NOT IN (SELECT DISTINCT project.id
                        FROM project
                        INNER JOIN project_links ON project.id = project_links.project_id
                        WHERE project_links.sold =0
                        AND project.course_id IN ( select id from course where university_id = '{$university_id}' ));";
        }else{
            $query = "SELECT project.id, project.name, project.price, project.description, project.image_link
                        FROM project
                        WHERE project.id NOT IN (SELECT DISTINCT project.id
                        FROM project
                        INNER JOIN project_links ON project.id = project_links.project_id
                        WHERE project_links.sold =0
                        GROUP BY project.id);";
        }
        $result = $db->query($query);
        return $result;
    }
    function get_university_id_from_name($name){
        global $db;
        if(!isset($name)){
            return null;
        }
        $query = "SELECT id FROM university WHERE name ='{$name}'";
        $result = $db->query($query);
        $numRows = $result->num_rows;
        if($numRows > 0){
            return $result->fetch_assoc()['id'];
        }else{
            return null;
        }
    }
    function get_course_id_from_name($name){
        global $db; 
        if(!isset($name)){
            return null;
        }
        $query = "SELECT id FROM course WHERE name ='{$name}'";
        $result = $db->query($query);
        $numRows = $result->num_rows;
        if($numRows > 0){
            return $result->fetch_assoc()['id'];
        }else{
            return null;
        }
    }
    function user_history() {
        global $db; 
        $user_id = $_SESSION['user'];
        $query = "SELECT DISTINCT project.id, project.name, project.price, project.description, project.image_link, project_links.link, COUNT( project_links.sold ) AS count
                        FROM project
                        INNER JOIN project_links ON project.id = project_links.project_id
                        WHERE project_links.user_id = '{$user_id}'
                        GROUP BY project.id;";
        
        $result = $db->query($query);
        return $result;
    } 
?>
