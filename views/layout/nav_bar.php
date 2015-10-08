
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">NAG7NY</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!-- <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li> -->
                <!-- <li>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>    
                </li> -->
                <?php 
                    if(isset($_SESSION['user'])){

                        echo '<li id = "li-profile">
                                <p class="navbar-text"><a href="../users/" >Profile</a></p>
                              </li>
                              <li id = "li-cart">
                                <p class="navbar-text"><a href="#" data-toggle="modal" data-target="#cart-modal">Cart <span class="badge" id="cart-count">'.get_cart_number().'</span> </a></p>
                              </li>
                              <li id = "li-logout">
                                <p class="navbar-text">
                                    <a href = "#" id = "logout-link" ><span class = "glyphicon glyphicon-log-out"> logout </span> </a>
                                </p>
                              </li>';

                    }
                    else{
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
                    }
                ?>
            </ul>
        </div>
        
    </div>
    <!-- /.container -->
</nav>
<div id="cart-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="text-center">Added Items</h1>
          </div>
          <div class="modal-body">
            <ul class="list-group" id="modal-cart-body">
                <?php
                    $result = get_elements_in_cart();
                    if(isset($result)){
                        $numRows = $result->num_rows;
                        if ($numRows > 0) {
                            while ($cart = $result->fetch_assoc()) {
                                include '_cart.php';
                            }
                        }else{
                            echo '<h3 class="form col-md-12 center-block text-decore" id="no-elements"> No elements in cart</h3>';
                        }
                    }
                ?>
            </ul>
          </div>
          <div class="modal-footer">
              <div class="col-md-12" id="cart-footer">
                <?php 
                  if(get_cart_number()>0){
                   echo '<button class="btn btn-success btn-sm buy-all-cart" aria-hidden="true">Buy All</button>'; 
                  }
                ?>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
              </div>    
          </div>
      </div>
  </div>
</div>