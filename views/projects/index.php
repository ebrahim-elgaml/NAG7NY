<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop Homepage </title>
    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/shop-homepage.css" rel="stylesheet">
    <link href="../../css/nav.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <?php include '../../actions/projects.php'; ?>
    <?php include '../../actions/users.php'; ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <?php
        include '../layout/nav_bar.php';
    ?>
    <div class = "alerts"></div>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Universities</p>
                <div class="list-group" id="universities">
                    <?php
                        $result = index_universities();
                        $numRows = $result->num_rows;
                        if ($numRows > 0) {
                            while ($university = $result->fetch_assoc()) {
                                echo "<a href='#' class='university list-group-item'>{$university['name']}</a>";
                            }
                        }
                    ?>
                </div>
                <p class="lead lead-course" style="display: none;">Courses</p>
                <div class="courses list-group">
                    
                </div>
            </div>

            <div class="col-md-9">

                <!-- <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="http://s30.postimg.org/kshpz6rox/APlus.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://s13.postimg.org/9hs3zazrb/pen.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://s17.postimg.org/zfj6norbz/exams.jpg" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div> -->

                <div class="row projects">
                    <?php
                        $result = index_available_projects(null, null);
                        $numRows = $result->num_rows;
                        $empty = false;
                        $sold_out = false;
                        if ($numRows > 0) {
                            $empty = true;
                            while ($var = $result->fetch_assoc()) {
                                include '_project.php';
                            }
                        }
                        $result = get_sold_out(null,null);
                        $numRows = $result->num_rows;
                        $sold_out = true;
                        if ($numRows > 0) {
                            $empty = true;
                            while ($var = $result->fetch_assoc()) {
                                include '_project.php';
                            }
                        }
                        if($empty == false){
                            echo "<h3 style='text-align: -webkit-center;'>No Projects here at this moment but we will post soon :) </h3>";
                        }
                    
                    ?>

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; NAG7NY 2015</p>
                </div>
            </div>
        </footer>

    </div>
    
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
    <div id="scripts-shops">
        <script src="../../js/shop-page.js"></script>
    </div>
    
    <!-- <script src="../../js/main-load.js"></script> -->

</body>

</html>