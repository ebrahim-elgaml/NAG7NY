<?php
	include '../db-connections/db-connection.php';
	include 'projects.php';
	include 'users.php';
    //header('Content-Type: application/json');
    session_start();
    session_destroy();
    echo '<li id="login-list">
            <ul class="nav navbar-nav navbar-right pull-right">
                <li><p class="navbar-text">Already have an account?</p></li>
                <li class="dropdown" id = "login-dropdown">
                  <a href="#" class="dropdown-toggle" id="loginlink" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                             <div class="row">
                                    <div class="col-md-12">
                                                <div id="login-alerts"></div>
                                              <form class="form" role="form" method="post" accept-charset="UTF-8" id="login-nav" remote = true>
                                                <div class="form-group">
                                                     <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                     <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                                                </div>
                                                <div class="form-group">
                                                     <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                     <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                     <button type="submit" name="loginbutton" id="loginbutton" class="btn btn-primary btn-block">Sign in</button>
                                                </div>
                                         </form>
                                     </div>
                                    <div class="bottom text-center">
                                        New here ? <a href="../users/registration.php"><b>Join Us</b></a>
                                    </div>
                             </div>
                        </li>
                    </ul>
                </li>';
?>
