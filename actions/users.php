<?php 
	session_start();
	include '../../db-connections/db-connection.php';  
	function signup() {
		global $db; 
		if(!isset($_POST['submit'])){
			return;
		}
		//session_destroy();
		$password =  $_POST['password'];
		$passwordconfirmation =  $_POST['passwordconfirmation']; 
		if($password != $passwordconfirmation)
			header("Location: ../users/registration.php?error=1"); /* Redirect browser */
		else {
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			 	header("Location: ../users/registration.php?error=2");
			else {
				if ($db->connect_error) 
					die("Connection failed: " . $db->connect_error);	
				$email = $_POST['email'];
				$sql = "select * from user where email = '{$email}'";
				$result = mysqli_query($db,$sql);
				if ($result->num_rows === 0) { 		
					$firstname = $_POST['firstname'];
					$lastname = $_POST['lastname'];
					$avatar = $_POST['image'];
					$credit_card = $_POST['credit_card'];
					$uploads_dir = '../../uploads';
					if ((($_FILES["image"]["type"] == "image/gif")
						|| ($_FILES["image"]["type"] == "image/jpeg")
						|| ($_FILES["image"]["type"] == "image/pjpeg")))
						  {
						    $tmp_name = $_FILES["image"]["tmp_name"];
					        $name = $_FILES["image"]["name"];
					        $x = 1; 
					        //move_uploaded_file($tmp_name, "$uploads_dir/$name");
					        $temp = explode(".", $_FILES["image"]["name"]);
							$newfilename = $email . '.' . end($temp);
							move_uploaded_file($_FILES["image"]["tmp_name"], "$uploads_dir/" . $newfilename);
					}
					else {
						header("Location: ../users/registration.php?error=5"); 
						return;
					} 
					$password = sha1(sha1($password).sha1("mySalt@$#(%"));
					$sql= "insert into user (first_name,last_name,email,password,avatar,credit_card) values ('{$firstname}','{$lastname}','{$email}','{$password}', '{$avatar}', '{$credit_card}')";
				    #$result = mysqli_query($db,$sql);
				    $result = $db->query($sql);
				    if($result) {
				      $sql= "select * from user where email = '{$email}'";	
				      $result = $db->query($sql);
				      $row = $result->fetch_array();
				      $_SESSION['user'] = $row['id']; 
				      $user = $_SESSION['user'];
				      header("Location: ../projects/");
				    }
				    else   	
				      header("Location: ../users/registration.php?error=6");	
				}
				else
				    header("Location: ../users/registration.php?error=3");
			}
		}
		
	}
	function getUserInfo() {
		global $db; 
		if(!isset($_SESSION['user'])) 
		 header("Location: ../users/registration.php?error=7");	
		else {
			$user_id = $_SESSION['user']; 
			$sql = "select * from user where id = '{$user_id}'";
			$result = mysqli_query($db,$sql);
			if ($result->num_rows === 0) { 		
				session_destroy();
				header("Location: ../users/registration.php?error=4");
			}	
			else {
				 $row = $result->fetch_array();
				 return $row;
			}
		}

	}
	function changeUserInfo() {
		global $db; 
		if (isset($_POST['changeInfo'])){
			$password =  $_POST['password'];
			$passwordconfirmation =  $_POST['passwordconfirmation']; 
			if($password != $passwordconfirmation)
				header("Location: ../users/registration.php?error=1"); /* Redirect browser */
			else {	
				if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
					header("Location: ../users/editProfile.php?error=2");
				else {
					$email = $_POST['email'];
					$sql = "select * from user where email = '{$email}'";
					$result = mysqli_query($db,$sql);
					$row = $result->fetch_array(); 
					if ( (isset($row) && $row['id'] == $_SESSION["user"])) { 		
						$firstname = $_POST['first_name'];
						$lastname = $_POST['last_name'];
						$avatar = $_POST['image'];
						

						$uploads_dir = '../../uploads';
						//if (isset($_FILES['image'])) {
							if ((($_FILES["image"]["type"] == "image/gif")
								|| ($_FILES["image"]["type"] == "image/jpeg")
								|| ($_FILES["image"]["type"] == "image/pjpeg")))
								  {
								  	unlink('../../uploads/'.$email.'.jpg');
						
								    $tmp_name = $_FILES["image"]["tmp_name"];
							        $name = $_FILES["image"]["name"];
							        $x = 1; 
							        //move_uploaded_file($tmp_name, "$uploads_dir/$name");
							        $temp = explode(".", $_FILES["image"]["name"]);
									$newfilename = $email . '.' . end($temp);
									move_uploaded_file($_FILES["image"]["tmp_name"], "$uploads_dir/" . $newfilename);
							}
							else {
								header("Location: ../users/editProfile.php?error=4"); 
								return;
							} 
						//}
						if (isset($password)) { 
							$password = sha1(sha1($password).sha1("mySalt@$#(%"));
							$sql= "update user set first_name = '{$firstname}' ,last_name = '{$lastname}', email = '{$email}',password = '{$password}',avatar = '{$avatar}' where id= '{$_SESSION["user"]}'";
							//$sql = "delete from user";
							$result = mysqli_query($db,$sql);
							
						}
						else {
							$sql= "update user set first_name = '{$firstname}' ,last_name = '{$lastname}', email = '{$email}',avatar = '{$avatar}' where id= '{$_SESSION["user"]}'";
							$result = $db->query($sql);
						}
						header("Location: ../projects/index.php?msg=your info has been updated");	   		
					}
					else
						header("Location: ../users/editProfile.php?error=3");
						
				}
			}
		}
	}
	function login() {
		global $db; 	
		$email = $_POST['email'];
	    $password = $_POST['password'];
	    $password = sha1(sha1($password).sha1("mySalt@$#(%"));
		$sql = "select * from user where email = '{$email}' and password = '{$password}'";
		$result = mysqli_query($db,$sql);	
		if ($result->num_rows === 0) { 	
			return array("failure");
		}
		else {
			$row = $result->fetch_array();
			$_SESSION['user'] = $row['id'];
			$user_id = $row['id'];
			$query = "SELECT COUNT( id ) AS count FROM `cart` WHERE user_id = '{$user_id}';";
	        $result2 = $db->query($query);
	        $result = get_elements_in_cart();
	        $array = array();
	        if(isset($result)){
                $numRows = $result->num_rows;
                if ($numRows > 0) {
                    while ($cart = $result->fetch_assoc()) {
                        array_push($array,$cart);
                    }
                }
            }
			return array("success",$result2->fetch_assoc()['count'],$array);
		}
		
	}
	function checkSession(){
		if(isset($_SESSION['user'])){
			header("Location: ../projects");
		}
	}
?>