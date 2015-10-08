<!DOCTYPE html>

<html>
  <head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/registration.css" type="text/css">

    <?php include '../../actions/users.php';?>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title>Registration</title>
    <script type="text/javascript">
      function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-show')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
      </script>
  </head>
  <body>
    <?php  
      if (isset($_GET["error"])) { 
        $error_msg = '...';
        switch ($_GET['error']) {
          case 1:
            $error_msg = "password does not match password confirmation";
            break;
          case 2: 
            $error_msg = "the email must be in a valid format";
            break;
          case 3: 
            $error_msg = "this email is already taken";
            break;
          case 4:
            $error_msg = "u need to sign in or signup";
            break;  
          default:
            $error_msg = "an error has occured";
            break;
        }
        echo '<div class="alert alert-danger" role="alert">';
        echo '<a href="#" class="alert-link">'.$error_msg. '</a>';
        echo '</div>' ;
           
      } 
    ?>
    <div class="container">
      <h1>Resgiter</h1>
      <hr>
      <form class="form-horizontal"id="signup" action="<?php signup(); ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-3">
            <div class="text-center">
              <img id = "image-show" src="//placehold.it/100" class="avatar img-circle" alt="avatar">
              <h6>Upload a photo...</h6>
              <input type="file" name="image" id="image" class="form-control" onchange="readURL(this);">
            </div>
          </div>
          <div class="col-md-9 personal-info">
            <h3>Personal info</h3>
            <div class="form-group">
              <label class="col-lg-3 control-label">First name:</label>
              <div class="col-lg-8">
                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="first name" required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Last name:</label>
              <div class="col-lg-8">
                <input type="text" name="lastname" id="lastname" placeholder="last name" class="form-control" required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email:</label>
              <div class="col-lg-8">
                <input type="text" name="email" id="email" placeholder="Email" class="form-control" required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Credit Card Number:</label>
              <div class="col-lg-8">
                <input type="number" name="credit_card" id="credit_card" placeholder="Credit Card" class="form-control" required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Password:</label>
              <div class="col-lg-8">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Password Confirmation:</label>
              <div class="col-lg-8">
                <input type="password" name="passwordconfirmation" class="form-control" id="passwordconfirmation" placeholder="Password confirmation" required/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">
              </label>
              <div class="col-md-8">
                <button type='submit' name="submit" class="btn btn-default">Registration button </button>
                <input type="reset" class="btn btn-default" value="Cancel" >
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
      <hr>
  </body>
</html>


