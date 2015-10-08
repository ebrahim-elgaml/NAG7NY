<!DOCTYPE html>
<?php session_start(); ?>
<html>
  <head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/registration.css" type="text/css">
    <?php include '../../actions/users.php';?>
    <?php checkSession();?>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title>Sign Up</title>
    
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
    <div class="testbox">
      <h1>Registration</h1>
      <form id="signup" action="<?php signup(); ?>" method="post" enctype="multipart/form-data">

        <input type="text" name="email" id="email" placeholder="Email" required/>

        <input type="text" name="firstname" id="firstname" placeholder="first name" required/>

        <input type="text" name="lastname" id="lastname" placeholder="last name" required/>

        <input type="password" name="password" id="password" placeholder="Password" required/>

        <input type="password" name="passwordconfirmation" id="passwordconfirmation" placeholder="Password confirmation" required/>

        <input type="number" name="credit_card" id="credit_card" placeholder="Credit Card" required/>
        <table style="width:100%">
          <tr>
            <td>
            </td>
            <td>              
              <input type="file" name="image" id="image">
            </td>
          </tr>
        </table>         
         <button type='submit' name="submit">Registration button </button>
      </form>
    </div>
    
  </body>
</html>

