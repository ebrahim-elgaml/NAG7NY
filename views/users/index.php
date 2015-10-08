<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,200' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../css/profile.css" type="text/css">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <?php 
        include '../../actions/users.php';
        include '../../actions/projects.php';
        include '../../db-connections/db-connection.php'; 
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/shop-homepage.css" rel="stylesheet">
    <link href="../../css/nav.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    
    <title>Profile</title>
  </head>
  <body style="background-color: aliceblue;">
  
    
    <div class="container">
        <div class="row login_box">
            <div class="col-md-12 col-xs-12" align="center">
                <div class="outter">
                <?php
                    if (isset($_SESSION['user'])) {
                        $sql = "select * from user where id = '{$_SESSION['user']}'";
                        $result = mysqli_query($db,$sql);
                        $row = $result->fetch_array();
                        $email = $row['email'] ;
                        $img ;
                        if(file_exists('../../uploads/'.$email.'.jpg')) {
                            $img = "../../uploads/'.$email.'.jpg";
                            echo '<img src="../../uploads/'.$email.'.jpg" class="image-circle img-responsive" alt="" >';
                                                
                        } else {
                            $img = "//placehold.it/100";
                        }
                    }else{
                        header("Location: ../projects/");
                        return;
                    } 
                    
                ?>
                
                </div>   
                <h3>Hi <br/><?php echo $email; ?></h3>
                <span>WELCOME TO NAG7NY</span>
            </div>
            <a href="../projects/">
                <div class="col-md-6 col-xs-6 follow line" align="center">
                    <h3>
                         Visit <br/><span> Shop </span>
                    </h3>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#history-modal">
                <div class="col-md-6 col-xs-6 follow line" align="center">
                    <h3>
                         View <br/> <span>History</span>
                    </h3>
                </div>
            </a>
            <a href="editProfile.php">
                <div class="col-md-6 col-xs-6 follow line" align="center" style="width: 100%;">
                    <h3>
                         Edit <br/> <span>Profile</span>
                    </h3>
                </div>   
            </a>         
                
        </div>
    </div>
    <div id="history-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h1 class="text-center" style="color:black;">History</h1>
              </div>
              <div class="modal-body">
                <ul class="list-group" id="modal-cart-body">
                    <?php
                        $result = user_history();
                        if(isset($result)){
                            $numRows = $result->num_rows;
                            if ($numRows > 0) {
                                while ($project = $result->fetch_assoc()) {
                                    echo '<li class="list-group-item" style="text-align: -webkit-center;color:black;">'.
                                        $project['name'].' ('.$project['price'].'$)</li>';
                                }
                            }else{
                                echo '<h3 class="form col-md-12 center-block text-decore" style="color:black;" id="no-elements"> No elements in Histoy now :)</h3>';
                            }
                        }
                    ?>
                </ul>
              </div>
              <div class="modal-footer">
                  <div class="col-md-12" id="cart-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                  </div>    
              </div>
          </div>
      </div>
    </div>
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

  </body>

</html>
